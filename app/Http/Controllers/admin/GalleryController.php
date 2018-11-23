<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Gallery;
use App\Coupons;

class GalleryController extends Controller
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
        $data['heading'] = 'Gallery list';
        $data['gallery'] = Gallery::all();

        return view('admin.gallery.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading'] = 'Add Gallery';

        return view('admin.gallery.create')->with($data);
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
            'image' => 'required|image'
        ]);

        $gallery = new Gallery;
        
        $featured = $request->image;
        $featured_image_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/gallery/',$featured_image_name);

        $gallery->images = asset('uploads/gallery/'.$featured_image_name);

        $gallery->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('gallery.index');
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
        $data['heading'] = 'Edit Gallery';
        $data['gallery'] = Gallery::find($id);

        return view('admin.gallery.edit')->with($data);
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
        $gallery = Gallery::find($id);

        if($request->file('new_image')){
            $featured = $request->new_image;
            $featured_image_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/gallery/',$featured_image_name);

            $gallery->images = asset('uploads/gallery/'.$featured_image_name);
        }
        else{
            $gallery->images = $request->pre_image;
        }
        
        $gallery->save();

        Session::flash('success','Your Data Is Updated Seccussfully');
        
        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gal = Gallery::find($id);

        $gal->delete();
        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }


    public function admin_404_error()
    {
        return view('admin.404_error_blade');
    }


    public function coupons_list()
    {
        $data['heading'] = 'Coupons List';
        $data['coupons'] = Coupons::where('product_id','admin_id')->get();
        return view('admin.admin_coupons.list')->with($data);
    }
    public function coupons_create()
    {
        $data['heading'] = 'Create Coupons';
        return view('admin.admin_coupons.create')->with($data);
    }
    public function coupons_store(Request $request)
    {
        $this->validate($request,[
            'coupon_code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required'
        ]);

        $coupons = new Coupons;

        $coupons->product_id = 'admin_id';
        $coupons->coupon_code = $request->coupon_code;
        $coupons->start_date = date('Y-m-d', strtotime($request->start_date));
        $coupons->end_date = date('Y-m-d', strtotime($request->start_date));
        $coupons->discount_value = $request->discount_value;
        $coupons->discount_type = $request->discount_type;
        
        $coupons->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('admin.coupons.list');
    }
    public function coupons_edit($id)
    {
        $data['heading'] = 'Edit Coupons';
        $data['coupons'] = Coupons::find($id);

        return view('admin.admin_coupons.edit')->with($data);
    }

    public function coupons_update(Request $request, $id)
    {
        $this->validate($request,[
            'coupon_code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required'
        ]);

        $coupons = Coupons::find($id);

        $coupons->product_id = 'admin_id';
        $coupons->coupon_code = $request->coupon_code;
        $coupons->start_date = date('Y-m-d', strtotime($request->start_date));
        $coupons->end_date = date('Y-m-d', strtotime($request->start_date));
        $coupons->discount_value = $request->discount_value;
        $coupons->discount_type = $request->discount_type;
        
        $coupons->save();

        Session::flash('success','Your Data Is Updated Seccussfully');
        
        return redirect()->route('admin.coupons.list');
    }
    public function coupons_destory($id)
    {
        $cop = Coupons::find($id);

        $cop->delete();
        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }
}
