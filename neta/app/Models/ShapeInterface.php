<?php
namespace App\Models;
/**
* Interface Shape
* 
* Shape Inerface keeps other future extensions of Shape class (sub classes) consistently implementing render and parse methods.  
* @package App\Models
*/
interface ShapeInterface{
    /*
    * Parses the shape data
    @param $data the shape data 
    */
    public function parse($data);
    /*
    * renders the parsed data
    @param $canvas where the rendering should take place, the canvas is a GD image.
    */
    public function render($canvas);
}
?>