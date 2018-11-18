<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Session;
use Auth;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('seller');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heading']    = 'Orders List';
        $data['order'] = Order::where('user_id',Auth::user()->id)->get();

        return view('admin.order.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function order_status_update(Request $request)
    {
        $order = Order::find($request->order_id);

        $order->order_status = $request->status;
        if ($order->save()) {
            print json_encode(1);
        }
        else{
            print json_encode(0);
        }
    }
    public function order_status_reject(Request $request)
    {
        $order = Order::find($request->order_id);

        $order->accpect_reject = 0;
        if ($order->save()) {
            print json_encode(1);
        }
        else{
            print json_encode(0);
        }
    }
    public function order_status_accpect(Request $request)
    {
        $order = Order::find($request->order_id);

        $order->accpect_reject = 1;
        if ($order->save()) {
            print json_encode(1);
        }
        else{
            print json_encode(0);
        }
    }
}