<?php

namespace Tests;
use TestCase as BaseTestCase;
use Illuminate\Support\Facades\App;
//use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

/**
 * Class TestCase.
 */
abstract class BrowserKitTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://www.yehiashouman.com:8000/';

    /**
     * @var
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
die("setting up");
        
        $this->baseUrl = env('APP_URL');//


        // Run the tests in English
        App::setLocale('en');

    }
}
