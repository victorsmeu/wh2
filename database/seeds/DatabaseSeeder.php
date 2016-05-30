<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\User;

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

        User::create([
            'id' => 1,
            'first_name' => 'Victor',
            'last_name' => 'Smeu',
            'email' => 'victor@victorsmeu.com',
            'password' => bcrypt('victor123'),
            'role_id' => 1,
            'active' => 1
        ]);

        User::create([
            'id' => 2,
            'first_name' => 'Demo',
            'last_name' => 'Medic',
            'email' => 'demomedic@wh2.com',
            'password' => bcrypt('demo123'),
            'role_id' => 3,
            'active' => 1
        ]);

        User::create([
            'id' => 3,
            'first_name' => 'Ion',
            'last_name' => 'Popescu',
            'email' => 'ion.popescu@demo.com',
            'password' => bcrypt('popescuion123'),
            'role_id' => 4,
            'active' => 1
        ]);
    }
}
