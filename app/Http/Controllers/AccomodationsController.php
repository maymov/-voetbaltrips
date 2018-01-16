<?php 
namespace App\Http\Controllers;

use App\AccomodationOptions;
use App\AccomodationImages;
use App\Country;
use App\HotelOptions;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Accomodation;
use App\Http\Requests\AccomodationSaveRequest;
use App\Languages;
use App\TransAccomodation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use App\Cities;
use Validator;
use Illuminate\Support\Facades\File;
class AccomodationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$accomodations = Accomodation::get();
		return view('admin.accomodations.index', compact('accomodations'));
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
		$hotelOptions   = HotelOptions::lists('name');
        $countries      = Country::lists("name", "id");
        $languages      = Languages::get();

		return view('admin.accomodations.create', [
					"cities"        => $cities,
					"countries"     => $countries,
					"city_id"       => $city_id,
					"hotelOptions"  => $hotelOptions,
					"languages"     => $languages
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
	    $rules = array(
	        "name"                => "required",
            "address"             => "required",
            "country_id"          => "required",
            "city"                => "required",
            "stars"               => "required",
            "high_season_prices"  => array('required', 'regex:/^\d*(\.\d{2})?$/'),
            "low_season_prices"   => array('required', 'regex:/^\d*(\.\d{2})?$/'),
            "options"             => "required",
            "breakfast_price"     => array('required', 'regex:/^\d*(\.\d{2})?$/'),
		    "EN"                  => "required"
        );

        foreach($request->file("images") as $key => $images) {
            $rules[$key] = "image|mimes:png,jpg,jpeg,JPG,JPEG,PNG,gif,GIF|max:2048";
        }

	    $validator = Validator::make($request->all(), $rules);

	    if ($validator->fails()) {
            return redirect(url("admin/accomodations/create"))->withInput()->withErrors($validator);
        } else {
            $hotel = Accomodation::create([
                "name"                => $request->input("name"),
                "address"             => $request->input("address"),
                "country_id"          => $request->input("country_id"),
                "city"                => $request->input("city"),
                "stars"               => $request->input("stars"),
                "high_season_prices"  => $request->input("high_season_prices"),
                "low_season_prices"   => $request->input("low_season_prices"),
                "breakfast_price"     => $request->input("breakfast_price"),
            ]);


            $files = $request->file('images');

            foreach($files as $file) {
                $extension          = $file->getClientOriginalExtension();
                $newfilename        = str_random(5).uniqid().sha1(time().$file->getFilename().microtime()).rand(1,100000).str_random(10).".".$extension;
                $result             = @File::makeDirectory(public_path('uploads/hotel'), 0775, true, true);
                $destinationPath    = base_path() . '/public/uploads/hotel/';

                $file->move($destinationPath, $newfilename);

                AccomodationImages::create([
                    "accomodation_id" => $hotel->id,
                    "image" => $newfilename,
                ]);
            }

		    /**
		     * Add translate for description to DB
		     */
            $languages = Languages::get();

            foreach ($languages as $lang) {
                if ($request->input($lang->code)) {
                	TransAccomodation::create([
                		    'accomodation_id'   => $hotel->id,
		                    'lang_code'         => $lang->code,
		                    'description'       => $request->input($lang->code)
	                ]);
                }
            }
		    /**
		     * Add options to DB
		     */
            $options = explode(',', $request->input('options'));

            foreach ($options as $opt) {
            	$o = HotelOptions::where('name', trim($opt))->first();
            	if ($o) {
            		AccomodationOptions::create([
			            'accomodation_id'   => $hotel->id,
			            'option_id'         => $o->id
		            ]);
	            }
            }
            return redirect('admin/accomodations')->with('success', Lang::get('message.success.create'));
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$accomodation = Accomodation::with('images')->findOrFail($id);

		$options = $accomodation->getOptions->lists('name');
		$hotelOptions = '';

		foreach ($options as $o) {
			$hotelOptions .= $o .'; ';
		}
		return view('admin.accomodations.show', compact('accomodation', 'hotelOptions'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Request $request)
	{
		$accomodation   = Accomodation::with('images')->findOrFail($id);
        $country_id     = ((!empty($request->old("country_id")))?$request->old("country_id"):$accomodation->country_id);
        $cities         = Cities::where("country_id", "=", $country_id)
                            ->get();
        $countries      = Country::lists("name", "id");
        $city_id        = ((!empty($request->old("city")))?$request->old("city"):$accomodation->city);

        $options = '';
        $hotelOptions = $accomodation->getOptions->lists('name');

        foreach ($hotelOptions as $o) {
        	$options .= $o . ',';
        }

        $hotelOptions   = HotelOptions::lists('name');
        $languages      = Languages::get();

		return view('admin.accomodations.edit', compact('accomodation', 'cities', 'countries', 'city_id', 'country_id', 'options', 'hotelOptions', 'languages'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$acc_id = $id;
        $rules  = array(
            "name"                => "required",
            "address"             => "required",
            "country_id"          => "required",
            "city"                => "required",
            "stars"               => "required",
            "high_season_prices"  => "required",
            "low_season_prices"   => "required",
            "options"             => "required",
            "breakfast_price"     => "required"
        );

        if (!empty($request->file("images"))) {
            foreach($request->file("images") as $key => $images) {
                $rules[$key] = "image|mimes:png,jpg,jpeg,JPG,JPEG,PNG,gif,GIF|max:2048";
            }
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            /**
             * Send back to the accomodation edit page with errors
             */
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $hotel = Accomodation::find($acc_id);

        $hotel->name                = $request->input("name");
        $hotel->address             = $request->input("address");
        $hotel->city                = $request->input("city");
        $hotel->country_id          = $request->input("country_id");
        $hotel->stars               = $request->input("stars");
        $hotel->high_season_prices  = $request->input("high_season_prices");
        $hotel->low_season_prices   = $request->input("low_season_prices");
        $hotel->breakfast_price     = $request->input("breakfast_price");
        $files                      = $request->file('images');
        $removedImages              = $request->input('removedImages');

        if (!empty($files)) {

            foreach($files as $file) {
                $extension          = $file->getClientOriginalExtension();
                $newfilename        = str_random(5).uniqid().sha1(time().$file->getFilename().microtime()).rand(1,100000).str_random(10).".".$extension;
                $result             = @File::makeDirectory(public_path('uploads/hotel'), 0775, true, true);
                $destinationPath    = base_path() . '/public/uploads/hotel/';

                $file->move($destinationPath, $newfilename);

                AccomodationImages::create([
                    "accomodation_id" => $hotel->id,
                    "image" => $newfilename,
                ]);
            }
        }
        $hotel->save();

        if(!empty($removedImages)) {
            $removedImages = explode(',', $removedImages);

            foreach($removedImages as $image) {
                $remove = AccomodationImages::find($image);
                if(!empty($remove)) { 
                    unlink(base_path() . '/public/uploads/hotel/'.$remove->image);
                    $remove->delete();
                }
            }
        }

        $languages = Languages::get();
        foreach ($languages as $lang) {
        	if ($request->input($lang->code)) {
        		$trans = TransAccomodation::where([
        			'accomodation_id'   => $hotel->id,
			        'lang_code'         => $lang->code,
		        ])->first();
        		if ($trans) {
        			$trans->description = $request->input($lang->code);
        			$trans->save();
		        } else {
        			TransAccomodation::create([
				        'accomodation_id'   => $hotel->id,
				        'lang_code'         => $lang->code,
				        'description'       => $request->input($lang->code)
			        ]);
		        }
	        }
        }
		/**
		 * Option Edit
		 */
		$options = explode(',', $request->input('options'));

		AccomodationOptions::where('accomodation_id', $hotel->id)->delete();

		foreach ($options as $opt) {
			$o = HotelOptions::where('name', trim($opt))->first();
			if ($o) {
				AccomodationOptions::create([
					'accomodation_id'   => $hotel->id,
					'option_id'         => $o->id
				]);
			}
		}

        return redirect('admin/accomodations')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Accomodation.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error          = '';
            $model          = '';
            $confirm_route  =  route('admin.accomodations.delete',['id'=>$id]);
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
    		TransAccomodation::where('accomodation_id', $id)->delete();
    		Accomodation::destroy($id);

            $removedImages = AccomodationImages::where('accomodation_id', $id)->get();
            
            foreach($removedImages as $remove) {
                    unlink(base_path() . '/public/uploads/hotel/'.$remove->image);
                    $remove->delete();
            }

            return redirect('admin/accomodations')->with('success', Lang::get('message.success.delete'));
    	}
}
