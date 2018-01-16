<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invoice_line;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class Invoice_linesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$invoice_lines = Invoice_line::latest()->get();
		return view('admin.invoice_lines.index', compact('invoice_lines'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.invoice_lines.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		invoice_line::create($request->all());
		return redirect('admin/invoice_lines')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$invoice_line = Invoice_line::findOrFail($id);
		return view('admin.invoice_lines.show', compact('invoice_line'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$invoice_line = Invoice_line::findOrFail($id);
		return view('admin.invoice_lines.edit', compact('invoice_line'));
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
		$invoice_line = Invoice_line::findOrFail($id);
		$invoice_line->update($request->all());
		return redirect('admin/invoice_lines')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Invoice_line.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.invoice_lines.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Invoice_line.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$invoice_line = Invoice_line::destroy($id);

            // Redirect to the group management page
            return redirect('admin/invoice_lines')->with('success', Lang::get('message.success.delete'));

    	}

}