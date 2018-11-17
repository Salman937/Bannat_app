<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;

class ProductsController extends Controller
{
    /**
     * Get category products
     */
    public function show($id)
    {
        $products = DB::table('products')->where('products_categories_id', $id)->get();

        if ($products->isEmpty()) {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'This Category Have No Products',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'All Products',
                'data' => $products,
            ]);

        }
    }

    /**
     * get products form low to higih price
     */
    public function low_to_high_products($id)
    {
        $low_to_high = DB::table('products')
            ->where([
                ['products_categories_id', $id]
            ])->orderBy('price', 'asc')->get();

        if (empty($low_to_high)) {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'No Data Available',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'Low to High Result',
                'data' => $low_to_high,
            ]);

        }
    }

    /**
     * get data from high to low price products
     */
    public function high_to_low_products($id)
    {
        $hig_to_low = DB::table('products')
            ->where([
                ['products_categories_id', $id]
            ])->orderBy('price', 'desc')->get();

        if (empty($hig_to_low)) {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'No Data Available',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'High to Low Result',
                'data' => $hig_to_low,
            ]);

        }
    }

    /**
     * Get best rating products in category
     */
    public function best_rating_products($id)
    {
        $bet_rating_products = DB::table('products')
            ->select([
                'products.description as prodcuts_description',
                'product_reviews.description as review_description',
                'products.*',
                'product_reviews.*'
            ])
            ->join('product_reviews', 'product_reviews.product_id', '=', 'products.id')
            ->where([
                ['products.products_categories_id', $id],
                ['product_reviews.review', 5],
            ])->get();

        if (empty($bet_rating_products)) {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'Best Products Not Available',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'Best Rating Products',
                'data' => $bet_rating_products,
            ]);

        }
    }

    /**
     * newly added products in category
     */
    public function newly_added_products($id)
    {
        $newly_added_products = DB::table('products')
            ->where([
                ['products.products_categories_id', $id]
            ])->orderBy('created_at', 'desc')->get();

        if (empty($newly_added_products)) {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'Newly Added Products Not Available',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'All Newly Added Products',
                'data' => $newly_added_products,
            ]);

        }
    }

    /**
     * Add product to wish list
     */
    public function add_product_to_wishList(Request $request)
    {
        $product = DB::table('favourite_products')->insert([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return response()->json([
            'success' => 'true',
            'status' => '200',
            'message' => 'Product Added to Wish LIst',
        ]);
    }

    /**
     * Get Product Details
     */
    public function get_product_details()
    {
        
    }
}
