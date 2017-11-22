<?php

namespace App\Http\Controllers;

use App\HotelOptions;
use App\Languages;
use App\TransOptions;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Lang;

class HotelOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = HotelOptions::get();
        return view('admin.hotel-options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Languages::get();
        return view('admin.hotel-options.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules      = ['name' => 'required|unique:hotel_options,name'];
        $validator  = Validator::make($request->all(), $rules);

	    if ($validator->fails()) {
		    return redirect(url("admin/hotel-options/create"))->withInput()->withErrors($validator);
	    }

	    $option     = HotelOptions::create(['name' => $request->input('name')]);
	    $languages  = Languages::get();

	    foreach ($languages as $lang) {
	    	if ($request->input($lang->code)) {
	    		TransOptions::create([
                    'lang_code'     => $lang->code,
			        'option_id'     => $option->id,
			        'trans_name'    => $request->input($lang->code)
			    ]);
		    }
	    }
	    return redirect('admin/hotel-options')->with('success', Lang::get('message.success.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$option = HotelOptions::findorFail($id);
		return view('admin.hotel-options.show', compact('option'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$languages  = Languages::get();
        $option     = HotelOptions::findorFail($id);
        return view('admin.hotel-options.edit', compact('option', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rule       = ['name' => 'required'];
        $validator  = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
		    return redirect(url("admin/hotel-options/edit"))->withInput()->withErrors($validator);
	    }

        $option = HotelOptions::findorFail($id);

        if ($option->name != $request->input('name')) {
        	$option->name = $request->input('name');
        }
        $option->save();
        $languages = Languages::get();

        foreach ($languages as $lang) {
        	if ($request->input($lang->code)) {
        		$opt = TransOptions::where([
        			    'lang_code' => $lang->code,
			            'option_id' => $option->id
		        ])->first();
        		if ($opt) {
        			$opt->trans_name = $request->input($lang->code);
        			$opt->save();
		        } else {
			        TransOptions::create([
				        'lang_code'     => $lang->code,
				        'option_id'     => $option->id,
				        'trans_name'    => ($request->input($lang->code)) ? $request->input($lang->code) : 'undefined'
			        ]);
		        }
	        }
        }
	    return redirect('admin/hotel-options')->with('success', Lang::get('message.success.edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function getModalDelete($id = null)
	{
		$error          = '';
		$model          = '';
		$confirm_route  =  route('admin.hotel-options.delete',['id'=>$id]);
		return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));
	}

	/**
	 * Delete the given Accomodation.
	 *
	 * @param  int      $id
	 * @return Redirect
	 */
	public function getDelete($id = null)
	{
		HotelOptions::destroy($id);
		return redirect('admin/hotel-options')->with('success', Lang::get('message.success.delete'));
	}
}

