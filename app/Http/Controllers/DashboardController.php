<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth, View;

class DashboardController extends Controller
{
    protected $user;
    
    public function __construct()
    {
        $this->middleware('auth');

        $this->user = Auth::user();
        
        View::share(['menu'=> 'dashboard']);
    }
    
    public function index()
    {
        $role = $this->user->role->name;
        return view('dashboard');
    }
}
