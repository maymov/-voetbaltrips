<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class ExpensesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$expenses = Expense::latest()->get();
		return view('admin.expenses.index', compact('expenses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.expenses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		expense::create($request->all());
		return redirect('admin/expenses')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$expense = Expense::findOrFail($id);
		return view('admin.expenses.show', compact('expense'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$expense = Expense::findOrFail($id);
		return view('admin.expenses.edit', compact('expense'));
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
		$expense = Expense::findOrFail($id);
		$expense->update($request->all());
		return redirect('admin/expenses')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Expense.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.expenses.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Expense.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$expense = Expense::destroy($id);

            // Redirect to the group management page
            return redirect('admin/expenses')->with('success', Lang::get('message.success.delete'));

    	}

}