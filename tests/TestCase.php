<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';
    
    /**
     * Sets up the db connection (testing db set to sqlite)
     */
    public function setUp()
    {
        parent::setUp();
        
        Artisan::call('migrate:reset');
        Artisan::call('migrate');

        $this->seed();
    }
    

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
    
    
    protected function getResponseData($response, $key)
    {

        $content = $response->getOriginalContent();
        $content = $content->getData();

        return $content[$key]->all();
    }

}
