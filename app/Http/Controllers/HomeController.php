<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    public function index()
    {
        return redirect()->route('login');
    }

    public function home()
    {
        if(auth()->user()->role == 'ADM') {
            return view('admin.home');
        }

        if(auth()->user()->role == 'USR') {
            return view('user.home');
        }
    }

    public function user()
    {
        return view('user.home');
    }

    public function admin()
    {
        return view('admin.home');
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function profileUpdate(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.auth()->user()->id,
        ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/'.$user->image);
            $filename = auth()->user()->id.'-user.'.$request->file('image')->extension();
            $request->image->storeAs('user/', $filename, 'public');
            $filename = 'user/'.$filename;
        } else {
            $filename = $user->image;
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'image' => $filename,
        ];

        User::where('id', auth()->user()->id)->update($data);
        return redirect()->back()->with('status', 'Profile updated');
    }

}
