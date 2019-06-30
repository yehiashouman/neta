<?php
namespace App\Models;
use App\Models\Traits\Colorable;
use App\Models\Traits\Displayable;

/**
* Class Stage
* 
* Stage Class represents the image where the rendering takes place. The stage also holds an array of shapes added.  
* @package App\Models
*/
class Stage {
    //an array of shapes added to stage, could be used in future implementations to remove shapes amid running time.
    protected $_shapes;
    //uses colorable for color names/hex conversion
    use Colorable;
    use Displayable;
    //stage background color
    protected $_backgroundColor;
    protected $_errors;
    /**
    * Stage Class constructor.
    *
    * @param $stage_props the stage properties (width, height and background color ..etc)
    *
    */
    function __construct($stage_props)
    {
        //set background color, width and height from stage props
        $this->_backgroundColor = isset($stage_props["background"])? $stage_props["background"]: "#ffffff";
        $this->_width = isset($stage_props["width"])? $stage_props["width"] : 900;
        $this->_height = isset($stage_props["height"])? $stage_props["height"]: 400;
        //instantiate a new image from 
        $this->_canvas = imagecreatetruecolor($this->_width, $this->_height);
        //clear shapes array
        $this->clear();
    } 
    /**
     * Clears the stage for a new render.
     *
     */
    public function clear(){
        //clear shapes
        $this->_shapes = [];
        $this->_errors = [];
    }
    /**
     * Parses a shapes json and stores a reference to all newly created shapes on a shapes array. Also 
     * stores a reference of every parse error on an errors property.
     * @param $data $data to parse  
     *
     */
    public function parse($data)
    {
        //clear shapes before parsing new data.
        $this->clear();
            //parse provided shapes data
            foreach($data->shapes as $key=>$shape_data)
            {
                try{
                    $class_name = "App\\Models\\Shapes\\".ucwords($shape_data->type);
                    if(!class_exists($class_name)){
                        array_push($this->_errors,new \Exception("Shape can not have type '$shape_data->type', because class '".$class_name."' not found"));
                        continue;
                    }
                    $shape = new $class_name();
                    //instruct shape to parse its own data.
                    $shape->parse($shape_data);
                    //add a its reference to shapes array
                    array_push($this->_shapes, $shape);
                
                }catch(\Exception $e)
                {
                    array_push($this->_errors,$e);
                    
                }
            }
        
    }
    /**
     * Renders the stored shapes array. 
     */
    public function render(){
        //add a background color to clear the image.
        imagefilledrectangle($this->_canvas, 0, 0, $this->_width, $this->_height, $this->hexToAllocatedColor($this->_canvas,$this->_backgroundColor));
        foreach($this->_shapes as $shape)
        {
            try{
                //render every shape in shapes array.
                $shape->render($this->_canvas);
            }catch(\Exception $e)
            {
                array_push($this->_errors,$e);
                    
            }
        }
    }
    /**
     * Exports the rendered shapes to an array or to a image canvas based on $format. 
     * @param $format $format is either a binary (image) or an array, further export formats can be added here.  
     */
    public function export($format){
        switch($format){
            case "binary":
                //instantiate a stream to write the image data to
                $stream = fopen("php://memory", "w+");
                //write image data to stream
                imagejpeg($this->_canvas,$stream,100);
                //rewind stream buffer
                rewind($stream);
                //get the stream content
                $contents = stream_get_contents($stream);
                //encode to base64 to serve as a image data on frontend 
                $base64   = base64_encode($contents); 
                $mime = 'image/jpeg';
                //clear from memory the image canvas, could actually be removed if further processing is needed.
                imagedestroy($this->_canvas); 
                //return an image to be embedded in frontend template
                return ('<img src="data:' . $mime . ';base64,' . $base64.'"/>');
                
            break;
            case "array":
                //while requirements was not clear on array type, same input json was used.
                return json_encode($this->_shapes);    
            break;
        
        }
        
    }
    /*
     * Setter for property errors
     *
     * @param $value new value for property
     */
     public function setErrors($value)
     {
     	throw new InvalidArgumentException("Errors can not be set on class.");
     }
     /*
     * Getter for property errors
     */
     public function getErrors()
     {
     	return $this->_errors;
     }
    
}

?>