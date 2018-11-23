<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\User;
class UsersController extends Controller
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
        $data['heading'] = 'Active User List';
        $data['users']   = User::where('deactive_users',1)->get();
        return view('admin.user.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data['heading'] = 'Edit User';
        $data['user'] = User::find($id);

        return view('admin.user.edit')->with($data);
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
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:6|confirmed',
            // 'phone_no' => 'required|integer|min:6',
            // 'type' => 'required',
        
        $this->validate($request,[
            'name' => 'required|string||max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'nullable|string|min:6|confirmed',
            'phone_no' => 'required|integer|min:6',
            'type' => 'required',
            'active' => 'required'
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->post('password')){
            $user->password = bcrypt($request->password);
        }
        else{
            $user->password = $request->old_password;
        }
        $user->phone_no = $request->phone_no;
        $user->type = $request->type;
        $user->deactive_users = $request->active;
        // dd($user);
        $user->save();

        Session::flash('success','User Record Is Updated Seccussfully');
        
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }

    public function de_active_user()
    {
        $data['heading'] = 'De-Active User List';
        $data['users']   = User::where('deactive_users',0)->get();
        return view('admin.user.de_active_list')->with($data);
    }
}
