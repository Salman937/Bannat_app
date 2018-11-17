<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Session;
use App\Category;

class ProductController extends Controller
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
        $data['heading'] = 'Product list';
        $data['product'] = Product::all();

        return view('admin.product.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading'] = 'Add Product';
        $data['categories'] = Category::where('level',0)->get();

        return view('admin.product.create')->with($data);
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
            'third_cat' => 'required',
            'price' => 'required',
            'title' => 'required',
            'image' => 'required|image',
            'description' => 'required',
            // 'sale' => 'required',
            'qty' => 'required'
        ]);

        $product = new Product;
        
        $featured = $request->image;
        $featured_new_image_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/product',$featured_new_image_name);

         $images=array();
        if($files=$request->file('option_images')){
            foreach($files as $file){
                $name= time().$file->getClientOriginalName();
                $file->move('uploads/product',$name);
                $images[]=asset('uploads/product/'.$name);
            }
        }
        $product->products_categories_id = $request->third_cat;
        $product->price = $request->price;
        $product->title = $request->title;
        $product->image = asset('uploads/product/'.$featured_new_image_name);
        $product->description = $request->description;
        $product->user_id = Auth::user()->id;
        $product->qty = $request->qty;
        $product->options = implode("|",$images);

        $product->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('product.index');
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
        $pro = Product::find($id);

        $pro->delete();
        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }
    public function seller_404_error()
    {
        return view('404_error');
    }
    
    public function get_cat(Request $request)
    {
        $data = Category::where('parent_id',$request->id)->get();
        print json_encode($data);
    }
}
