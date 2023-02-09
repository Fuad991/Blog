<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(){//هاذ عشان نحمي الكونترولير وما نخلي اي واحد مش عامل لوج ان على الصفحة ينزل بوست
        $this->middleware('auth');
    }

    public function index(){
        $user = User::all();
        return view('users.index')->with('user',$user);
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users');
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users');
    }

}
