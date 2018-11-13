<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Coupons;
use App\Product;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heading'] = 'Coupons list';
        $data['coupons'] = Coupons::all();

        return view('admin.coupons.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Product::all());
        $data['heading'] = 'Add Coupons';
        $data['product'] = Product::all();

        return view('admin.coupons.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            // 'product_id' => 'required',
            'product_check_box' => 'required',
            'coupon_code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required'
        ]);

        $coupons = new Coupons;

        $product_id=array();
        foreach ($request->product_check_box as $key => $value) {
            $product_id[] = $value;
        }

        $coupons->product_id = implode("|",$product_id);
        $coupons->coupon_code = $request->coupon_code;
        $coupons->start_date = "2018-10-11";
        $coupons->end_date = "2018-10-11";
        $coupons->discount_value = $request->discount_value;
        $coupons->discount_type = $request->discount_type;
        
        $coupons->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('coupons.index');
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
        //
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
        //
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
