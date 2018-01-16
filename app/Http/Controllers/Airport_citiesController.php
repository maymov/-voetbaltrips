<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Airport_city;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class Airport_citiesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$airport_cities = Airport_city::latest()->get();
		return view('admin.airport_cities.index', compact('airport_cities'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.airport_cities.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		airport_city::create($request->all());
		return redirect('admin/airport_cities')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$airport_city = Airport_city::findOrFail($id);
		return view('admin.airport_cities.show', compact('airport_city'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$airport_city = Airport_city::findOrFail($id);
		return view('admin.airport_cities.edit', compact('airport_city'));
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
		$airport_city = Airport_city::findOrFail($id);
		$airport_city->update($request->all());
		return redirect('admin/airport_cities')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Airport_city.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.airport_cities.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Airport_city.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$airport_city = Airport_city::destroy($id);

            // Redirect to the group management page
            return redirect('admin/airport_cities')->with('success', Lang::get('message.success.delete'));

    	}

}