<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Plan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class PlansController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$plans = Plan::latest()->get();
		return view('admin.plans.index', compact('plans'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.plans.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		plan::create($request->all());
		return redirect('admin/plans')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$plan = Plan::findOrFail($id);
		return view('admin.plans.show', compact('plan'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$plan = Plan::findOrFail($id);
		return view('admin.plans.edit', compact('plan'));
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
		$plan = Plan::findOrFail($id);
		$plan->update($request->all());
		return redirect('admin/plans')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Plan.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.plans.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Plan.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$plan = Plan::destroy($id);

            // Redirect to the group management page
            return redirect('admin/plans')->with('success', Lang::get('message.success.delete'));

    	}

}