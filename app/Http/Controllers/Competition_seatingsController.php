<?php namespace App\Http\Controllers;

use App\Club;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Competition_seating;
use App\Http\Requests\SaveCompetitionSeatingsRequest;
use App\Match;
use App\SeatingCategory;
use App\Stadium;
use App\Tournament;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class Competition_seatingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$competition_seatings = Competition_seating::latest()->get();
		return view('admin.competition_seatings.index', compact('competition_seatings'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$matches          = Match::all();
		$seating_category = SeatingCategory::lists("name", "id");
		return view('admin.competition_seatings.create', ['matches'=>$matches, 'seating_category'=> $seating_category]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(SaveCompetitionSeatingsRequest $request)
	{
        $insertdata    = [
            "matches_id"          => $request->input("matches"),
            "seatingcategory_id"  => $request->input("seating_category"),
            "price"               => $request->input("price"),
            "quantity_available"  => $request->input("quantity_available")
        ];
        Competition_seating::create($insertdata);
		return redirect('admin/competition_seatings')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$competition_seating = Competition_seating::findOrFail($id);
		return view('admin.competition_seatings.show', compact('competition_seating'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $matches          = Match::all();
        $seating_category = SeatingCategory::lists("name", "id");
		$competition_seating = Competition_seating::findOrFail($id);
		return view('admin.competition_seatings.edit', compact('matches', 'competition_seating', 'seating_category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, SaveCompetitionSeatingsRequest $request)
	{
		$competition_seating                     = Competition_seating::findOrFail($id);
        $competition_seating->matches_id         = $request->input("matches");
        $competition_seating->seatingcategory_id = $request->input("seating_category");
        $competition_seating->price              = $request->input("price");
        $competition_seating->quantity_available = $request->input("quantity_available");
        $competition_seating->save();
        return redirect('admin/competition_seatings')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Competition_seating.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.competition_seatings.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Competition_seating.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$competition_seating = Competition_seating::destroy($id);

            // Redirect to the group management page
            return redirect('admin/competition_seatings')->with('success', Lang::get('message.success.delete'));

    	}

    	public function emptyTickets()
        {
            DB::table('competition_seatings')->truncate();
            //Match::truncate();
            return redirect('admin/competition_seatings')->with('success', Lang::get('message.empty.empty'));

            
        }

}