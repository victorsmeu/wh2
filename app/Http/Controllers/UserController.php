<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\User;
use App\History;
use View;

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
        $this->middleware('accessUsers');

        $this->user = $user;
        
        View::share(['menu'=> 'users']);
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
            $users = $this->user->all()->sortBy("role_id");
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
        
        return view('users.index', [
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
        return view('users.create', ['block_password' => false]);
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
        return view('users.edit', [
            'user' => $this->user->find($id),
            'block_password' => true
        ]);
    }

    /**
     * Update the specified resource in storage. Will check previous information to be able to write log
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, History $history)
    {
        $old_data = $this->user->find($id);
        $input = $request->all();
        
        if(isset($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        }

        $this->user->find($id)->update($input);
        
        if($old_data->active != $input['active']) {
            $status = ($input['active'] == 1) ? 'active' : 'inactive';
            $history::create([
                'user_id' => $id,
                'action' => 'Account status modified',
                'data' => 'Account has been marked as  ' . $status
            ]);
        }
        
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
