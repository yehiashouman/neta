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
                'fill'=> array('color'=>'','type'=>'solid'),
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
        $this->border_width = isset($this->border->width)?$this->border->width : 1;
        $this->fill_color = !empty($this->fill->color)? $this->hexToAllocatedColor($this->canvas,$this->fill->color) :"";
        $this->fill_type = !empty($this->fill->type)? $this->fill->type : "solid";
        imagesetthickness($this->canvas,$this->border_width);
        $this->renderShapes();
        
    }
    protected function renderShapes()
    {
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