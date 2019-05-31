<?php
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class JSONFormTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testJSONFormFields()
    {
        $this->get('/shapes');
        
        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }
}
