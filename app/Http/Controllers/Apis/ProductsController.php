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
                'message' => 'Result',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'Result',
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
            ])->orderBy('price','ASC')->get();

        if ($low_to_high->isEmpty()) {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'No Data Available',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'Result',
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

        if ($hig_to_low->isEmpty()) {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'No Data Available',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'Result',
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

        if ($bet_rating_products->isEmpty()) {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'Best Products Not Available',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'Result',
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

        if ($newly_added_products->isEmpty()) {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'Newly Added Products Not Available',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'Result',
                'data' => $newly_added_products,
            ]);
        }
    }

    /**
     * Add product to wish list
     */
    public function add_product_to_wishList(Request $request)
    {
        $check_product = DB::table('favourite_products')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();

        if (empty($check_product)) {
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
        } else {
            return response()->json([
                'success' => 'false',
                'status' => '402',
                'message' => 'This product is already added to wish list',
            ]);
        }

    }

    /**
     * Get Product Details
     */
    public function get_product_details($id)
    {
        $product_details = DB::table('products')->where('id', $id)->first();
        $product_review_avg = DB::table('product_reviews')->where('product_id', $id)->avg('review');
        $latest_review = DB::table('product_reviews')
            ->join('users', 'users.id', '=', 'product_reviews.user_id')
            ->where('product_id', $id)
            ->orderBy('user_id', 'desc')
            ->first();

        if (empty($latest_review)) {
            $new_review = [];
        } else {
            $new_review = array(
                "user_id" => $latest_review->user_id,
                "product_id" => $latest_review->product_id,
                "description" => $latest_review->description,
                "name" => $latest_review->name,
                "review" => $latest_review->review,
                "date" => date("d-M-y", strtotime($latest_review->created_at))
            );
        }

        $check_produc_wishlist = DB::table('favourite_products')->where('product_id', $id)->first();
        $user_images = DB::table('users')
            ->select('user_image')
            ->join('product_reviews', 'product_reviews.user_id', '=', 'users.id')
            ->where('product_reviews.product_id', $id)
            ->orderBy('user_id', 'desc')
            ->get();

        $images = array();
        foreach ($user_images as $key => $img) {
            $images[] = $img->user_image;
        }

        if ($product_details) {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'Result',
                'product_details' => $product_details,
                'product_average_review' => round($product_review_avg),
                'last_review' => empty($new_review) ? [] : $new_review,
                'review_user_images' => $images,
                'wishList_product' => empty($check_produc_wishlist) ? [] : $check_produc_wishlist,
            ]);
        } else {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'Product Details Not Found',
            ]);
        }
    }

    /**
     * View all product reviews
     */
    public function view_all_reviews($id)
    {
        $product_reviews = DB::table('product_reviews')
            ->join('users', 'users.id', '=', 'product_reviews.user_id')
            ->where('product_id', $id)
            ->get();

        $pro_reviews = array();

        foreach ($product_reviews as $review) :

            $reviews = array(
            "user_id" => $review->user_id,
            "product_id" => $review->product_id,
            "review" => $review->review,
            "description" => $review->description,
            "name" => $review->name,
            "user_image" => $review->user_image,
            "date" => date("d-M-y", strtotime($review->created_at)),
        );

        $pro_reviews[] = $reviews;
        endforeach;

        if (!$pro_reviews) {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'Product reviews Not Found',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'Product Reviews',
                'reviews' => $pro_reviews,
            ]);
        }
    }
    /**
     * User wishList Products
     */
    public function user_wish_list_products($id)
    {
        $wishList_products = DB::table('favourite_products')
            ->join('products', 'products.id', '=', 'favourite_products.product_id')
            ->where('favourite_products.user_id', $id)
            ->get();

        if ($wishList_products->isEmpty()) {
            return response()->json([
                'success' => 'false',
                'status' => '401',
                'message' => 'Result',
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'Result',
                'products' => $wishList_products,
            ]);
        }
    }
}
