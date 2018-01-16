<?php namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Client;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class ClientsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$clients = Client::latest()->get();
		return view('admin.clients.index', compact('clients'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$companies = Company::lists('name', 'id');

		return view('admin.clients.create', compact('companies'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		client::create($request->all());
		return redirect('admin/clients')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$client = Client::findOrFail($id);
		return view('admin.clients.show', compact('client'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$companies = Company::lists('name', 'id');
		$client = Client::findOrFail($id);
		return view('admin.clients.edit', compact('client', 'companies'));
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
		$client = Client::findOrFail($id);
		$client->update($request->all());
		return redirect('admin/clients')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Client.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.clients.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Client.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$client = Client::destroy($id);

            // Redirect to the group management page
            return redirect('admin/clients')->with('success', Lang::get('message.success.delete'));

    	}

}