<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Airportlist;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use App\Country;
use App\Cities;
class AirportlistsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$airportlists = Airportlist::paginate(20);
		return view('admin.airportlists.index', compact('airportlists'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
        $countries  = Country::lists("name", "id");
        $cities     = array();
        if(!empty($request->old("country_id"))) {
            $cities = Cities::where("country_id", "=", $request->old("country_id"))->get();
        }
        $country_id = ((!empty($request->old("country_id")))?$request->old("country_id"):"");
        $city_id    = ((!empty($request->old("city_id")))?$request->old("city_id"):"");
		return view('admin.airportlists.create', compact('countries', 'cities', 'country_id', 'city_id'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		airportlist::create($request->all());
		return redirect('admin/airportlists')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$airportlist = Airportlist::findOrFail($id);
		return view('admin.airportlists.show', compact('airportlist'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Request $request)
	{
        $airportlist = Airportlist::findOrFail($id);
        $country_id = ((!empty($request->old("country_id")))?$request->old("country_id"):$airportlist->country_id);
        $city_id    = ((!empty($request->old("city_id")))?$request->old("city_id"):$airportlist->city_id);
        $countries  = Country::lists("name", "id");
        $cities   = Cities::where("country_id", "=", $country_id)
            ->get();
		return view('admin.airportlists.edit', compact('airportlist', 'countries', 'cities', 'country_id', 'city_id'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$airportlist = Airportlist::findOrFail($id);
		$airportlist->update($request->all());
		return redirect('admin/airportlists')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Airportlist.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.airportlists.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Airportlist.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$airportlist = Airportlist::destroy($id);

            // Redirect to the group management page
            return redirect('admin/airportlists')->with('success', Lang::get('message.success.delete'));

    	}

}