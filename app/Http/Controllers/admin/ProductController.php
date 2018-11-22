<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Session;
use App\Category;
use Auth;

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
            'images' => 'required',
            'description' => 'required',
            'qty' => 'required'
        ]);

        $product = new Product;

         $images=array();
        if($image_files=$request->file('images')){
            foreach($image_files as $file){
                $name= time().$file->getClientOriginalName();
                $file->move('uploads/product',$name);
                $images[]=asset('uploads/product/'.$name);
            }
        }
         $featured_images=array();
        if($files=$request->file('option_images')){
            foreach($files as $file){
                $name= time().$file->getClientOriginalName();
                $file->move('uploads/product',$name);
                $featured_images[]=asset('uploads/product/'.$name);
            }
        }
        $product->first_cat = $request->head_category;
        $product->sec_cat = $request->secound_cat;
        $product->products_categories_id = $request->third_cat;
        $product->price = $request->price;
        $product->title = $request->title;
        if (!empty($request->color)) {
            $product->color = implode("|",$request->color);
        }
        if (!empty($request->size)) {
            $product->size = implode("|",$request->size);
        }
        $product->image = implode("|",$images);
        $product->description = $request->description;
        $product->user_id = Auth::user()->id;
        $product->qty = $request->qty;
        $product->options = implode("|",$featured_images);

        $product->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('product.seller.index');
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
        $data['heading'] = 'Product Edit';
        $data['product'] = Product::find($id);
        $data['categories'] = Category::where('level',0)->get();
        $data['sec_categories'] = Category::where('level',1)->get();
        $data['third_categories'] = Category::where('level',2)->get();

        return view('admin.product.edit')->with($data);
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
        $this->validate($request,[
            'third_cat' => 'required',
            'price' => 'required',
            'title' => 'required',
            // 'new_feature_image' => 'required',
            'description' => 'required',
            'qty' => 'required'
        ]);

        $product = Product::find($id);

         $images=array();
        if($image_files=$request->file('new_feature_image')){
            foreach($image_files as $file){
                $name= time().$file->getClientOriginalName();
                $file->move('uploads/product',$name);
                $images[]=asset('uploads/product/'.$name);
            }
            $product->image = implode("|",$images);
        }
        else{
            $product->image = $request->feature_image;
        }

         $option_images=array();
        if($files=$request->file('new_option_images')){
            foreach($files as $file){
                $name= time().$file->getClientOriginalName();
                $file->move('uploads/product',$name);
                $option_images[]=asset('uploads/product/'.$name);
            }
            $product->options = implode("|",$option_images);
        }
        else{
            $product->options = $request->option_images;
        }
        $product->first_cat = $request->head_category;
        $product->sec_cat = $request->secound_cat;
        $product->products_categories_id = $request->third_cat;
        $product->price = $request->price;
        $product->title = $request->title;
        if (!empty($request->color)) {
            $product->color = implode("|",$request->color);
        }
        if (!empty($request->size)) {
            $product->size = implode("|",$request->size);
        }
        $product->description = $request->description;
        $product->user_id = Auth::user()->id;
        $product->qty = $request->qty;

        $product->save();

        Session::flash('success','Your Data Updated Seccussfully');
        
        return redirect()->route('product.seller.index');
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
