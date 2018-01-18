<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SeatingCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class SeatingcategoriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$seatingcategories = Seatingcategory::latest()->get();
		return view('admin.seatingcategories.index', compact('seatingcategories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.seatingcategories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		seatingcategory::create($request->all());
		return redirect('admin/seatingcategories')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$seatingcategory = Seatingcategory::findOrFail($id);
		return view('admin.seatingcategories.show', compact('seatingcategory'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$seatingcategory = Seatingcategory::findOrFail($id);
		return view('admin.seatingcategories.edit', compact('seatingcategory'));
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
		$seatingcategory = Seatingcategory::findOrFail($id);
		$seatingcategory->update($request->all());
		return redirect('admin/seatingcategories')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Seatingcategory.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.seatingcategories.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Seatingcategory.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$seatingcategory = Seatingcategory::destroy($id);

            // Redirect to the group management page
            return redirect('admin/seatingcategories')->with('success', Lang::get('message.success.delete'));

    	}

}