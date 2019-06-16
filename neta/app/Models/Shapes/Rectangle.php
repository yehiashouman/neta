<?php 
namespace App\Models\Shapes;
use Exception;
/**
* Class Rectangle
* 
* Rectangle Class represents, parses shape data, and renders the shape on a canvas owned by a stage.  
* @package App\Models
*/
class Rectangle extends Shape implements ShapeInterface{
    /**
     * Rectangle Class constructor.
     *
     * @param $canvas 
     *
     */
    public function __construct($canvas=null){
        parent::__construct();
        
    }
    /**
     * Renders Rectangle.
     *
     */ 
    protected function renderShapes()
    {
        if($this->fill_type=="solid" ){
            imagefilledrectangle($this->canvas, $this->x, $this->y, $this->x+$this->width, $this->y+$this->height, $this->fill_color);
        }
        imagerectangle($this->canvas, $this->x, $this->y, $this->x+$this->width, $this->y+$this->height, $this->border_color);
       
    }

}
?>