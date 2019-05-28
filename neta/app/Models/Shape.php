<?php 
namespace App\Models;
use Exception;
use App\Models\Colorable;
class Shape implements ShapeInterface{
    use Colorable;
    protected $canvas;
    const DEFAULT_ATTRIBS = [
                'x'=> 0,
                'y'=> 0,
                'border'=> array('color'=>'#000','width'=>1),
                'width'=>0,
                'height'=>0,
                'type'=>'',    
                
        ];
    protected $attributes;
    public function __construct($canvas=null){
        $this->attributes = self::DEFAULT_ATTRIBS;
        $this->canvas = $canvas;
    }
    
    
    /**
     * Parses the shape attribute data provided by Stage.
     *
     * @param Canvas $data 
     *
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
     *
     * @param Canvas $canvas 
     *
     * @return Response
     *
     * @throws CanvasNotFoundException
     *
     */
    public function render($canvas){
        if(!isset($canvas) || is_null($canvas)){
                    throw new Exception("CanvasNotFoundException");
                    
        }
        $this->canvas = $canvas;
        $this->border_color = $this->hexToAllocatedColor($this->canvas,$this->border->color);
        $this->border_width = $this->border->width;
        imagesetthickness($this->canvas,$this->border_width);
        $this->renderShapes();
        
    }
    protected function renderShapes()
    {
        switch($this->type)
        {
            case "circle":
                $this->width = $this->height = 2 * ($this->perimeter / (2 * pi()));
                imageellipse($this->canvas, $this->x, $this->y, $this->width,$this->height,$this->border_color);
                break;
            case "rectangle":
                imagerectangle($this->canvas, $this->x, $this->y, $this->x+$this->width, $this->y+$this->height, $this->border_color);
                break;
            case "square":
                imagerectangle($this->canvas, $this->x, $this->y, $this->x+$this->sideLength, $this->y+$this->sideLength, $this->border_color);
                $this->width = $this->height = $this->sideLength;
            break;
        }
        
    }
     function __set($key, $val) {
         $this->attributes[$key]=$val;
         
     }
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