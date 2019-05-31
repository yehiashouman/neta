<?php
namespace Tests\Forms;
use Tests\BrowserKitTestCase;
use Illuminate\Support\Facades\Event;

/**
 * Class Graphic Editor Pages.
 */
class ShapesTest extends BrowserKitTestCase
{
    /**
     * Test the index page works and buttons appear.
     */
    public function testIndexPage()
    {
        $this->visit('/shapes')->see('JSON Renderer')
        ->see("Please enter Shapes JSON data:")
        ->see("JSON Data:")
        ->see("Output Format:")
        ->see("Rendering:")
        ->see("Render");
    }

    /**
     * Test the rendering page works and displays text.
     */
    public function testRenderPage()
    {
        $this
             ->visit('/shapes/render')
             ->see('Side')
             ;
    }


}
