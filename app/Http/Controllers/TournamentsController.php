<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Languages;
use App\Tournament;
use App\TransTournament;
use Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class TournamentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tournaments = Tournament::latest()->get();
		return view('admin.tournaments.index', compact('tournaments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$languages = Languages::get();
		return view('admin.tournaments.create', compact('languages'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules      = ['name' => 'required', 'start_date' => 'required', 'end_date' => 'required'];
		$validator  = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$tournament = Tournament::create([
				'name'          => $request->input('name'),
				'start_date'    => $request->input('start_date'),
				'end_date'      => $request->input('end_date'),
			]);

		if ($tournament) {
			$languages = Languages::get();
			foreach ($languages as $lang) {
				if ($request->input($lang->code)) {
					TransTournament::create([
							'tournament_id' => $tournament->id,
							'lang_code'     => $lang->code,
							'story'         => $request->input($lang->code)
						]);
				}
			}
			return redirect('admin/tournaments')->with('success', Lang::get('message.success.create'));
		} else {
			return redirect('admin/tournaments')->with('error', 'Something was wrong');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tournament = Tournament::findOrFail($id);
		return view('admin.tournaments.show', compact('tournament'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	*/
	public function edit($id)
	{
		$tournament = Tournament::findOrFail($id);
		$languages  = Languages::get();
		return view('admin.tournaments.edit', compact('tournament', 'languages'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	*/
	public function update($id, Request $request)
	{
		$tournament = Tournament::findOrFail($id);

		if ($tournament->name != $request->input('name')) {
			$tournament->name = $request->input('name');
		}
		if ($tournament->start_date != $request->input('start_date')) {
			$tournament->start_date = $request->input('start_date');
		}
		if ($tournament->end_date != $request->input('end_date')) {
			$tournament->end_date = $request->input('end_date');
		}
		$tournament->save();

		$languages = Languages::get();

		foreach ($languages as $lang) {
			if ($request->input($lang->code)) {
				$tour = TransTournament::where([
					'tournament_id' => $tournament->id,
					'lang_code'     => $lang->code
				])->first();
				if ($tour) {
					$tour->story = $request->input($lang->code);
					$tour->save();
				} else {
					TransTournament::create([
						'tournament_id' => $tournament->id,
						'lang_code'     => $lang->code,
						'story'         => $request->input($lang->code)
					]);
				}
			}
		}
		return redirect('admin/tournaments')->with('success', Lang::get('message.success.update'));
	}

	/**
     * Delete confirmation for the given Tournament.
     *
	 * @param  int      $id
     * @return View
    */
    public function getModalDelete($id = null)
    {
        $error          = '';
        $model          = '';
        $confirm_route  =  route('admin.tournaments.delete',['id'=>$id]);

        return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));
    }

    /**
     * Delete the given Tournament.
     *
     * @param  int      $id
     * @return Redirect
    */
    public function getDelete($id = null)
    {
        TransTournament::where('tournament_id', $id)->delete();
        Tournament::destroy($id);

        return redirect('admin/tournaments')->with('success', Lang::get('message.success.delete'));
    }
}
