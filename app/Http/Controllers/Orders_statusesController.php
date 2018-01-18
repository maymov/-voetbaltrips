<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OrdersStatus;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class Orders_statusesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$orders_statuses = OrdersStatus::latest()->get();
		return view('admin.orders_statuses.index', compact('orders_statuses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.orders_statuses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        OrdersStatus::create($request->all());
		return redirect('admin/orders_statuses')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$orders_status = OrdersStatus::findOrFail($id);
		return view('admin.orders_statuses.show', compact('orders_status'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$orders_status = OrdersStatus::findOrFail($id);
		return view('admin.orders_statuses.edit', compact('orders_status'));
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
		$orders_status = OrdersStatus::findOrFail($id);
		$orders_status->update($request->all());
		return redirect('admin/orders_statuses')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Orders_status.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.orders_statuses.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Orders_status.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$orders_status = OrdersStatus::destroy($id);

            // Redirect to the group management page
            return redirect('admin/orders_statuses')->with('success', Lang::get('message.success.delete'));

    	}

}