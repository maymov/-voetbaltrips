<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class PaymentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$payments = Payment::latest()->get();
		return view('admin.payments.index', compact('payments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.payments.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		payment::create($request->all());
		return redirect('admin/payments')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$payment = Payment::findOrFail($id);
		return view('admin.payments.show', compact('payment'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$payment = Payment::findOrFail($id);
		return view('admin.payments.edit', compact('payment'));
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
		$payment = Payment::findOrFail($id);
		$payment->update($request->all());
		return redirect('admin/payments')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Payment.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.payments.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Payment.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$payment = Payment::destroy($id);

            // Redirect to the group management page
            return redirect('admin/payments')->with('success', Lang::get('message.success.delete'));

    	}

}