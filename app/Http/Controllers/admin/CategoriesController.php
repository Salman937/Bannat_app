<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Session;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heading']    = 'First Category List';
        $data['categories'] = Category::where('level',0)
                                        ->get();

        return view('admin.headcategory.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading']    = 'Add Category';
        return view('admin.headcategory.create')->with($data);
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
            'category' => 'required'
        ]);

        $category = new Category;

        $category->category = $request->category;
        $category->category_slug = str_slug($request->category, '-');
        $category->level = 0;
        $category->parent_id = 0;
        
        $category->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('category.index');
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
        $cat = Category::find($id);
        $sub_category = Category::where('parent_id',$id)->get();

        if (!empty($sub_category)) {
            foreach ($sub_category as $sub_key => $sub_value) {
                $sub_category_sub = Category::where('parent_id',$sub_value->id)->first();
                if (!empty($sub_category_sub)) {
                    foreach ($sub_category_sub as $sub_key_sub => $sub_value_sub) {
                        $sub_category_sub->forceDelete();
                    }
                    $sub_category->forceDelete();
                }
            }
        }
        $cat->forceDelete();
        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }

    public function third_category_list()
    {
        $data['heading']    = 'Third Category List';
        $data['third_category'] = Category::where('level',2)->get();
        $data['categories'] = Category::where('level',0)->get();

        return view('admin.thirdcategory.list')->with($data);
    }
    public function get_cat(Request $request)
    {
        $data = Category::where('parent_id',$request->id)->get();
        print json_encode($data);
    }
    public function thirdcategory_store(Request $request)
    {
        $this->validate($request,[
            'head_category' => 'required',
            'secound_cat' => 'required',
            'category' => 'required'
        ]);

        $category = new Category;

        $category->category = $request->category;
        $category->category_slug = str_slug($request->category, '-');
        $category->level = 2;
        $category->parent_id = $request->secound_cat;
        
        $category->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('third.category');
    }
    public function thirdcategory_destory($id)
    {
        $cat = Category::find($id);

        $cat->delete();
        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }
}