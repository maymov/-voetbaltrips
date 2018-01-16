<?php

namespace App\Http\Controllers;

use App\LanClass\LangKeys;
use App\LanguagesKeys;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Languages;
use \Config;
use Illuminate\Support\Facades\Session;
use JMS\Serializer\Exception\ExpressionLanguageRequiredException;
use League\Flysystem\FileExistsException;
use Validator;
use File;
use Lang;
use Translater;

class LanguagesController extends Controller
{

	public function index()
	{
		$languages = Languages::get();
		return view('admin.languages.index', compact('languages'));
	}

	public function show($id)
	{
		$language = Languages::findOrFail($id);
		return view('admin.languages.show', compact('language'));
	}

	public function create(Request $request)
	{
		return view('admin.languages.create');
	}

	public function edit($id)
	{
		$language = Languages::find($id);
		return	view('admin.languages.edit', compact('language'));
	}

	public function update($id, Request $request)
	{
		$rules      = [
			"name"  => "required",
			"main"  => "required"
		];
		$validator  = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$lang = Languages::find($id);
		if ($request->input('main') != $lang->is_main) {
			if ($lang->is_main == 1) {
				return redirect('admin/languages')->with('error', 'Firs you should Identify new Main language!');
			}
			$main = Languages::where('is_main', 1)->first();
			$main->is_main = 0;
			$main->save();
			$lang->is_main = 1;
		}
		if ($request->input('name') != $lang->name) {
			$lang->name = $request->input('name');
		}

		$lang->save();
		return redirect('admin/languages')->with('success', Lang::get('message.success.edit'));
	}

	public function store(Request $request)
	{
		$rules = [
			"name"  => "required|unique:languages,name",
			"code"  => "required|unique:languages,code"
		];

		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$new = Languages::create([
			'name'  => $request->input('name'),
			'code'  => $request->input('code'),
		]);

		if ($new) {
			$mainLang = Languages::with('getValues')->where('is_main', '1')->first();
			foreach ($mainLang->getValues as $val) {
				LanguagesKeys::create([
					'languages_id'  => $new->id,
					'lan_keys_id'   => $val->lan_keys_id,
					'value'         => $val->value
				]);
			}
		}
		return redirect('admin/languages')->with('success', Lang::get('message.success.create'));
	}

	public function changeLang(Request $request)
	{
		$code = strtoupper($request->session()->get('lang_code'));
		$languages = Languages::get();
		$data = [];

		$count = count($languages);

		foreach ($languages as $l) {
			$langs[] = $l->code;
		}
		$key = array_search($code, $langs);

		if ($count < $key) {
			$data = ['status' => 'error', 'message' => 'Somthing go wrong'];
		} else if ($count == $key+1) {
			Session::put('lang_code', strtoupper($languages[0]->code));
			Session::put('lang_id', $languages[0]->id);
			$data = ['status' => 'success'];
		} else {
			Session::put('lang_code', strtoupper($languages[$key+1]->code));
			Session::put('lang_id', $languages[$key+1]->id);
			$data = ['status' => 'success'];
		}

		return response()->json($data);
	}

	public function getLanguageKeys()
	{
		return view('admin.languages.keys.index');
	}

	public function getModalDelete($id = null)
	{
		$error = '';
		$model = '';
		$confirm_route =  route('admin.languages.delete', ['id'=>$id]);
		return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));
	}

	/**
	 * Delete the given Club.
	 *
	 * @param  int      $id
	 * @return Redirect
	 */

	public function getDelete($id = null)
	{
		LanguagesKeys::where('languages_id', $id)->delete();
		$lang = Languages::destroy($id);

		return redirect('admin/languages')->with('success', Lang::get('message.success.delete'));
	}

	public function sentForModal(Request $request)
	{
		$data   = [];
		$arr    = [
			'quest'                 => 'modal-label-question',
			'seats'                 => 'modal-message-do-you-want-to-change-seating-type',
		    'seats-change'          => 'modal-text-do-you-want-to-change-the-quantity',
			'outgoing-flight'       => 'modal-message-please-select-a-outgoing-flight',
			'information'           => 'form-label-information',
			'return-flight'         => 'modal-message-please-select-a-return-flight',
			'change-accomodation'   => 'modal-message-do-you-want-to-change-accomodation',
			'delete-this-option'    => 'modal-message-are-you-sure-you-want-to-delete-this-option',
			'valid-quantity'        => 'modal-message-please-enter-valid-quantity'
		];

		if (!$request->input('title') || !$request->input('page')) {
			$data['message']    = 'Wrong Data!';
			$data['status']     = 'error';
		} else {
			$data['status'] = 'success';
			$data['title']  = Translater::getValue($arr[$request->input('title')]);
			$data['quest']  = Translater::getValue($arr[$request->input('page')]);
		}
		return json_encode($data);
	}
}
