<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * Tests login functionality
     *
     * @return void
     */
    public function testLogin()
    {
        $faker = Faker\Factory::create();
        $pass = $faker->password();
        
        $this->visit('/register')
                ->type($faker->firstName, 'first_name')
                ->type($faker->lastName, 'last_name')
                ->type($faker->email, 'email')
                ->type($pass, 'password')
                ->type($pass, 'password_confirmation')
            ->press('Register')
            ->seePageIs('/dashboard');
    }
}