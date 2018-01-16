<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Country;
use App\Languages;
use App\TransCountry;
use Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
class CountriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$countries = Country::paginate(20);
		return view('admin.countries.index', compact('countries'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$languages = Languages::get();
		return view('admin.countries.create', compact('languages'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules      = ["code" => "required|unique:country,code"];
		$validator  = Validator::make($request->all(), $rules);

		if($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$country = Country::create([
				'code' => $request->input('code'),
				'name' => $request->input('name')
		]);
		$languages = Languages::get();
		foreach ($languages as $lang) {
			if ($request->input($lang->code)) {
				TransCountry::create([
					'country_id'    => $country->id,
					'lang_code'     => $lang->code,
					'trans_name'    => $request->input($lang->code)
				]);
			}
		}
		return redirect('admin/countries')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$country = Country::with('getTranslate')->findOrFail($id);
		return view('admin.countries.show', compact('country'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$country    = Country::findOrFail($id);
		$languages  = Languages::get();
		return view('admin.countries.edit', compact('country', 'languages'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$country = Country::findOrFail($id);

		$country->update([
				'code'  => $request->input('code'),
				'name'  => $request->input('name')
			]);

		$languages = Languages::get();
		foreach ($languages as $lan) {
			if ($request->input($lan->code)) {
				$cont = TransCountry::where([
						'country_id'    => $country->id,
						'lang_code'     => $lan->code
				])->first();

				if ($cont) {
					$cont->trans_name = $request->input($lan->code);
				} else {
					TransCountry::create([
						'country_id'    => $country->id,
						'lang_code'     => $lan->code,
						'trans_name'    => $request->input($lan->code)
					]);
				}
			}
		}
		return redirect('admin/countries')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Country.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error          = '';
            $model          = '';
            $confirm_route  =  route('admin.countries.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));
    	}

    	/**
    	 * Delete the given Country.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
		    TransCountry::where('country_id', $id)->delete();
    		Country::destroy($id);
            return redirect('admin/countries')->with('success', Lang::get('message.success.delete'));
    	}

    	public function importcsv() {
            $resp['status']   = "error";
            $resp['message']  = "Unable to upload Import file";

            if (Input::hasfile("csvfile")) {
                $path = Input::file('csvfile')->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();

                if (!empty($data) && $data->count()) {
                    foreach ($data as $key => $value) {
                        $check_country = Country::where("code", "=", $value->code)
                            ->where("name","=", $value->name)
                            ->first();
                        if ($check_country === null) {
                            $insert[]        = [
                                "code"       => $value->code,
                                "name"       => $value->name,
                                "created_at" => date("Y-m-d H:i:s"),
                                "updated_at" => date("Y-m-d H:i:s")
                            ];
                        }
                    }
                    if (!empty($insert)) {
                        foreach (array_chunk($insert,1000) as $t) {
                            Country::insert($t);
                        }
                        $resp['status']  = "success";
                        $resp['message'] = "File Imported Successfully";
                    } else {
                        $resp['message'] = "No new Country data to upload";
                    }
                }
            }
            return response()->json($resp);
        }
}
