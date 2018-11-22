<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Category;
use DB;

class SubcategoryController extends Controller
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
        $data['heading'] = 'Secound Category list';
        $data['categories'] = Category::where('level',0)->get();
        $data['subcategories'] =  DB::table('categories AS a')
                                    ->join('categories AS b', 'b.parent_id', '=', 'a.id')
                                    ->select('a.*', 'b.category AS parent_cat')
                                    ->get();
        return view('admin.subcategory.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading'] = 'Add Secound Category';
        $data['categories'] = Category::where('level',0)->get();

        return view('admin.subcategory.create')->with($data);
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
            'head_category' => 'required',
            'category' => 'required',
        ]);

        $category = new Category;

        $category->category = $request->category;
        $category->category_slug = str_slug($request->category, '-');
        $category->level = 1;
        $category->parent_id = $request->head_category;
        
        $category->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('subcategory.index');
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

        $cat->delete();
        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }
}
