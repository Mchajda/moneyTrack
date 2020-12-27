<?php

namespace App\Http\Controllers;

use App\Http\Managers\SummaryManager;
use App\Http\Services\ProfileService;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Profile;
use App\Models\User;


class ProfilesController extends Controller
{
    private $profileService;

    public function __construct(
        ProfileService $profileService
    ){
        $this->profileService = $profileService;
    }

    public function index(){
        return view('profile.profile', [
            'user' => auth()->user(),
        ]);
    }

    public function updateBalance(){
        $this->profileService->changeBalance(request(), Profile::find(auth()->user()->id));
        return redirect()->route('home');
    }
}
