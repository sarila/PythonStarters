<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    // Admin Login
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ];
            $customMessages = [
                'email.required' => 'Please Enter Email Address',
                'email.email' => 'Please Enter a valid Email Address',
                'email.max' => 'Please Enter less than 255 characters',
                'password.required' => 'Please Enter Password',
            ];
            $this->validate($request, $rules, $customMessages);

            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])){
                return redirect()->route('adminDashboard');

            } else {
                Session::flash('error_message', 'Invalid Username or password');
                return redirect()->route('adminLogin');
            }

        }

        if(Auth::guard('admin')->check()){
            return redirect()->route('adminDashboard');
        } else {
            return view ('admin.auth.login');
        }


    }

    // Admin Dashboard
    public function dashboard(){
        Session::put('admin_page', 'dashboard');
        return view ('admin.dashboard');
    }

    // Admin Logout
    public function adminLogout(){
        Auth::guard('admin')->logout();
        Session::flash('success_message', 'Logout Successful');
        return redirect('/admin/login');
    }
}
