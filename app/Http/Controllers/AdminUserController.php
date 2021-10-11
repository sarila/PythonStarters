<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use DataTables;
use Illuminate\Support\Str;
use Image;

class AdminUserController extends Controller
{
    // Users
    public function users(){
        Session::put('admin_page', 'users');
        return view ('admin.users.users');
    }

    // Add User
    public function add(){
        Session::put('admin_page', 'users');
        return view ('admin.users.add');
    }

    // Store User
    public function store(Request $request){
        $data = $request->all();

        $validateData = $request->validate([
            'name' => 'required|max:255|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);
        // Check User Email
        $userCount = User::where('email', $data['email'])->count();
        if($userCount > 0){
            return redirect()->back()->with('error_message', 'Email Already Exists in Our Database');
        }

        $user = new User();
        $user->name = ucwords(strtolower($data['name']));
        $user->email = strtolower($data['email']);
        $user->password = bcrypt($data['password']);
        $user->phone = $data['phone'];
        $user->address = $data['address'];


        $random = Str::random(10);
        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random . '.' . $extension;
                $image_path = 'public/uploads/user/' . $filename;
                Image::make($image_tmp)->save($image_path);
                $user->image = $filename;
            }
        }

        $user->save();

        if(!empty($data['welcome'])) {
            $messageData = [
                'email' => strtolower($data['email']),
                'name' => ucwords(strtolower($data['name'])),
                'password' => "password"
            ];
            $email = strtolower($data['email']);
            Mail::send('emails.registration', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('User Registration for Janatako Online  - Janata Ko Online');
            });
        }

        Session::flash('success_message', 'New User has been added successfully');
        return redirect()->route('users');
    }

    public function dataTable(){
        $model = User::latest()->get();
        return DataTables::of($model)
            ->addColumn('action', function ($model){
                return view ('admin.users._actions', [
                    'model' => $model,
                    'url_edit' => route('user.edit', $model->id),
                    'url_destroy' => route('user.destroy', $model->id),
                ]);
            })
            ->editColumn('created_at', function ($model){
                return $model->created_at->diffForHumans();
            })
            ->editColumn('phone', function ($model){
                if(!empty($model->phone)){
                    return $model->phone;
                } else {
                    return "N/A";
                }
            })
            ->editColumn('address', function ($model){
                if(!empty($model->address)){
                    return $model->address;
                } else {
                    return "N/A";
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view ('admin.users.edit', compact('user'));
    }


    // Store User
    public function update(Request $request, $id){
        $data = $request->all();

        $validateData = $request->validate([
            'name' => 'required|max:255|min:6',
            'confirm_password' => 'same:password'
        ]);

        $user = User::findOrFail($id);
        $user->name = ucwords(strtolower($data['name']));
        $user->email = strtolower($data['email']);
        $user->password = bcrypt($data['password']);
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $random = Str::random(10);
        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random . '.' . $extension;
                $image_path = 'public/uploads/user/' . $filename;
                Image::make($image_tmp)->save($image_path);
                $user->image = $filename;
            }
        }

        $user->save();


        if(!empty($data['password'])) {
            $messageData = [
                'email' => strtolower($data['email']),
                'name' => ucwords(strtolower($data['name'])),
                'password' => "password"
            ];
            $email = strtolower($data['email']);
            Mail::send('emails.updateuser', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Password Changed  - Janata Ko Online');
            });
        }

        Session::flash('success_message', 'New User has been updated successfully');
        return redirect()->route('users');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('success_message', 'User has been deleted successfully');
        return redirect()->route('users');
    }
}
