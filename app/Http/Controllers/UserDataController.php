<?php

namespace App\Http\Controllers;
use App\UserData;
use Auth;

class UserDataController extends Controller
{
    protected $userData;
    
    public function __construct(UserData $userData)
    {
        $this->middleware('auth');
        $this->userData = $userData;
    }
    
    public function hideWelcome()
    {
        $data = [
            'user_id' => Auth::user()->id,
            'label' => 'hideWelcome',
            'info' => true
        ];
        $this->userData->firstOrCreate($data);
        return redirect()->back();
    }
}
