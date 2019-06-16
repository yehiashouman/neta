<?php 
namespace App\Models\Shapes;
use Exception;
/**
* Class Square
* 
* Square Class represents, parses shape data, and renders the shape on a canvas owned by a stage.  
* @package App\Models
*/
class Square extends Shape implements ShapeInterface{
    /**
     * Square Class constructor.
     *
     * @param $canvas 
     *
     */
    public function __construct($canvas=null){
        parent::__construct();
        
    }
    /**
     * Renders Square.
     *
     */ 
    protected function renderGraphic()
    {
        if($this->fill_type=="solid" ){
            imagefilledrectangle($this->canvas, $this->x, $this->y, $this->x+$this->sideLength, $this->y+$this->sideLength, $this->fill_color);
        }
        imagerectangle($this->canvas, $this->x, $this->y, $this->x+$this->sideLength, $this->y+$this->sideLength, $this->border_color);
        $this->width = $this->height = $this->sideLength;
    }

}
?>