<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session, View;
use App\Http\Requests;
use App\Viewer;

class SettingsController extends Controller
{
    protected $viewers;
    
    public function __construct(Viewer $viewer)
    {
        $this->viewers = $viewer;
        
        View::share(['menu'=> 'settings']);
    }
    
    public function index()
    {
        return view('admin.settings.index', [
            'viewers' => $this->viewers->all()
        ]);
    }
    
    public function editViewer($id)
    {
        return view('admin.settings.edit-viewer', [
            'viewer' => $this->viewers->find($id)
        ]);
    }
    
    public function updateViewer(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'link' => 'required|max:255'
        ]);
        
        $input = $request->only(['name', 'link']);

        $this->viewers->find($id)->update($input);
        Session::flash('flash_message', 'Information updated ok!');
        return redirect()->route('admin.settings');
    }
}
