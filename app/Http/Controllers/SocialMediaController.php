<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SocialMediaController extends Controller
{
    // Social Media
    public function social(){
        Session::put('admin_page', 'social');
        $social = Social::first();
        return view ('admin.setting.social', compact('social'));
    }

    public function socialUpdate(Request $request, $id){
        $data = $request->all();
        $social = Social::findOrFail($id);
        $social->facebook = $data['facebook'];
        $social->twitter = $data['twitter'];
        $social->instagram = $data['instagram'];
        $social->youtube = $data['youtube'];
        $social->save();
        Session::flash('success_message', 'Social Settings Has Been Updated Successfully');
        return redirect()->back();
    }
}
