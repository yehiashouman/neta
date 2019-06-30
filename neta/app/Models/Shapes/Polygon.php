<?php 
namespace App\Models\Shapes;
use Exception;
/**
* Class Polygon
* 
* Polygon Class represents, parses shape data, and renders the shape on a canvas owned by a stage.  
* @package App\Models
*/
class Polygon extends Shape implements ShapeInterface{
    protected $_sides;
    protected $_size;
    /**
     * Polygon Class constructor.
     *
     * @param $canvas 
     *
     */
    public function __construct($canvas=null){
        parent::__construct($canvas);
        
    }
    /**
     * Renders Polygon
     *
     */ 
    public function render($canvas)
    {
        parent::render($canvas);
        $points = [];
        for($a = 0;$a <= 360; $a += 360/$this->_sides)
        {
            $points[] = $this->_x + ($this->_size) * cos(deg2rad($a));
            $points[] = $this->_y + ($this->_size) * sin(deg2rad($a));
        }
        if($this->_fill_type=="solid" ){
            imagefilledpolygon($this->_canvas,$points,$this->_sides,$this->_fill_color);
        }
        imagepolygon($this->_canvas,$points,$this->_sides,$this->_border_color);
    }
    /*
     * Setter for property sides
     *
     * @param $value new value for property
     */
     public function setSides($value)
     {
     	if (! ( (is_int($value) || ctype_digit($value)) && (int)$value >= 0))  
     	{
     		throw new InvalidArgumentException("Property sides accepts integers greater than 0.");
     	}
     	$this->_sides = $value;
     }
     /*
     * Getter for property sides
     */
     public function getSides()
     {
     	return $this->_sides;
     }
     /*
     * Setter for property size
     *
     * @param $value new value for property
     */
     public function setSize($value)
     {
     	if (! ( (is_int($value) || ctype_digit($value)) && (int)$value > 0))  
     	{
     		throw new InvalidArgumentException("Property size accepts integers greater than 0.");
     	}
     	$this->_size = $value;
     }
     /*
     * Getter for property size
     */
     public function getSize()
     {
     	return $this->_size;
     }
     

}
?>