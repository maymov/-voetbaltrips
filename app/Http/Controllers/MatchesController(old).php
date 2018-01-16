<?php namespace App\Http\Controllers;

use App\Club;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Match;
use App\Stadium;
use App\Tournament;
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
		$matches = Match::latest()->get();
        //dd($matches);

         // $check_match = Match::where("home_club", "=", 1)
         //                        ->where('away_club', "=", 3)
         //                        ->where('match_date', "=", date("Y-m-d","2017-05-10"))
         //                        ->first();

        //dd($check_match);
		return view('admin.matches.index', compact('matches'));
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
        return view('admin.matches.create', compact('tournaments', 'clubs', 'stadia', 'country', 'cities'));
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
            "image"      => "required|image|mimes:jpg,png,jpeg,gif,JPG,JPEG,PNG,GIF|max:2048"
        ];
        $validator = Validator::make($request->all(), $rules);
		if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if(!file_exists(public_path()."/uploads/matches")){
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
            "image_name"  => $filename
        ];
        match::create($data);
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
		$match = Match::findOrFail($id);
		return view('admin.matches.show', compact('match'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$match = Match::findOrFail($id);
		$tournaments = Tournament::lists('name','id');
		$clubs = Club::lists('name','id');
		$stadia = Stadium::lists('stadium','id');
		return view('admin.matches.edit', compact('match', 'tournaments', 'clubs', 'stadia', 'country', 'cities'));
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
		$match = Match::findOrFail($id);
        $rules = [
            "tournament" => "required",
            "stadium"    => "required",
            "home_club"  => "required",
            "away_club"  => "required",
            "match_date" => "required"
        ];
        if($request->file("image")) {
            $rules["image"] = "required|image|mimes:jpg,png,jpeg,gif,JPG,JPEG,PNG,GIF|max:2048";
        }
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data = [
            "tournament"  => $request->input("tournament"),
            "stadium"     => $request->input("stadium"),
            "home_club"   => $request->input("home_club"),
            "away_club"   => $request->input("away_club"),
            "match_date"  => $request->input("match_date"),
        ];
        if($request->file("image")) {
            $old_file  = $match->image_name;
            $image     = $request->file("image");
            $filename  = md5(uniqid(rand(), true)).str_random().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path()."/uploads/matches", $filename);
            $data['image_name'] = $filename;
            @unlink(public_path()."/uploads/matches/".$old_file);
        }
		$match->update($data);
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
            $error = '';
            $model = '';
            $confirm_route =  route('admin.matches.delete',['id'=>$id]);
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

            // Redirect to the group management page
            return redirect('admin/matches')->with('success', Lang::get('message.success.delete'));
    	}
    	public function uploadCsvFile(Request $request) {
            $resp['status']   = "error";
            $resp['message']  = "Please upload a valid CSV File";
            $rules = [
                "csvfile"    => "required|mimes:'application/vnd.ms-excel','text/plain','text/csv','text/tsv'",
            ];
            $validator        = Validator::make($request->all(), $rules);
            if($validator->valid()) {
                $data = Excel::load($request->file("csvfile"), function($reader) {
                })->get();
                if(!empty($data) and $data->count()) {
                    $matches = [];
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
                            if($match[5]){
                            $match_date = date("Y-m-d H:i:s", strtotime($match[4]." ".$match[5]));
                            }
                            else{    
                            $match_date = date("Y-m-d H:i:s", strtotime($match[4]));
                            }
                            $check_match = Match::where("tournament", "=", $tournament->id)
                                ->where('stadium', "=", $stadium->id)
                                ->where('home_club', "=", $home_club->id)
                                ->where('away_club', "=", $away_club->id)
                                ->where('match_date', "=", $match_date)
                                ->first();
                            if($check_match === null) {
                                $matches[] = [
                                    "tournament" => $tournament->id,
                                    'stadium'    => $stadium->id,
                                    'home_club'  => $home_club->id,
                                    'away_club'  => $away_club->id,
                                    'match_date' => $match_date,
                                    "created_at" => date("Y-m-d H:i:s"),
                                    "updated_at" => date("Y-m-d H:i:")
                                ];
                            }
                        }
                      }  

                    }
                    if(!empty($matches)) {
                        foreach (array_chunk($matches,1000) as $t) {
                            Match::insert($t);
                        }
                        $log = [
                            "type"          => 2,
                            "success_entry" => count($matches),
                            "fail_entry"    => (count($data) - count($matches)),
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
        $error = '';
        $model = '';
        $confirm_route =  route('admin.matches.empty');
        return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    }

        public function emptyMatches()
        {
            DB::table('matches')->truncate();
            //Match::truncate();
            return redirect('admin/matches')->with('success', Lang::get('message.empty.empty'));

            
        }
}