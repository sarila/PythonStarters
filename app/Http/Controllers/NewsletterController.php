<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function checkSubscriber(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $subscriberCount = Newsletter::where('email', $data['subscriber_email'])->count();
            if($subscriberCount > 0){
                echo "exists";
            }
        }
    }

    public function addSubscriber(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $subscriberCount = Newsletter::where('email', $data['subscriber_email'])->count();
            if ($subscriberCount > 0){
                echo "exists";
            } else {
                $newsletter = new Newsletter();
                $newsletter->email = $data['subscriber_email'];
                $newsletter->status = 1;
                $newsletter->save();
                echo "saved";
            }
        }
    }
}
