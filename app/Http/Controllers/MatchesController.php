<?php namespace App\Http\Controllers;

use App\Club;
use App\Competition_seating;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Match;
use App\Stadium;
use App\Tournament;
use App\SeatingCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use App\Country;
use App\Cities;
use App\Http\Requests\StoreMatchesRequest;
use Validator;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\LogCSVUpload;
class MatchesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$matches = Match::orderBy('match_date')->get();

		$matchInfo = [];
		foreach ($matches as $match) {
			$matchInfo[$match->id] = [
				'home_club'     => $match->getHomeClub->name,
				'away_club'     => $match->getAwayClub->name,
				'fixed_data'    => $match->fixed_data,
				'date'          => date('d-m-Y H:i:s', strtotime($match->match_date)),
				'discount'      => 0,
				'cat1_count'    => 0,
				'cat1_price'    => 0,
				'cat2_count'    => 0,
				'cat2_price'    => 0,
				'cat3_count'    => 0,
				'cat3_price'    => 0
			];
			$seats = Competition_seating::where('matches_id', $match->id)->get();
			foreach ($seats as $s) {
				$matchInfo[$match->id]['discount'] = $s->discount;
				if ($s->seatingcategory_id == 2) {
					$matchInfo[$match->id]['cat1_price'] = $s->price;
				} else if ($s->seatingcategory_id == 3) {
					$matchInfo[$match->id]['cat2_price'] = $s->price;
				} else if ($s->seatingcategory_id == 4) {
					$matchInfo[$match->id]['cat3_price'] = $s->price;
				}

				$orders_match = DB::table("orders_match")
					->selectRaw("sum(orders_match.quantity) as sold_ticket")
					->where("orders_match.matches_id", "=", $match->id)
					->where("orders_match.seat_type", "=", $s->id)
					->join("orders", "orders.id", "=", "orders_match.orders_id")
					->where("orders.payment_status", "=", 2)
					->first();
				if ($s->seatingcategory_id == 2) {
					$matchInfo[$match->id]['cat1_count'] = $s->quantity_available - $orders_match->sold_ticket;
				} else if ($s->seatingcategory_id == 3) {
					$matchInfo[$match->id]['cat2_count'] = $s->quantity_available - $orders_match->sold_ticket;
				} else if ($s->seatingcategory_id == 4) {
					$matchInfo[$match->id]['cat3_count'] = $s->quantity_available - $orders_match->sold_ticket;
				}
			}
		}
		return view('admin.matches.index', compact('matchInfo'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tournaments = Tournament::lists('name','id');
		$clubs   = Club::lists('name','id');
		$stadia  = Stadium::lists('stadium','id');
		$categ = SeatingCategory::lists('name', 'id');

        return view('admin.matches.create', compact('tournaments', 'clubs', 'stadia', 'country', 'cities', 'categ' ));

//		return view('admin.matches.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules = [
            "tournament" => "required",
            "stadium"    => "required",
            "home_club"  => "required",
            "away_club"  => "required",
            "match_date" => "required",
            "image"      => "required|image|mimes:jpg,png,jpeg,gif,JPG,JPEG,PNG,GIF|max:2048",
			"fixed_data" => "required"
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!file_exists(public_path()."/uploads/matches")){
            mkdir(public_path()."/uploads/matches",755);
        }

        $image     = $request->file("image");
        $filename  = md5(uniqid(rand(), true)).str_random().time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path()."/uploads/matches", $filename);
        $data = [
            "tournament"  => $request->input("tournament"),
            "stadium"     => $request->input("stadium"),
            "home_club"   => $request->input("home_club"),
            "away_club"   => $request->input("away_club"),
            "match_date"  => $request->input("match_date"),
            "image_name"  => $filename,
	        "fixed_data"  => $request->input("fixed_data")
        ];
        $match = Match::create($data);

        if ($match) {
        	$prices = [];

        	for ($i = 1; $i < 4; $i++) {
		        $prices[] = [
			        'matches_id' => $match->id,
			        'seatingcategory_id' => $i+1,
			        'price' => (empty($request->input('price'.$i))) ? 0 : $request->input('price'.$i),
			        'quantity_available' => (empty($request->input('quant'.$i))) ? 0 : $request->input('quant'.$i),
			        'discount'  => (empty($request->input('discount'))) ? 0 : $request->input('discount'),
			        'total_price' => (round(floatval($request->input('price'.$i)), 2) - round(floatval($request->input('discount'))) > 0) ? round(floatval($request->input('price'.$i)), 2) - round(floatval($request->input('discount'))) : 0
		        ];
	        }
        }
		foreach (array_chunk($prices,1000) as $p) {
			Competition_seating::insert($p);
		}
		return redirect('admin/matches')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$match      = Match::findOrFail($id);
		$tickets    = Competition_seating::with('seatingCategory')->where('matches_id', $match->id)->orderBy('price')->get();
		$matchInfo  = [
			'id'            => $match->id,
			'tournament'    => $match->getTournament->name,
			'stadium'       => $match->getStadium->stadium,
			'home_club'     => $match->getHomeClub->name,
			'away_club'     => $match->getAwayClub->name,
			'fixed_data'    => $match->fixed_data,
			'image'         => $match->image_name,
			'date'          => date('d-m-Y H:i:s', strtotime($match->match_date)),
			'discount'      => 0,
			'cat1_name'     => '',
			'cat1_count'    => 0,
			'cat1_sold'     => 0,
			'cat1_price'    => 0,
			'cat2_name'     => '',
			'cat2_count'    => 0,
			'cat2_sold'     => 0,
			'cat2_price'    => 0,
			'cat3_name'     => '',
			'cat3_count'    => 0,
			'cat3_sold'     => 0,
			'cat3_price'    => 0,
		];
		foreach ($tickets as $t) {
			if ($t->seatingcategory_id == 2) {
				$matchInfo['cat1_name']     = $t->seatingCategory->name;
				$matchInfo['cat1_count']    = $t->quantity_available;
				$matchInfo['cat1_price']    = $t->price;
				$matchInfo['discount']      = $t->discount;
			} else if ($t->seatingcategory_id == 3) {
				$matchInfo['cat2_name']     = $t->seatingCategory->name;
				$matchInfo['cat2_count']    = $t->quantity_available;
				$matchInfo['cat2_price']    = $t->price;
				$matchInfo['discount']      = $t->discount;
			} else if ($t->seatingcategory_id == 4) {
				$matchInfo['cat3_name']     = $t->seatingCategory->name;
				$matchInfo['cat3_count']    = $t->quantity_available;
				$matchInfo['cat3_price']    = $t->price;
				$matchInfo['discount']      = $t->discount;
			}
			$orders_match = DB::table("orders_match")
				->selectRaw("sum(orders_match.quantity) as sold_ticket")
				->where("orders_match.matches_id", "=", $match->id)
				->where("orders_match.seat_type", "=", $t->id)
				->join("orders", "orders.id", "=", "orders_match.orders_id")
				->where("orders.payment_status", "=", 2)
				->first();
			if ($t->seatingcategory_id == 2) {
				$matchInfo['cat1_sold'] = (!empty($orders_match->sold_ticket)) ? $orders_match->sold_ticket : 0 ;
			} else if ($t->seatingcategory_id == 3) {
				$matchInfo['cat2_sold'] = (!empty($orders_match->sold_ticket)) ? $orders_match->sold_ticket : 0 ;
			} else if ($t->seatingcategory_id == 4) {
				$matchInfo['cat3_sold'] = (!empty($orders_match->sold_ticket)) ? $orders_match->sold_ticket : 0 ;
			}
		}
		return view('admin.matches.show', compact('matchInfo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$match          = Match::findOrFail($id);
		$tournaments    = Tournament::lists('name','id');
		$clubs          = Club::lists('name','id');
		$stadia         = Stadium::lists('stadium','id');
		$prices         = Competition_seating::where('matches_id', $id)->get();

		foreach ($prices as $p) {
			$discount = $p->discount;
		}
		$priceArr = [];

		foreach ($prices as $p) {
			$priceArr[$p->seatingcategory_id - 1] = [
				'price' => $p->price,
				'quantity' => $p->quantity_available
			];
		}
		return view('admin.matches.edit', compact('match', 'tournaments', 'clubs', 'stadia', 'country', 'cities', 'priceArr', 'discount'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$match = Match::findOrFail($id);
        $rules = [
            "tournament" => "required",
            "stadium"    => "required",
            "home_club"  => "required",
            "away_club"  => "required",
            "match_date" => "required",
            "fixed_data" => "required"
        ];
        if ($request->file("image")) {
            $rules["image"] = "required|image|mimes:jpg,png,jpeg,gif,JPG,JPEG,PNG,GIF|max:2048";
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = [
            "tournament"  => $request->input("tournament"),
            "stadium"     => $request->input("stadium"),
            "home_club"   => $request->input("home_club"),
            "away_club"   => $request->input("away_club"),
            "match_date"  => $request->input("match_date"),
	        "fixed_data"  => $request->input("fixed_data")
        ];
        if ($request->file("image")) {
            $old_file  = $match->image_name;
            $image     = $request->file("image");
            $filename  = md5(uniqid(rand(), true)).str_random().time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path()."/uploads/matches", $filename);
            $data['image_name'] = $filename;
            @unlink(public_path()."/uploads/matches/".$old_file);
        }
		$match->update($data);

		$prices = [];
		for ($i = 1; $i < 4; $i++) {
	        $prices[] = [
                'matches_id'            => $match->id,
	            'seatingcategory_id'    => $i+1,
	            'price'                 => $request->input('price'.$i),
	            'quantity_available'    => $request->input('quant'.$i),
	            'discount'              => $request->input('discount'),
	            'total_price'           => (round(floatval($request->input('price'.$i)), 2) - round(floatval($request->input('discount'))) > 0) ? round(floatval($request->input('price'.$i)), 2) - round(floatval($request->input('discount'))) : 0
            ];
		}

		if (!empty($prices)) {
			Competition_seating::where('matches_id', $match->id)->delete();
			Competition_seating::insert($prices);
		}
		return redirect('admin/matches')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Match.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error          = '';
            $model          = '';
            $confirm_route  =  route('admin.matches.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));
    	}
    	/**
    	 * Delete the given Match.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$match = Match::destroy($id);
            return redirect('admin/matches')->with('success', Lang::get('message.success.delete'));
    	}
    	public function uploadCsvFile(Request $request)
	    {
            $resp['status']   = "error";
            $resp['message']  = "Please upload a valid CSV File";
            $rules            = [
                "csvfile"    => "required|mimes:'application/vnd.ms-excel','text/plain','text/csv','text/tsv'",
            ];
            $validator        = Validator::make($request->all(), $rules);
            if($validator->valid()) {
                $data = Excel::load($request->file("csvfile"), function($reader) {
                })->get();

                if(!empty($data) and $data->count()) {
                    $i = 0;
                    foreach ($data as $key => $value) {
                        /***
                         * Check that tournament is exist in the database
                         * if the tournament is exist then take the id of tournament
                         */
                       foreach($value as $k => $v ){

                        $match = explode(';',$v);

                        $tournament = Tournament::where("name", "=", $match[3])->first();
                        if(!empty($tournament->id)) {
                            $stadium    = Stadium::where("stadium", "=", $match[2])->first();
                            $home_club         = Club::where("name", "=", $match[0])->first();    
                            $away_club  = Club::where("name", "=", $match[1])->first();

	                        $arr = explode('-', $match[4]);
	                        $str = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
                            if($match[5]){
                                $match_date = date("Y-m-d H:i:s", strtotime($str." ".$match[5]));
                            }
                            else{    
                            $match_date = date("Y-m-d H:i:s", strtotime($str));
                            }
//                            if (!$away_club->id || !$home_club->id) {
//                            	dd($away_club->id, $home_club->id, $match[0], $match[1]);
//                            }
                            $check_match = Match::where("tournament", "=", $tournament->id)
                                ->where('stadium', "=", $stadium->id)
                                ->where('home_club', "=", $home_club->id)
                                ->where('away_club', "=", $away_club->id)
                                ->where('match_date', "=", date('Y-m-d H:i:s', strtotime($match_date)))
                                ->first();
	                        if($check_match === null) {
	                            $prices    = [];
                            	$match_now = new Match;

                            	$match_now->tournament  = $tournament->id;
                            	$match_now->stadium     = 	$stadium->id;
	                            $match_now->home_club   = $home_club->id;
                                $match_now->away_club   = $away_club->id;
                                $match_now->match_date  = $match_date;
		                        $match_now->fixed_data  = $match[6];
                                $match_now->created_at  = date("Y-m-d H:i:s");
                                $match_now->updated_at  = date("Y-m-d H:i:s");
                                $match_now->save();
                                $i++;

	                            $prices[] = [
		                            'matches_id'    => $match_now->id,
		                            'seatingcategory_id'    => 2,
		                            'price'                 => (isset($match[9])) ? round(floatval($match[9]), 2) : 0,
	                                'quantity_available'    => (isset($match[8])) ? intval($match[8]): 0,
		                            'discount'              => (isset($match[7])) ? round(floatval($match[7]), 2) : 0,
		                            'total_price'           => (isset($match[7]) && isset($match[7])) ? round(floatval($match[7]), 2) - round(floatval($match[7]), 2) : 0
	                            ];

	                            $prices[] = [
		                            'matches_id'    => $match_now->id,
		                            'seatingcategory_id'    => 3,
		                            'price'                 => (isset($match[11])) ? round(floatval($match[11]), 2) : 0,
		                            'quantity_available'    => (isset($match[10])) ? intval($match[10]) : 0,
		                            'discount'              => (isset($match[7])) ? round(floatval($match[7]), 2) : 0,
		                            'total_price'           => (isset($match[7]) && isset($match[11])) ? round(floatval($match[11]), 2) - round(floatval($match[7]), 2) : 0
	                            ];

	                            $prices[] = [
		                            'matches_id'    => $match_now->id,
		                            'seatingcategory_id'    => 4,
		                            'price'                 => (isset($match[13])) ? round(floatval($match[13]), 2) : 0,
		                            'quantity_available'    => (isset($match[12])) ? intval($match[12]) : 0,
		                            'discount'              => (isset($match[7])) ? round(floatval($match[7]), 2) : 0,
		                            'total_price'           => (isset($match[7]) && isset($match[13])) ? round(floatval($match[13]), 2) - round(floatval($match[7]), 2) : 0
	                            ];

	                            foreach (array_chunk($prices,1000) as $p) {
		                            Competition_seating::insert($p);
	                            }
                            }
                        }
                      }  

                    }

                    if($i != 0) {
                        $log = [
                            "type"          => 2,
                            "success_entry" => $i,
                            "fail_entry"    => (count($data) - $i),
                            "message"       => 'Matches CSV uploaded Successfully.'
                        ];
                        $resp['status']  = "success";
                        $resp['message'] = "Matches CSV uploaded successfully.";
                    } else {
                        $log = [
                            "type"          => 2,
                            "success_entry" => 0,
                            "fail_entry"    => count($data),
                            "message"       => 'There is no new data to import.'
                        ];
                        $resp['message']    = "There is no new data to import.";
                    }
                    LogCSVUpload::create($log);
                }
            }
            return response()->json($resp);
        }

    public function getModalEmpty()
    {
        $error          = '';
        $model          = '';
        $confirm_route  =  route('admin.matches.empty');
        return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));
    }

    public function emptyMatches()
    {
        DB::table('matches')->truncate();
        return redirect('admin/matches')->with('success', Lang::get('message.empty.empty'));
    }
}
