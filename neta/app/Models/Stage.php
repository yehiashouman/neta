<?php
namespace App\Models;
use App\Models\Colorable;
/**
* Class Stage
* 
* Stage Class represents the image where the rendering takes place. The stage also holds an array of shapes added.  
* @package App\Models
*/
class Stage {
    //uses colorable for color names/hex conversion
    use Colorable;
    //shapes data
    protected $data;
    //canvas on which  all the rendering is done
    protected $canvas;
    //an array of shapes added to stage, could be used in future implementations to remove shapes amid running time.
    protected $shapes;
    //stage width
    protected $width;
    //stage height
    protected $height;
    //stage background color
    protected $backgroundColor;
    /**
    * Stage Class constructor.
    *
    * @param $stage_props the stage properties (width, height and background color ..etc)
    *
    */
    function __construct($stage_props)
    {
        //set background color, width and height from stage props
        $this->backgroundColor = isset($stage_props["background"])? $stage_props["background"]: "#ffffff";
        $this->width = isset($stage_props["width"])? $stage_props["width"] : 900;
        $this->height = isset($stage_props["height"])? $stage_props["height"]: 400;
        //instantiate a new image from 
        $this->canvas = imagecreatetruecolor($this->width, $this->height);
        //clear shapes array
        $this->clear();
    } 
    public function clear(){
        //clear shapes
        $this->shapes = [];
    }
    public function parse($data)
    {
        //clear shapes before parsing new data.
        $this->clear();
        //parse provided shapes data
        foreach($data->shapes as $key=>$shape_data)
        {
            $class_name = "App\\Models\\Shapes\\".ucwords($shape_data->type);
            $shape = new $class_name();
           // dd($shape); 
            //instruct shape to parse its own data.
            $shape->parse($shape_data);
            //add a its reference to shapes array
            array_push($this->shapes, $shape);
        }
    }
    public function render(){
        //add a background color to clear the image.
        imagefilledrectangle($this->canvas, 0, 0, $this->width, $this->height, $this->hexToAllocatedColor($this->canvas,$this->backgroundColor));
        foreach($this->shapes as $shape)
        {
            //render every shape in shapes array.
            $shape->render($this->canvas);
        }
    }
    public function export($format){
        switch($format){
            case "binary":
                //instantiate a stream to write the image data to
                $stream = fopen("php://memory", "w+");
                //write image data to stream
                imagejpeg($this->canvas,$stream,100);
                //rewind stream buffer
                rewind($stream);
                //get the stream content
                $contents = stream_get_contents($stream);
                //encode to base64 to serve as a image data on frontend 
                $base64   = base64_encode($contents); 
                $mime = 'image/jpeg';
                //clear from memory the image canvas, could actually be removed if further processing is needed.
                imagedestroy($this->canvas); 
                //return an image to be embedded in frontend template
                return ('<img src="data:' . $mime . ';base64,' . $base64.'"/>');
                
            break;
            case "array":
                //while requirements was not clear on array type, same input json was used.
                return json_encode($this->shapes);    
            break;
        
        }
        
    }
}

?>