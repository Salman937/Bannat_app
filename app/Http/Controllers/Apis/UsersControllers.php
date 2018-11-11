<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use Validator;
use DB;
use Auth;
use Mail;

class UsersControllers extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|max:191',
            'phone_no' => 'required|unique:users,phone_no',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',

        ]);


        if ($validator->fails()) {
            return response()->json([

                'success' => 'false',
                'status' => '401',
                'message' => 'Please Review All Fields',
                'errors' => $validator->errors()
            ]);
        }

        $user = DB::table('users')->insert([

            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => str_random(60),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        return response()->json([
            'success' => 'true',
            'status' => '200',
            'message' => 'User Register Successfully',
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'password' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([

                'success' => 'false',
                'status' => '401',
                'message' => 'Please Review All Fields',
                'errors' => $validator->errors()
            ]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) || Auth::attempt(['phone_no' => $request->phone_no, 'password' => $request->password])) {
	    		//Authentication passed

            $user = Auth::user();

            $user_data = [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "phone_no" => $user->phone_no,
                "api_token" => $user->api_token,
            ];

            return response()->json([
                'success' => 'true',
                'status' => '200',
                'message' => 'User LoggedIn Successfully',
                'user_data' => $user_data
            ]);

        }

        return response()->json([

            'success' => 'false',
            'status' => '401',
            'message' => 'Your Email OR Password is Incorrect'
        ]);
    }

    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([

                'success' => 'false',
                'status' => '401',
                'message' => 'Please Review All Fields',
                'errors' => $validator->errors()
            ]);
        }

        $check = DB::table('users')->where('email', $request->email)->first();

        if ($check) {
            $code = mt_rand(100000, 999999);

            DB::table('users')->where('email', $request->email)->update([
                'verification_code' => $code
            ]);

            $to = $request->email;
            $subject = "Verfication Code";

            $headers = "Content-Type: text/html; charset=UTF-8\r\n";

            $msg = "Hi Dear,<br><br>This is your verification code: <b>$code</b> <br><br>Thanks";

            $mail = mail($to, $subject, $msg, $headers);

            if ($mail) {
                return response()->json([

                    'success' => 'true',
                    'status' => '200',
                    'message' => "Verfication Code is Send to your Email",
                ]);
            } else {
                return response()->json([

                    'success' => 'false',
                    'status' => '401',
                    'message' => "Email Can't send",
                ]);
            }
        } else {
            return response()->json([

                'success' => 'false',
                'status' => '401',
                'message' => 'This email is not found in our database record',
            ]);
        }
    }

    public function verify_code(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'code' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([

                'success' => 'false',
                'status' => '401',
                'message' => 'Please Review All Fields',
                'errors' => $validator->errors()
            ]);
        }

        $check = DB::table('users')->where('verification_code', $request->code)->first();

        if ($check) {
            return response()->json([

                'success' => 'true',
                'status' => '200',
                'message' => "Verfication Code verified successfully",
                'user_data' => $check,
            ]);
        } else {
            return response()->json([

                'success' => 'false',
                'status' => '401',
                'message' => 'This verfication code is not found in our database record',
            ]);
        }
    }

    public function update_forgot_pass(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'password' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([

                'success' => 'false',
                'status' => '401',
                'message' => 'Please Review All Fields',
                'errors' => $validator->errors()
            ]);
        }

        $check = DB::table('users')->where('email', $request->email)->update(['password' => bcrypt($request->password)]);

        if ($check) {
            return response()->json([

                'success' => 'true',
                'status' => '200',
                'message' => "Password Updated Successfully",
            ]);
        } else {
            return response()->json([

                'success' => 'false',
                'status' => '401',
                'message' => 'Password Can not updated',
            ]);
        }
    }
}
