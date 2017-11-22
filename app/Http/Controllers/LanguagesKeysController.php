<?php

namespace App\Http\Controllers;

use App\Languages;
use App\LanguagesKeys;
use App\LanKeys;
use Illuminate\Http\Request;
use SqlParser\Components\Key;
use Validator;
use Lang;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LanguagesKeysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $languages = Languages::get();

    	$keys = LanKeys::with('getLanguages', 'getValues')->get();
	    return view('admin.languages.keys.index', compact('keys' , 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $languages = Languages::get();
	    return view('admin.languages.keys.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$rules      = ["name" => "required|unique:lankeys,name"];
	    $validator  = Validator::make($request->all(), $rules);

	    if($validator->fails()) {
		    return redirect()->back()->withErrors($validator)->withInput();
	    }

		$lankey = LanKeys::create(["name" => $request->input('name')]);
	    $langs  = Languages::get();

	    foreach ($langs as $l) {
		    LanguagesKeys::create([
		    	"languages_id"  => $l->id,
			    "lan_keys_id"   => $lankey->id,
			    "value"         => ($request->input('val_' . strtolower($l->code))) ? $request->input('val_' . strtolower($l->code)) : $request->input('val_en')
		    ]);
	    }
	    return redirect('admin/language-keys')->with('success', Lang::get('message.success.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $key = LanKeys::with('getValues' , 'getLanguages')->find($id);
        return view('admin.languages.keys.show', compact('key'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $key = LanKeys::with('getValues' , 'getLanguages')->find($id);
	    return view('admin.languages.keys.edit', compact('key'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
	    $rules      = ["name" => "required"];
	    $validator  = Validator::make($request->all(), $rules);

	    if($validator->fails()) {
		    return redirect()->back()->withErrors($validator)->withInput();
	    }
	    $key = LanKeys::where('id', $id)->first();

	    if ($request->input('name') != $key->name) {
	    	$key->name = $request->input('name');
	    	$key->save();
	    }
		$keysVal = LanguagesKeys::where('lan_keys_id', $id)->get();

	    foreach ($keysVal as $val) {
	    	if (null !== ($request->input($val->languages_id))) {
	    		if ($val->value != $request->input($val->languages_id)) {
				    $val->value = $request->input($val->languages_id);
				    $val->save();
			    }
		    }
	    }

	    return redirect('admin/language-keys')->with('success', Lang::get('message.success.create'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
