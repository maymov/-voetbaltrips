<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\StadiumSaveRequest;
use App\Stadium;
use App\TransStadia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use App\Cities;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Country;
use App\Airportlist;
use App\Languages;

class StadiaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $stadia = Stadium::latest()->get();
		return view('admin.stadia.index', compact('stadia'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$cities  = array();
		$city_id = '';
		if (!empty($request->old("country_id"))) {
			$cities   = Cities::where("country_id", "=", $request->old("country_id"))
							->get();
			$city_id  = $request->old("city"); 				
		}

		$countries  = Country::lists("name", "id");
		$airports   = Airportlist::lists("title", "id");
		$languages  = Languages::get();

		return view('admin.stadia.create', [
						"cities"    => $cities,
						"countries" => $countries,
						"city_id"   => $city_id,
						"airports"  => $airports,
						"languages" => $languages
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 * @return Response
	 */
	public function store(StadiumSaveRequest $request)
	{
        $file               = $request->file('image');
        $extension          = $file->getClientOriginalExtension();
        $newfilename        = str_random(5).uniqid().sha1(time().$file->getFilename().microtime()).rand(1,100000).str_random(10).".".$extension;
        $result             = File::makeDirectory(public_path('uploads/stadiums'), 0775, true, true);
        $destinationPath    = base_path() . '/public/uploads/stadiums/';

        $file->move($destinationPath, $newfilename);

        $stadium                    = new Stadium();
        $stadium->stadium           = $request->input("stadium");
        $stadium->country_id        = $request->input("country_id");
        $stadium->city              = $request->input("city");
        $stadium->nearest_airport   = $request->input("airport");
        $stadium->image             = $newfilename;
        $stadium->mime              = $file->getClientMimeType();
        $stadium->filename          = $file->getClientOriginalName();
        $stadium->save();

        $languages = Languages::get();
        foreach ($languages as $lang) {
        	if ($request->input($lang->code)) {
        		TransStadia::create([
                    'stadia_id' => $stadium->id,
			        'lang_code' => $lang->code,
			        'story'     => $request->input($lang->code)
		        ]);
	        }
        }
		return redirect('admin/stadia')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$stadium = Stadium::findOrFail($id);
		return view('admin.stadia.show', compact('stadium'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$stadium    = Stadium::findOrFail($id);
		$cities     = Cities::where("country_id", "=", $stadium->country_id)
							->get();
		$countries  = Country::lists("name", "id");
        $airports   = Airportlist::lists("title", "id");
        $languages  = Languages::get();
		return view('admin.stadia.edit', compact('stadium', 'cities', 'countries', 'airports', 'languages'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
	    $stadium_id     = $id;
	    $rules          = [
	            "stadium"   => "required",
                "city"      => "required",
                "airport"   => "required"
        ];

        if (!empty($request->file("image"))) {
            $rules['image'] = 'required|mimes:png,jpg,jpeg,gif,bmp,svg,JPG,JPEG,PNG,GIF,BMP,SVG|max:2048';
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
        $stadium                    = Stadium::find($stadium_id);
        $stadium->stadium           = $request->input("stadium");
        $stadium->country_id        = $request->input("country_id");
        $stadium->city              = $request->input("city");
        $file                       = $request->file('image');
        $stadium->nearest_airport   = $request->input("airport");

        if(!empty($file)){
            $extension          = $file->getClientOriginalExtension();
            $newfilename        = str_random(5).uniqid().sha1(time().$file->getFilename().microtime()).rand(1,100000).str_random(10).".".$extension;
            @unlink(base_path()."/public/uploads/stadiums/".$stadium->image);
            $destinationPath = base_path() . '/public/uploads/stadiums/';
            $file->move($destinationPath, $newfilename);
            $stadium->image     = $newfilename;
            $stadium->mime      = $file->getClientMimeType();
            $stadium->filename  = $file->getClientOriginalName();
        }
        $stadium->save();

        $languages = Languages::get();

        foreach ($languages as $lang) {
        	if ($request->input($lang->code)) {
		        $stad = TransStadia::where([
		        	    'stadia_id' => $stadium->id,
			            'lang_code' => $lang->code
		        ])->first();

		        if ($stad) {
		        	$stad->story = $request->input($lang->code);
		        	$stad->save();
		        } else {
			        TransStadia::create([
				        'stadia_id' => $stadium->id,
				        'lang_code' => $lang->code,
				        'story'     => $request->input($lang->code)
			        ]);
		        }
	        }
        }
		return redirect('admin/stadia')->with('success', Lang::get('message.success.update'));
	}

	/**
     * Delete confirmation for the given Stadium.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $error          = '';
        $model          = '';
        $confirm_route  =  route('admin.stadia.delete',['id'=>$id]);
        return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));
    }

    /**
     * Delete the given Stadium.
     *
     * @param  int      $id
     * @return Redirect
     */
    public function getDelete($id = null)
    {
        TransStadia::where('stadia_id', $id)->delete();
        Stadium::destroy($id);
        return redirect('admin/stadia')->with('success', Lang::get('message.success.delete'));
    }
}
