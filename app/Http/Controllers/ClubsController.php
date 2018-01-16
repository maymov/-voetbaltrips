<?php namespace App\Http\Controllers;

use App\Cities;
use App\Country;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Club;
use App\Languages;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use Validator;
use App\TransClub;

class ClubsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$clubs = Club::latest()->get();
		return view('admin.clubs.index', compact('clubs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
	    $countries  = Country::lists("name", "id");
	    $languages  = Languages::get();
        $cities     = array();
        if (!empty($request->old("country"))) {
            $cities = Cities::where("country_id", "=", $request->old("country"))->get();
        }
        $country_id = ((!empty($request->old("country")))?$request->old("country"):"");
        $city_id    = ((!empty($request->old("city")))?$request->old("city"):"");
		return view('admin.clubs.create', compact('countries', 'cities', 'city_id', 'country_id', 'languages'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
	    $rules = [
	        "name"    => "required",
            "country" => "required",
            "city"    => "required",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

		$data = [
			'name'      => $request->input('name'),
			'country'   => $request->input('country'),
			'city'      => $request->input('city'),
		];

		if ($request->file("emblem")) {
			if (!file_exists(public_path() . "/uploads/teamemblems")) {
				mkdir(public_path() . "/uploads/teamemblems", 755);
			}

			$emblem     = $request->file("emblem");
			$filename   = md5(uniqid(rand(), true)) . str_random() . time() . '.' . $emblem->getClientOriginalExtension();

			$emblem->move(public_path() . "/uploads/teamemblems", $filename);
			$data['emblem'] = $filename;
		}

		$club = club::create($data);

		$languages = Languages::get();

		foreach ($languages as $lang) {
			if ($request->input($lang->code)) {
				TransClub::create([
					'club_id'   => $club->id,
					'lang_code' => $lang->code,
					'story'     => $request->input($lang->code)
				]);
			}
		}

		return redirect('admin/clubs')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$club       = Club::findOrFail($id);
		$languages  = Languages::get();
		return view('admin.clubs.show', compact('club', 'languages'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Request $request)
	{
		$club       = Club::findOrFail($id);
        $country_id = ((!empty($request->old("country")))?$request->old("country"):$club->country);
        $cities     = Cities::where("country_id", "=", $country_id)
            ->get();
        $countries  = Country::lists("name", "id");
        $languages  = Languages::get();
        $city_id    = ((!empty($request->old("city")))?$request->old("city"):$club->city);
		return view('admin.clubs.edit', compact('club', 'countries', 'cities', 'country_id', 'city_id', 'languages'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
        $rules        = [
            "name"    => "required",
            "country" => "required",
            "city"    => "required",
        ];
        $validator    = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
		$club = Club::findOrFail($id);

        $data = [
        	'name'      => $request->input('name'),
        	'country'   => $request->input('country'),
        	'city'      => $request->input('city')
        ];

		if ($request->file("emblem")) {
			if (!file_exists(public_path()."/uploads/teamemblems")) {
				mkdir(public_path()."/uploads/teamemblems",755);
			}

			$old_file   = $club->emblem;
			$emblem     = $request->file("emblem");
			$filename   = md5(uniqid(rand(), true)).str_random().time().'.'.$emblem->getClientOriginalExtension();

			$emblem->move(public_path() . "/uploads/teamemblems", $filename);
			$data['emblem'] = $filename;

			@unlink(public_path()."/uploads/teamemblems/".$old_file);
		}

		$club->update($data);
		$languages = Languages::get();

		foreach ($languages as $lang) {
			if ($request->input($lang->code)) {
				$trans = TransClub::where(['club_id' => $club->id, 'lang_code' => $lang->code])->first();
				if ($trans) {
					$trans->story = $request->input($lang->code);
					$trans->save();
				} else {
					TransClub::create([
							'club_id'   => $club->id,
							'lang_code' => $lang->code,
							'story'     => $request->input($lang->code)
					]);
				}
			}
		}
		return redirect('admin/clubs')->with('success', Lang::get('message.success.update'));
	}

		/**
    	 * Delete confirmation for the given Club.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error          = '';
            $model          = '';
            $confirm_route  =  route('admin.clubs.delete',['id'=>$id]);
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
    		TransClub::where('club_id', $id)->delete();
    		Club::destroy($id);
            return redirect('admin/clubs')->with('success', Lang::get('message.success.delete'));
    	}
}
