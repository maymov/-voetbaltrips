<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Discount;

class DiscountController extends JoshController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        echo $this->generateCoupon();
        $coupons = Discount::where('is_used', 0)->get();

        return View('admin.discount.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = $this->generateCoupon();
        return View('admin.discount.create', compact('code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code'  => 'required|unique:discount'
        ]);

        $coupon        = new Discount;
        $coupon->code  = $request->code;
        $coupon->value = $request->value;

        if ($coupon->save()) {
            return redirect()->to(route('admin.discount.index'));
        } else {
            return redirect('discount/create')
                ->withErrors('error', 'Something went wrong')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Discount::find($id);

        return View('admin.discount.edit', compact('coupon'));
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
        $coupon = Discount::find($id);

        $coupon->value = $request->value;

        if ($coupon->save()) {
            return redirect()->to(route('admin.discount.index'));
        } else {
            return redirect('discount/create')
                ->withErrors('error', 'Something went wrong')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Discount::destroy($id);
    }

    /**
     * Generates random string with length = length+1
     *
     * @param int $lenght
     * @return string
     */
    private function generateCoupon($lenght = 9)
    {
        return "V".substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',$lenght)),0,$lenght);
    }
}
