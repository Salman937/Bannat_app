<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class CouponsController extends Controller
{
    public function store(Request $request)
    {
        $check_coupon = DB::table('coupons')->where('coupon_code', $request->coupon_code)->first();

        if (!empty($check_coupon)) {

            if ($check_coupon->product_id == 'admin_id') {

                $dt = Carbon::now();
                $coupon_bw_dates = DB::table('coupons')
                    ->whereRaw('"' . $dt . '" between `start_date` and `end_date`')
                    ->where('product_id', 'admin_id')
                    ->first();

                if ($coupon_bw_dates) {

                    $percent = ($coupon_bw_dates->discount_value / 100) * $request->total_price;

                    $total_price = $request->total_price - $percent;

                    return response()->json([
                        'success' => 'true',
                        'status' => '200',
                        'message' => 'Total value after applying coupon code',
                        'total_price' => $total_price
                    ]);
                } else {
                    return response()->json([
                        'success' => 'false',
                        'status' => '401',
                        'message' => 'This Copon Code Has Been Expire',
                    ]);
                }
            } else {

                $dt = Carbon::now();
                $coupon_bw_dates = DB::table('coupons')
                    ->whereRaw('"' . $dt . '" between `start_date` and `end_date`')
                    ->where('product_id', '!=', 'admin_id')
                    ->first();

                if ($coupon_bw_dates) {

                    $db_product_ids = explode(",", $coupon_bw_dates->product_id);
                    $product_ids = explode(",", $request->product_id);

                    $result = array_intersect($db_product_ids, $product_ids);

                    if ($result) 
                    {
                        $percent = ($coupon_bw_dates->discount_value / 100) * $request->total_price;

                        $total_price = $request->total_price - $percent;

                        return response()->json([
                            'success' => 'true',
                            'status' => '200',
                            'message' => 'Total value after applying coupon code',
                            'total_price' => $total_price
                        ]);
                    } else {
                        return response()->json([
                            'success' => 'false',
                            'status' => '401',
                            'message' => 'Sorry! We have not found any product which have coupon code',
                        ]);
                    }
                    
                    return response()->json([
                        'success' => 'true',
                        'status' => '200',
                        'message' => 'Total value after applying coupon code',
                    ]);
                } else {
                    return response()->json([
                        'success' => 'false',
                        'status' => '401',
                        'message' => 'This Copon Code Has Been Expire',
                    ]);
                }


                return response()->json([
                    'success' => 'true',
                    'status' => '200',
                    'message' => 'not admin',
                ]);
            }
        } else {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'This coupon code does not exits in our records',
            ]);
        }

    }
}
