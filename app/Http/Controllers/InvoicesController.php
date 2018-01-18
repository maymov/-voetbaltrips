<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Lang;

class InvoicesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$invoices = Invoice::latest()->get();
		return view('admin.invoices.index', compact('invoices'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.invoices.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		invoice::create($request->all());

		// Send an email to the user and optionally to the admin.
		// The admin should receive paid orders only in the near future.
//        Mail::send('emails.register-activate', $data, function ($m) use ($user) {
//            $m->to($user->email, $user->first_name . ' ' . $user->last_name);
//            $m->subject('Dear ' . $user->first_name . '! Active your account');
//        });

		return redirect('admin/invoices')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$invoice = Invoice::findOrFail($id);
		return view('admin.invoices.show', compact('invoice'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$invoice = Invoice::findOrFail($id);
		return view('admin.invoices.edit', compact('invoice'));
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
		$invoice = Invoice::findOrFail($id);
		$invoice->update($request->all());
		return redirect('admin/invoices')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Invoice.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.invoices.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Invoice.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$invoice = Invoice::destroy($id);

            // Redirect to the group management page
            return redirect('admin/invoices')->with('success', Lang::get('message.success.delete'));

    	}

}