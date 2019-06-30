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
        parent::__construct($canvas);
        
    }
    /**
     * Renders Rectangle.
     *
     */ 
    public function render($canvas)
    {
        parent::render($canvas);
        if($this->_fill_type=="solid" ){
            imagefilledrectangle($this->_canvas, $this->_x, $this->_y, $this->_x+$this->_width, $this->_y+$this->_height, $this->_fill_color);
        }
        imagerectangle($this->_canvas, $this->_x, $this->_y, $this->_x+$this->_width, $this->_y+$this->_height, $this->_border_color);
       
    }

}
?>