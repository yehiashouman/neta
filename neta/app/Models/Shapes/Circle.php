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
    protected $_perimeter;
    /**
     * Circle Class constructor.
     *
     * @param $canvas 
     *
     */
    public function __construct($canvas=null){
        parent::__construct($canvas);
        
    }
    /**
     * Renders Circle
     *
     */ 
    public function render($canvas)
    {
        parent::render($canvas);
        $this->_width = $this->_height = 2 * ($this->_perimeter / (2 * pi()));
        if($this->_fill_type=="solid" ){
            imagefilledellipse($this->_canvas, $this->_x+($this->_width/2), $this->_y+($this->_height/2), $this->_width,$this->_height,$this->_fill_color);
        }
        imageellipse($this->_canvas, $this->_x+($this->_width/2), $this->_y+($this->_height/2), $this->_width,$this->_height,$this->_border_color);
                
        
    }
    /*
     * Setter for property perimeter
     *
     * @param $value new value for property
     */
     public function setPerimeter($value)
     {
     	if (!(is_int($value) || ctype_digit($value)) || !((int)$value >= 0))  
     	{
     		throw new InvalidArgumentException("Property perimeter accepts integers greater than 0.");
     	}
     	$this->_perimeter = $value;
     }
     /*
     * Getter for property perimeter
     */
     public function getPerimeter()
     {
     	return $this->_perimeter;
     }

}
?>