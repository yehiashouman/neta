<?php
namespace Tests;
use Illuminate\Support\Facades\Event;
use TestCase as BaseTestCase;
use \App\Models\Stage;
use \App\Models\Shapes\Circle;
use \App\Models\Shapes\Square;
use \App\Models\Shapes\Rectangle;
use \App\Models\Shapes\Polygon;
/**
 * Class Test Shapes Models.
 */
class ShapesTest extends TestCase
{
    protected $baseUrl = 'http://localhost:8000';
    /* 
    * Test stage holds dimensions passed to constructor and are available in properties 
    */
    public function testStageDimensions()
    {
        $stage = new Stage(["width"=>300,"height"=>300]);
        $this->assertEquals($stage->width,300);
        $this->assertEquals($stage->height,300);
    }
    /* 
    * Test that stage would can parse correct JSON
    */
    public function testStageCanParseCorrectJSON()
    {
        $stage = new Stage(["width"=>300,"height"=>300]);
        $sample_data = json_decode('{"shapes":[{"type": "polygon","x":200,"y":200,"size": 50,"sides":6,"fill":{"type":"solid","color":"blue"},"border":{"color": "yellow","width": 2}},{"type": "polygon","x":250,"y":80,"size": 80,"sides":4,"fill":{"type":"solid","color":"red"},"border":{"color": "gray","width": 3}},{"type": "polygon","x":350,"y":150,"size": 80,"sides":5,"fill":{"type":"solid","color":"black"},"border":{"color": "navy","width": 3}},{"type": "polygon","x":300,"y":300,"size": 80,"sides":3,"fill":{"type":"solid","color":"green"},"border":{"color": "fuchsia","width": 3}},{"type": "circle","x":0,"y":0,"perimeter": 300,"fill":{"type":"solid","color":"green"},"border":{"color": "red","width": 2}},{"type": "square","x":550,"y":90,"sideLength": 150,"fill":{"type":"solid","color":"blue"},"border": {"color": "#776cff","width": 2}},{"type": "rectangle","x":30,"y":250,"width": 600,"height":100,"fill":{"type":"solid","color":"red"},"border": {"color": "#ff6cff","width": 3}}]}');
        $stage->parse($sample_data);
        $this->assertEquals($stage->errors,[]);
    }
    /*
    * Test that Stage would have errors of parsing stored in its 'errors' property after parse.
    */
    public function testStageCanParseMalformedJSON()
    {
        $stage = new Stage(["width"=>300,"height"=>300]);
        //sample with 1 faults in json (x = -10)
        $sample_data = json_decode('{"shapes":[{"type": "polygon","x":-10,"y":200,"size": 50,"sides":6,"fill":{"type":"solid","color":"blue"},"border":{"color": "yellow","width": 2}},{"type": "polygon","x":250,"y":80,"size": 80,"sides":4,"fill":{"type":"solid","color":"red"},"border":{"color": "gray","width": 3}},{"type": "polygon","x":350,"y":150,"size": 80,"sides":5,"fill":{"type":"solid","color":"black"},"border":{"color": "navy","width": 3}},{"type": "polygon","x":300,"y":300,"size": 80,"sides":3,"fill":{"type":"solid","color":"green"},"border":{"color": "fuchsia","width": 3}},{"type": "circle","x":0,"y":0,"perimeter": 300,"fill":{"type":"solid","color":"green"},"border":{"color": "red","width": 2}},{"type": "square","x":550,"y":90,"sideLength": 150,"fill":{"type":"solid","color":"blue"},"border": {"color": "#776cff","width": 2}},{"type": "rectangle","x":30,"y":250,"width": 600,"height":100,"fill":{"type":"solid","color":"red"},"border": {"color": "#ff6cff","width": 3}}]}');
        $stage->parse($sample_data);
        if(count($stage->errors)>0)
        {
            foreach($stage->errors as $error){
                echo "\r\n".$error->getMessage();
                
            }
        }
        $this->assertEquals(count($stage->errors),1);
    }
    /*
    * Test that a circle shape holds initialization values after parse
    */
    public function testCirclePropertiesAreAvailableAfterParse()
    {
        $canvas = imagecreatetruecolor(300, 300);
        $circle = new Circle($canvas);
        $circle_data = json_decode('{"type": "circle","x":0,"y":0,"perimeter": 300,"fill":{"type":"solid","color":"green"},"border":{"color": "red","width": 2}}');
        $circle->parse($circle_data);
        $circle->render($canvas);
        $this->assertEquals($circle->perimeter,300);
    }
    /*
    * Test that a square shape holds initialization values after parse
    */
    public function testSquarePropertiesAreAvailableAfterParse()
    {
        $canvas = imagecreatetruecolor(300, 300);
        $square = new Square($canvas);
        $square_data = json_decode('{"type": "square","x":550,"y":90,"sideLength": 150,"fill":{"type":"solid","color":"blue"},"border": {"color": "#776cff","width": 2}}');
        $circle_data = json_decode('{"type": "circle","x":0,"y":0,"perimeter": 300,"fill":{"type":"solid","color":"green"},"border":{"color": "red","width": 2}}');
        $square->parse($square_data);
        $square->render($canvas);
        $this->assertEquals($square->width,150);
    }
    /*
    * Test that a rectangle shape holds initialization values after parse
    */
    public function testRectanglePropertiesAreAvailableAfterParse()
    {
        $canvas = imagecreatetruecolor(300, 300);
        $rectangle = new Rectangle($canvas);
        $rectangle_data = json_decode('{"type": "rectangle","x":30,"y":250,"width": 600,"height":100,"fill":{"type":"solid","color":"red"},"border": {"color": "#ff6cff","width": 3}}');
        $rectangle->parse($rectangle_data);
        $rectangle->render($canvas);
        $this->assertEquals($rectangle->width,600);
        $this->assertEquals($rectangle->height,100);
    }
    /*
    * Test that a polygon shape holds initialization values after parse
    */
    public function testPolygonPropertiesAreAvailableAfterParse()
    {
        $canvas = imagecreatetruecolor(300, 300);
        $rectangle = new Polygon($canvas);
        $rectangle_data = json_decode('{"type": "polygon","x":200,"y":200,"size": 50,"sides":6,"fill":{"type":"solid","color":"blue"},"border":{"color": "yellow","width": 2}}');
        $rectangle->parse($rectangle_data);
        $rectangle->render($canvas);
        //die();
        $this->assertEquals($rectangle->size,50);
        $this->assertEquals($rectangle->sides,6);
    }
    /*
    * Test that the stage is rendering a square on a canvas
    */
    public function testStageIsRendering()
    {
        $stage = new Stage(["width"=>5,"height"=>5]);
        //draw a 3x3 black square within a 5x5 image
        $sample_data = json_decode('{"shapes":[{"type": "square","x":2,"y":2,"sideLength": 3,"fill":{"type":"solid","color":"black"},"border": {"color": "#000000","width": 1}}]}');
        $stage->parse($sample_data);
        $stage->render();
        //test pixel color at 0,0 -> should be white -> 16777215
        $canvas_pixel = (imagecolorat($stage->canvas,0,0));
        //test pixel color at 2,2, -> should be black -> 0
        $square_pixel = (imagecolorat($stage->canvas,2,2));
        
        $this->assertEquals($canvas_pixel,16777215);
        $this->assertEquals($square_pixel,0);   
    }

}
