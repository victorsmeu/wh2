<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id'            => 1,
            'name'          => 'Root',
            'description'   => 'Full admin'
        ]);
        Role::create([
            'id'            => 2,
            'name'          => 'Admin',
            'description'   => 'Full access to create, edit, and update.'
        ]);
        Role::create([
            'id'            => 3,
            'name'          => 'Medic',
            'description'   => 'Can view patients, EHRs, write reports'
        ]);
        Role::create([
            'id'            => 4,
            'name'          => 'Patient',
            'description'   => ''
        ]);
    }
}
