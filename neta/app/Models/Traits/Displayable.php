<?php 
namespace App\Models\Traits;
use \Exception;
use \InvalidArgumentException;
/**
* Trait Displayable
* 
* Displayable provides basic display features and properties like dimensions and positions ..etc.
*   
* @package App\Models
*/
trait Displayable {
     //canvas on which  all the rendering is done
    protected $_canvas;
    //element width
    protected $_width;
    //element height
    protected $_height;
    //element x, y positions
    protected $_x,$_y;

         /*
     * Setter for property x
     *
     * @param $value new value for property
     */
     public function setX($value)
     {
        if (! ( (is_int($value) || ctype_digit($value)) && (int)$value >= 0))  
     	{
     		throw new InvalidArgumentException("Property X accepts integers greater than 0.");
     	}
     	$this->_x = $value;
     }
     /*
     * Getter for property x
     */
     public function getX()
     {
     	return $this->_x;
     }
     /*
     * Setter for property y
     *
     * @param $value new value for property
     */
     public function setY($value)
     {
     	if (! ( (is_int($value) || ctype_digit($value)) && (int)$value >= 0))  
     	{
     		throw new InvalidArgumentException("Property Y accepts integers greater than 0.");
     	}
     	$this->_y = $value;
     }
     /*
     * Getter for property y
     */
     public function getY()
     {
     	return $this->_y;
     }
     /*
     * Setter for property width
     *
     * @param $value new value for property
     */
     public function setWidth($value)
     {
     	if (! ( (is_int($value) || ctype_digit($value)) && (int)$value >= 0))  
     	{
     		throw new InvalidArgumentException("Property width accepts integers greater than 0.");
     	}
     	$this->_width = $value;
     }
     /*
     * Getter for property width
     */
     public function getWidth()
     {
     	return $this->_width;
     }
	/*
     * Setter for property height
     *
     * @param $value new value for property
     */
     public function setHeight($value)
     {
     	if (! ( (is_int($value) || ctype_digit($value)) && (int)$value >= 0))  
     	{
     		throw new InvalidArgumentException("Property height accepts integers greater than 0.");
     	}
     	$this->_height = $value;
     }
     /*
     * Getter for property height
     */
     public function getHeight()
     {
     	return $this->_height;
     }
     /*
     * Setter for property canvas
     *
     * @param $value new value for property
     */
     public function setCanvas($value)
     {
     	
     	$this->_canvas = $value;
     }
     /*
     * Getter for property canvas
     */
     public function getCanvas()
     {
     	return $this->_canvas;
     }
        /** 
     * Magic setter is used to handle all attribute setting on shape class instance to be set on attributes object instead..
     *
     * @param $key the key attribute to set
     * @param $value the value of the attribute to set
     */
     public function __set($key, $val) {
         if(property_exists(get_class($this),"_".$key)){
            $this->{"set".ucfirst($key)}($val);
         }
         else{
             throw new Exception("Trying to set a non existing property '".$key."' on '".get_class($this)."' ");
         }
     }
    /**
     * Magic getter is used to handle extra attribute defined by inheriting shapes .
     * 
     * @param $key the key attribute to get
     */
     
     public function __get($key){
         
         if(property_exists(get_class($this),"_".$key))
         {
             
             return $this->{"get".ucfirst($key)}();
             
         }else{
             
             throw new Exception("Property '".$key."' not found on '".get_class($this)."' class instance");
         }
     }

    
}



?>
