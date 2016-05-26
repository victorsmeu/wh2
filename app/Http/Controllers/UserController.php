<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\User;


class UserController extends Controller
{
    
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @param  Patient  $patient
     */
    public function __construct(User $user)
    {
        $this->middleware('auth');

        $this->user = $user;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = array_filter(array_map(function($value) {
                    return htmlentities(strip_tags($value));
                }, $request->only(['search', 'role_id'])));
        
        if(empty($filters)) {
            $users = $this->user->all();
        } else {
            $users = $this->user->where(function($query) use ($filters){
                if(!empty($filters['search'])) {
                    $query->where(function($subquery) use ($filters) {
                        $subquery->where('first_name', 'LIKE', '%'.$filters['search'].'%')
                                 ->orWhere('last_name', 'LIKE', '%'.$filters['search'].'%')
                                 ->orWhere('email', 'LIKE', '%'.$filters['search'].'%');
                    });
                    
                }
                if(!empty($filters['role_id'])) {
                    $query->where('role_id', $filters['role_id']);
                }
            })->get();
        }
        
        return view('user.index', [
            'users' => $users, 
            'filters' => $filters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create', ['block_password' => false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
            'role_id' => 'required|integer|min:1|max:4',
        ]);
        
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);    
        $this->user->fill($input)->save();

        Session::flash('flash_message', 'User added OK!');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('user.edit', [
            'user' => $this->user->find($id),
            'block_password' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        if(isset($input['password']))
            $input['password'] = bcrypt($input['password']);

        $this->user->find($id)->update($input);
        Session::flash('flash_message', 'Information updated ok!');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
