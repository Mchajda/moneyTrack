<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);
        return view('profile.profile', [
            'user' => $user,
        ]);
    }

    public function updateBalance(User $user){
        $data = request()->validate([
            'balance' => 'required',
        ]);

        auth()->user()->profile()->update($data);
        return redirect()->route('home');
        //dd(request()->all());
    }
}
