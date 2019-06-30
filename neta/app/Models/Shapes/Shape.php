<?php 
namespace App\Models\Shapes;
use Exception;
use InvalidArgumentException;
use App\Models\Traits\Colorable;
use App\Models\Traits\Displayable;
/**
* Class Shape
* 
* Shape Class represents, parses shape data, and renders the shape on a canvas owned by a stage.  
* @package App\Models
*/
class Shape implements ShapeInterface{
    //uses colorable for hex/color names conversions.
    use Colorable;
    use Displayable;
    protected $_border_width,$_border_color;
    protected $_fill_type,$_fill_color;
    protected $_fill,$_border;
    protected $_type;
    //defined default attributes for any shape
    private $DEFAULT_ATTRIBS = [
                '_x'=> 0,
                '_y'=> 0,
                '_border'=> array('color'=>'#000','width'=>1),
                '_fill'=> array('color'=>'','type'=>'solid'),
                '_width'=>0,
                '_height'=>0,
                '_type'=>'',    
        ];
    //this is the attributes objects where all the properties will be stored.
    //protected $attributes;
    /**
     * Shape Class constructor.
     *
     * @param $canvas 
     *
     */
    public function __construct($canvas=null){
        //$this->attributes = self::DEFAULT_ATTRIBS;
        foreach($this->DEFAULT_ATTRIBS as $key=>$val)
        {
            $this->$key =$val;
            
        }
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
        $this->_canvas = $canvas;
        $this->_border_color = $this->hexToAllocatedColor($this->_canvas,$this->_border->color);
        $this->_border_width = isset($this->_border->width)?$this->_border->width : 1;
        $this->_fill_color = !empty($this->_fill->color)? $this->hexToAllocatedColor($this->_canvas,$this->_fill->color) :"";
        $this->_fill_type = !empty($this->_fill->type)? $this->_fill->type : "solid";
        imagesetthickness($this->_canvas,$this->_border_width);
        
    }

     
     /*
     * Setter for property type
     *
     * @param $value new value for property
     */
     public function setType($value)
     {
     	if (!is_string($value)) 
     	{
     		throw new InvalidArgumentException("Property Type must be of type string.");
     	}
     	$this->_type = $value;
     }
     /*
     * Getter for property type
     */
     public function getType()
     {
     	return $this->_type;
     }
     
     public function setBorder($value)
     {
        
     	if (!is_object($value) || !(array_key_exists("color",$value) ||  array_key_exists("width",$value)) ) 
     	{
     		throw new InvalidArgumentException("Property border accepts an array with color and width as keys.");
     	}
     	$this->_border = $value;
     }
     /*
     * Getter for property border
     */
     public function getBorder()
     {
     	return $this->_border;
     }
     /*
     * Setter for property fill
     *
     * @param $value new value for property
     */
     public function setFill($value)
     {
       	if (!is_object($value) || !(array_key_exists("color",$value) ||  array_key_exists("type",$value)) ) 
     	{
     		throw new InvalidArgumentException("Property fill accepts an array with color and type as keys.");
     	}
     	$this->_fill = $value;
     }
     /*
     * Getter for property fill
     */
     public function getFill()
     {
     	return $this->_fill;
     }
     
}
?>