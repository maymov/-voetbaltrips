<?php namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cities;
use App\Languages;
use App\TransCity;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use Validator;
class CitiesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
    {
		$cities = Cities::with('country')->get();
		return view('admin.cities.index', compact('cities'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$languages = Languages::get();
	    $countries = Country::lists("name", "id");
		return view('admin.cities.create', compact('countries' , 'languages'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $rules      = [
            "country_id" => "required",
            "name"       => "required|alpha_dash"
        ];
        $validator  = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
		    return redirect("admin/cities/create")
                ->withErrors($validator)
                ->withInput();
        }
		$languages  = Languages::get();
        $city       = Cities::create([
        	    'country_id'    => $request->input('country_id'),
	            'name'          => $request->input('name')
        ]);
		foreach ($languages as $lang) {
			if ($request->input($lang->code)) {
				TransCity::create([
						'city_id'       => $city->id,
						'lang_code'     => $lang->code,
						'trans_name'    => $request->input($lang->code)
				]);
			}
		}
		return redirect('admin/cities')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$city = Cities::with('getTranslate')->findOrFail($id);
		return view('admin.cities.show', compact('city'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$languages  = Languages::get();
		$city       = Cities::with('getTranslate')->findOrFail($id);
        $countries  = Country::lists("name", "id");
		return view('admin.cities.edit', compact('city', 'countries', 'languages'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
        $rules = [
            "name"       => "required|alpha_dash",
            "country_id" => "required"
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

		Cities::where('id', $id)->update([
			'name'          => $request->input('name'),
			'country_id'    => $request->input('country_id')
		]);

        $languages = Languages::get();
        foreach ($languages as $lang) {
        	if ($request->input($lang->code)) {
        		$cit = TransCity::where([
        			    'city_id'   => $id,
			            'lang_code' => $lang->code
		        ])->first();
        		if ($cit) {
        			$cit->trans_name = $request->input($lang->code);
        			$cit->save();
		        } else {
			        TransCity::create([
				        'city_id'   => $id,
				        'lang_code' => $lang->code,
				        'trans_name' => $request->input($lang->code)
			        ]);
		        }
	        }
        }
		return redirect('admin/cities')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given City.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error          = '';
            $model          = '';
            $confirm_route  =  route('admin.cities.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));
    	}

    	/**
    	 * Delete the given City.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		TransCity::where('city_id', $id)->delete();
    		Cities::destroy($id);
            return redirect('admin/cities')->with('success', Lang::get('message.success.delete'));
    	}
}
