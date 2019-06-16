<?php 
namespace App\Models\Shapes;
use Exception;
use App\Models\Colorable;
/**
* Class Shape
* 
* Shape Class represents, parses shape data, and renders the shape on a canvas owned by a stage.  
* @package App\Models
*/
class Shape implements ShapeInterface{
    //uses colorable for hex/color names conversions.
    use Colorable;
    protected $canvas;
    //defined default attributes for any shape
    const DEFAULT_ATTRIBS = [
                'x'=> 0,
                'y'=> 0,
                'border'=> array('color'=>'#000','width'=>1),
                'fill'=> array('color'=>'','type'=>'solid'),
                'width'=>0,
                'height'=>0,
                'type'=>'',    
        ];
    //this is the attributes objects where all the properties will be stored.
    protected $attributes;
    /**
     * Shape Class constructor.
     *
     * @param $canvas 
     *
     */
    public function __construct($canvas=null){
        $this->attributes = self::DEFAULT_ATTRIBS;
        $this->canvas = $canvas;
    }
    /**
     * Parses the shape attribute data provided by Stage.
     *
     * @param Canvas $data 
     * @throws NullAttributeException
     *
     */
    public function parse($data)
    {
        foreach($data as $key=>$value)
        {
            $this->$key = $value;   
        }
        
    }
    /**
     * Renders the shape on the canvas provided.
     * @param Canvas $canvas 
     * @throws CanvasNotFoundException if no canvas provided.
     *
     */
    public function render($canvas){
        if(!isset($canvas) || is_null($canvas)){
                    throw new Exception("CanvasNotFoundException");
                    
        }
        $this->canvas = $canvas;
        $this->border_color = $this->hexToAllocatedColor($this->canvas,$this->border->color);
        $this->border_width = isset($this->border->width)?$this->border->width : 1;
        $this->fill_color = !empty($this->fill->color)? $this->hexToAllocatedColor($this->canvas,$this->fill->color) :"";
        $this->fill_type = !empty($this->fill->type)? $this->fill->type : "solid";
        imagesetthickness($this->canvas,$this->border_width);
        $this->renderGraphic();
        
    }
    /**
     * Renders any shape, this can be further extended to be sub classes that manage different shapes of more complex way.
     *
     */
    protected function renderGraphic()
    {
        //implemented in sub classes
        /*
        switch($this->type)
        {
            case "circle":
                $this->width = $this->height = 2 * ($this->perimeter / (2 * pi()));
                if($this->fill_type=="solid" ){
                    imagefilledellipse($this->canvas, $this->x+($this->width/2), $this->y+($this->height/2), $this->width,$this->height,$this->fill_color);
                }
                imageellipse($this->canvas, $this->x+($this->width/2), $this->y+($this->height/2), $this->width,$this->height,$this->border_color);
                break;
            case "rectangle":
                if($this->fill_type=="solid" ){
                    imagefilledrectangle($this->canvas, $this->x, $this->y, $this->x+$this->width, $this->y+$this->height, $this->fill_color);
                }
                imagerectangle($this->canvas, $this->x, $this->y, $this->x+$this->width, $this->y+$this->height, $this->border_color);
                break;
            case "square":
                if($this->fill_type=="solid" ){
                    imagefilledrectangle($this->canvas, $this->x, $this->y, $this->x+$this->sideLength, $this->y+$this->sideLength, $this->fill_color);
                }
                imagerectangle($this->canvas, $this->x, $this->y, $this->x+$this->sideLength, $this->y+$this->sideLength, $this->border_color);
                $this->width = $this->height = $this->sideLength;
            break;
            case "polygon":
                $points = [];
                for($a = 0;$a <= 360; $a += 360/$this->sides)
                {
                    $points[] = $this->x + ($this->size) * cos(deg2rad($a));
                    $points[] = $this->y + ($this->size) * sin(deg2rad($a));
                }
                if($this->fill_type=="solid" ){
                    imagefilledpolygon($this->canvas,$points,$this->sides,$this->fill_color);
                }
                imagepolygon($this->canvas,$points,$this->sides,$this->border_color);
            break;
        }
        */
        
    }
    /** 
     * Magic setter is used to handle all attribute setting on shape class instance to be set on attributes object instead..
     *
     * @param $key the key attribute to set
     * @param $value the value of the attribute to set
     */
     function __set($key, $val) {
         $this->attributes[$key]=$val;
         
     }
    /**
     * Magic getter is used to handle all attribute getting from a shape instance to be get from attributes object instead..
     *
     * @param $key the key attribute to get
     */
     function __get($key){
         if(isset($this->attributes[$key]))
         {
             return $this->attributes[$key];
             
         }else{
             
             throw new Exception("Property '".$key."' not found on Shape Array");
         }
     }
}
?>