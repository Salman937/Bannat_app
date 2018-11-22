<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class SettingsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'country' => 'required',
            'currency' => 'required',
            'language' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([

                'success' => 'false',
                'status' => '401',
                'message' => 'Please Review All Fields',
                'errors' => $validator->errors()
            ]);
        }

        DB::table('settings')->insert([
            'country' => $request->country,
            'currency' => $request->currency,
            'language' => $request->language,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return response()->json([

            'success' => 'true',
            'status' => '200',
            'message' => 'Setting Added',
        ]);
    }

    /**
     * get privacy and policy
     */
    public function privacy_policy()
    {
        $privary_policy = DB::table('terms_and_policy')->first();

        return response()->json([

            'success' => 'true',
            'status' => '200',
            'message' => 'Privacy and Policy',
            'data' => $privary_policy->privacy_and_policy,
        ]);
    }

     /**
     * get privacy and policy
     */
    public function terms_conditions()
    {
        $terms_and_conditions = DB::table('terms_and_policy')->select('terms_and_conditions')->first();

        return response()->json([

            'success' => 'true',
            'status' => '200',
            'message' => '`Terms and Conditions',
            'data'=>$terms_and_conditions->terms_and_conditions,
        ]);
    }
}
