<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\TicketType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use Input;
use App\OrdersTicket;
use App\OrderMatch;
use App\OrderFlight;
use App\OrderAccomodation;
use Illuminate\Support\Facades\File;
class OrdersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$orders = Order::latest()->get();
		return view('admin.orders.index', compact('orders'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.orders.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		order::create($request->all());
		return redirect('admin/orders')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    $order_id    = $id;
		$order       = Order::findOrFail($id);
        $ticket_type = TicketType::lists("name", "id");
		return view('admin.orders.show', compact('order', 'ticket_type', 'order_id'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$order = Order::findOrFail($id);
		return view('admin.orders.edit', compact('order'));
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
		$order = Order::findOrFail($id);
		$order->update($request->all());
		return redirect('admin/orders')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Order.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.orders.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Order.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$order = Order::destroy($id);

            // Redirect to the group management page
            return redirect('admin/orders')->with('success', Lang::get('message.success.delete'));

    	}

    	public function uploadTickets($order_id, Request $request) {
            $file               = $request->file('ticket');
            $extension          = $file->getClientOriginalExtension();
            $newfilename        = $order_id.str_random(5).uniqid().sha1(time().$file->getFilename().microtime()).rand(1,100000).str_random(10).".".$extension;
            $result             = File::makeDirectory(public_path('uploads/tickets'), 0775, true, true);
            $destinationPath = base_path() . '/public/uploads/tickets/';
            $file->move($destinationPath, $newfilename);
            OrdersTicket::create([
                "orders_id"      => $order_id,
                "ticket_type_id" => $request->input("ticket_type"),
                "file_name"      => $newfilename
            ]);
            return redirect("admin/orders/".$order_id)->with("success", "Ticket Uploaded Successfully");
        }

        public function setOrderAsComplete($order_id) {
            $order = Order::findorFail($order_id);
            $order->order_status = 3;
            $order->save();
            return redirect("admin/orders/".$order_id)->with("success", "Order Processing Completed Successfully.");
        }

        public function updateMatch($order_id, Request $request) {
            OrderMatch::where('orders_id', $order_id)->update([
                "processed_text" => $request->input("processed_text"),
                "actual_price" => $request->input("actual_price")
            ]);

            $this->isProcessed($order_id);

            return redirect("admin/orders/".$order_id)->with("success", "Match updated Successfully");
        }

        public function updateFlight($order_id, Request $request) {
            OrderFlight::where('orders_id', $order_id)->update([
                "reservation_number" => $request->input("reservation_number"),
                "actual_price" => $request->input("actual_price")
            ]);

            $this->isProcessed($order_id);

            return redirect("admin/orders/".$order_id)->with("success", "Flight updated Successfully");
        }

        public function updateRoom($order_id, Request $request) {
            OrderAccomodation::where('orders_id', $order_id)->update([
                "hotel_name" => $request->input("hotel_name"),
                "actual_price" => $request->input("actual_price")
            ]);

            $this->isProcessed($order_id);

            return redirect("admin/orders/".$order_id)->with("success", "Accomodation updated Successfully");
        }

        public function isProcessed($orderId) 
        {
        	$match = OrderMatch::where('orders_id', $orderId)
        	->where('processed_text', '!=', '')
        	->where('actual_price', '!=', 0)
        	->where('actual_price', '!=', '')
        	->first();

        	$flight = OrderFlight::where('orders_id', $orderId)
        	->where('reservation_number', '!=', '')
        	->where('actual_price', '!=', 0)
        	->where('actual_price', '!=', '')
        	->first();

        	$accomodation = OrderAccomodation::where('orders_id', $orderId)
        	->where('hotel_name', '!=', '')
        	->where('actual_price', '!=', 0)
        	->where('actual_price', '!=', '')
        	->first();

        	if(!empty($match) && !empty($flight) && !empty($accomodation)) {
        		Order::where('id', '=', $orderId)->update([
        			'order_status' => 3
        		]);
        	}
        }

}