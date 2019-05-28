<?php
namespace App\Models;

interface ShapeInterface{
    
    public function parse($data);
    public function render($canvas);
   
    
}

?>