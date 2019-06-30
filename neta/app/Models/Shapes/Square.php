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
    protected $_sideLength;
    /**
     * Square Class constructor.
     *
     * @param $canvas 
     *
     */
    public function __construct($canvas=null){
        parent::__construct($canvas);
        
    }
    /**
     * Renders Square.
     *
     */ 
    public function render($canvas)
    {
        parent::render($canvas);
        if($this->_fill_type=="solid" ){
            imagefilledrectangle($this->_canvas, $this->_x, $this->_y, $this->_x+$this->_sideLength, $this->_y+$this->_sideLength, $this->_fill_color);
        }
        imagerectangle($this->_canvas, $this->_x, $this->_y, $this->_x+$this->_sideLength, $this->_y+$this->_sideLength, $this->_border_color);
        $this->_width = $this->_height = $this->_sideLength;
    }
    /*
     * Setter for property sideLength
     *
     * @param $value new value for property
     */
     public function setSideLength($value)
     {
       if (! ( (is_int($value) || ctype_digit($value)) && (int)$value >= 0))  
     	{
     		throw new InvalidArgumentException("Property sideLength accepts integers greater than 0.");
     	}
     	$this->_sideLength = $value;
     }
     /*
     * Getter for property sideLength
     */
     public function getSideLength()
     {
     	return $this->_sideLength;
     }

}
?>