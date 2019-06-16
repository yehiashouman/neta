<?php 
namespace App\Models\Shapes;
use Exception;
/**
* Class Circle
* 
* Circle Class represents, parses shape data, and renders the shape on a canvas owned by a stage.  
* @package App\Models
*/
class Circle extends Shape implements ShapeInterface{
    /**
     * Circle Class constructor.
     *
     * @param $canvas 
     *
     */
    public function __construct($canvas=null){
        parent::__construct();
        
    }
    /**
     * Renders Circle
     *
     */ 
    protected function renderShapes()
    {
        $this->width = $this->height = 2 * ($this->perimeter / (2 * pi()));
        if($this->fill_type=="solid" ){
            imagefilledellipse($this->canvas, $this->x+($this->width/2), $this->y+($this->height/2), $this->width,$this->height,$this->fill_color);
        }
        imageellipse($this->canvas, $this->x+($this->width/2), $this->y+($this->height/2), $this->width,$this->height,$this->border_color);
                
        
    }

}
?>