<?php
namespace Tests;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require_once __DIR__.'/../bootstrap/app.php';
        //if (file_exists(dirname(__DIR__).'/.env')) {
        //    ( new \Dotenv\Dotenv(dirname(__DIR__), '.env') )->load();
        //}

        //$app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
