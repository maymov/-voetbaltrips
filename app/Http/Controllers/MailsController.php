<?php

namespace App\Http\Controllers;

use App\Languages;
use App\TransMails;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Mails;
use Lang;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class MailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mail = Mails::get();

        return view('admin.mails.index', compact('mail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Languages::get();
        return view('admin.mails.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules      = ['name' => 'required|unique:mails,name'];
        $validator  = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
		    return redirect()->back()->withErrors($validator)->withInput();
	    }

	    $languages = Languages::get();

        $mail = Mails::create(['name' => $request->input('name')]);

        foreach ($languages as $lang) {
        	if ($request->input($lang->code) && $request->input('title_'.$lang->code)) {
        		TransMails::create([
        			'mail_id'   => $mail->id,
			        'lang_code' => $lang->code,
			        'title'     => $request->input('title_'.$lang->code),
			        'text'      => $request->input($lang->code)
		        ]);
	        }
        }
		return redirect('admin/mails')->with('success', Lang::get('message.success.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mail       = Mails::find($id);
        $languages  = Languages::get();
        return view('admin.mails.show', compact('languages', 'mail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mail       = Mails::find($id);
        $languages  = Languages::get();
        return view('admin.mails.edit', compact('mail', 'languages'));
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
	    $rules      = ['name' => 'required'];
	    $validator  = Validator::make($request->all(), $rules);

	    if ($validator->fails()) {
		    return redirect()->back()->withErrors($validator)->withInput();
	    }
	    $languages  = Languages::get();
	    $mail       = Mails::find($id);

	    if ($mail->name != $request->input('name')) {
	    	$mail->name = $request->input('name');
	    	$mail->save();
	    }
	    foreach ($languages as $lang) {
            if ($request->input($lang->code) && $request->input('title_'.$lang->code)) {
            	$trans = TransMails::where([
		                    'mail_id'   => $id,
				            'lang_code' => $lang->code
		            ])->first();
            	if ($trans) {
		            $trans->title = $request->input('title_'.$lang->code);
		            $trans->text = $request->input($lang->code);
		            $trans->save();
	            } else {
		            TransMails::create([
				            'mail_id'   => $id,
				            'lang_code' => $lang->code,
			                'title'     => $request->input('title_'.$lang->code),
		                    'text'      => $trans->text = $request->input($lang->code)
		            ]);
	            }
            }
	    }
	    return redirect('admin/mails')->with('success', Lang::get('message.success.edit'));
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
		$confirm_route  =  route('admin.mails.delete',['id'=>$id]);
		return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));
	}

	/**
	 * Delete the given Club.
	 *
	 * @param  int      $id
	 * @return Redirect
	 */
	public function getDelete($id = null)
	{
		TransMails::where('mail_id', $id)->delete();
		Mails::destroy($id);
		return redirect('admin/mails')->with('success', Lang::get('message.success.delete'));
	}
}
