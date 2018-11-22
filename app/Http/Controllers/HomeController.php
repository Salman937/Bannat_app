<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 'seller') {
            $data['reject_orders'] = Order::where('accpect_reject',0)->where('user_id',Auth::user()->id)->count();
            $data['accpect_orders'] = Order::where('accpect_reject',1)->where('user_id',Auth::user()->id)->count();
            $data['shipped_orders'] = Order::where('order_status','shipped')->where('user_id',Auth::user()->id)->count();
            $data['completed_orders'] = Order::where('order_status','completed')->where('user_id',Auth::user()->id)->count();
            $data['inprogress_orders'] = Order::where('order_status','inprogress')->where('user_id',Auth::user()->id)->count();
            $data['pending_orders'] = Order::where('order_status','pending')->where('user_id',Auth::user()->id)->count();
            $data['total_orders'] = Order::where('user_id',Auth::user()->id)->count();

            $data['top_product'] = Product::where('user_id',Auth::user()->id)->max('sale');
            $data['low_stock_product'] = Product::where('user_id',Auth::user()->id)->where('qty','<',5)->count();
        }
        elseif(Auth::user()->type == 'admin'){
            $data['empty'] = 'empty';
        }
        return view('dashboard')->with($data);
    }
}
