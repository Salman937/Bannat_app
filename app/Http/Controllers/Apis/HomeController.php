<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;

class HomeController extends Controller
{
    public function index()
    {
        $gallery_images = DB::table('home_page_gallery')->orderBy('id', 'desc')->limit(3)->get();

        $sale_images = DB::table('products')->where('sale', 1)->orderBy('id', 'desc')->limit(12)->get();

        $trending_deals = DB::table('order_items')
            ->select([
                'order_items.product_id',
                DB::raw('count(*) as total'),
                'products.*'
            ])
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->groupBy('order_items.product_id')
            ->orderBy('total', 'DESC')
            ->limit(12)
            ->get();

        $new_added = DB::table('products')->orderBy('id', 'desc')->limit(12)->get();

        // $recent_products = array();

        // foreach ($new_added as $recently) {
        //     if (date("d-m-Y", strtotime($recently->created_at)) == date('d-m-Y')) {
        //         $arr = array(
        //             "id" => $recently->id,
        //             "products_categories_id" => $recently->products_categories_id,
        //             "price" => $recently->price,
        //             "title" => $recently->title,
        //             "image" => $recently->image,
        //             "description" => $recently->description,
        //             "sale" => $recently->sale,
        //             "qty" => $recently->qty,
        //             "options" => $recently->options,
        //             "created_at" => $recently->created_at,
        //             "updated_at" => $recently->updated_at
        //         );

        //         array_push($recent_products, $arr);
        //     }
        // }

        return response()->json([
            'success' => 'true',
            'status' => '200',
            'message' => 'Home Page Data',
            'gallery_images' => $gallery_images,
            'flash_deal_images' => $sale_images,
            'trending_deals' => $trending_deals,
            'newly_products' => $new_added,
        ]);
    }
}
