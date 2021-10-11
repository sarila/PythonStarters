<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;


class ThemeController extends Controller
{
    // Theme
    public function theme(){
        Session::put('admin_page', 'theme');
        $theme = Theme::first();
        return view ('admin.setting.theme', compact('theme'));
    }

    public function themeUpdate(Request $request, $id){
        $data = $request->all();
        $theme = Theme::findOrFail($id);
        $theme->site_title = $data['site_title'];
        $theme->site_subtitle = $data['site_subtitle'];

        $random = Str::random(10);
        if($request->hasFile('logo')){
            $image_tmp = $request->file('logo');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random . '.' . $extension;
                $image_path = 'public/uploads/' . $filename;
                Image::make($image_tmp)->save($image_path);
                $theme->logo = $filename;
            }
        }

        $currentDate = Carbon::now()->toDateString();

        $slug2 = "favicon";
        if($request->hasFile('favicon')){
            $image_tmp = $request->file('favicon');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $slug2 . '-' . $currentDate .  '.' . $extension;
                $image_path = 'public/uploads/' . $filename;
                Image::make($image_tmp)->save($image_path);
                $theme->favicon = $filename;
            }
        }

        $theme->save();
        Session::flash('success_message', 'Theme Settings Has Been Updated Successfully');
        return redirect()->back();
    }
}
