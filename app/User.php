<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'role_id', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    public function userData()
    {
        return $this->hasMany('App\UserData', 'user_id', 'id');
    }
    
    
    public function medicSpecialties()
    {
        return $this->hasMany('App\MedicSpecialty', 'user_id', 'id');
    }
    
    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }
    
    public function info()
    {
        return $this->hasMany('App\MedicData', 'user_id', 'id');
    }

    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();
        // Check if the user is a root account
        if ($this->have_role->name == 'Root') {
            return true;
        }
        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }
        return false;
    }

    private function getUserRole()
    {
        return $this->role()->getResults();
    }

    private function checkIfUserHasRole($need_role)
    {
        return (strtolower($need_role) == strtolower($this->have_role->name)) ? true : false;
    }
    
    public function medics()
    {
        $medics = [];
        $users = DB::table('users')->select('users.id', 'first_name', 'last_name', 'email', 'specialty_id', 'term')
                                   ->where('active','1')
                                   ->where('role_id','3')
                                   ->join('medic_specialties', 'medic_specialties.user_id', '=', 'users.id')
                                   ->join('specialties', 'specialties.id', '=', 'medic_specialties.specialty_id')
                                   ->get();
        foreach($users as $user) {
            $medics[$user->specialty_id][] = $user;
        }
        
        return $medics;
    }
}
