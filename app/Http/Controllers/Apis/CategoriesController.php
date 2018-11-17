<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->where('level', 0)->get();

        foreach ($categories as $key => $category) {
            //    $cat[]['head_category'] = $category->category;

            $categories[$key]->level2 = DB::table('categories')
                ->where([
                    ['parent_id', $category->id],
                    ['level', 1],
                ])
                ->get();

            foreach (($categories[$key]->level2) as $key1 => $row) {
                $categories[$key]->level2[$key1]->level3 = DB::table('categories')
                    ->where([
                        ['parent_id', $row->id],
                        ['level', 2],
                    ])
                    ->get();
            }
        }


        return response()->json([
            'success' => 'true',
            'status' => '200',
            'message' => 'All Categories',
            'Categories' => $categories,
        ]);
    }
}
