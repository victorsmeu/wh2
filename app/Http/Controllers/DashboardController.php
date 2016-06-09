<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\History;
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
    
    public function index(History $history)
    {
        if(Auth::user()->role_id < 2) {
            $historyCollection = $history::orderBy('created_at', 'desc')->get();
        } else {
            $historyCollection = $history::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }
        return view('dashboard', [
            'hideWelcome' => Auth::user()->userData()->where('label', 'hideWelcome')->count(),
            'history' => $historyCollection
        ]);
    }
}
