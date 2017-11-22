<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Payment_method;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class Payment_methodsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$payment_methods = Payment_method::latest()->get();
		return view('admin.payment_methods.index', compact('payment_methods'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.payment_methods.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		payment_method::create($request->all());
		return redirect('admin/payment_methods')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$payment_method = Payment_method::findOrFail($id);
		return view('admin.payment_methods.show', compact('payment_method'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$payment_method = Payment_method::findOrFail($id);
		return view('admin.payment_methods.edit', compact('payment_method'));
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
		$payment_method = Payment_method::findOrFail($id);
		$payment_method->update($request->all());
		return redirect('admin/payment_methods')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Payment_method.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.payment_methods.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Payment_method.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$payment_method = Payment_method::destroy($id);

            // Redirect to the group management page
            return redirect('admin/payment_methods')->with('success', Lang::get('message.success.delete'));

    	}

}