<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    
    private $first_name; 
    private $last_name;
    private $email;
    private $password;
    
    public function __construct()
    {
        $faker = Faker\Factory::create();
        $this->first_name = $faker->firstName;
        $this->last_name = $faker->lastName;
        $this->email = $faker->email;
        $this->password = $faker->password();
    }
    
    /**
     * Tests register functionality
     *
     * @return void
     */
    public function testRegister_expectAccountPending()
    {
        $this->visit('/register')
                ->type($this->first_name, 'first_name')
                ->type($this->last_name, 'last_name')
                ->type($this->email, 'email')
                ->type($this->password, 'password')
                ->type($this->password, 'password_confirmation')
                ->press('Register')
                ->seePageIs('/new-account-pending');
    }
    
    public function testLoginPage_expectsForm()
    {   
        $response = $this->call('GET', 'login');

        $this->assertTrue($response->isOk());

        View::shouldReceive('make')->with('login');
    }
    
    public function testLoginPage_withBadCredentials_expectsErrors()
    {
        $credentials = [
            'email' => 'test@test.com',
            'password' => 'secret',
        ];

        Auth::shouldReceive('attempt')
             ->once()
             ->with($credentials)
             ->andReturn(false);

        $this->call('POST', '/login', $credentials);

        $this->assertRedirectedToAction(
            'Auth\AuthController@login', 
            null, 
            ['flash_message']
        );
    }
}