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
    /**
     * Polygon Class constructor.
     *
     * @param $canvas 
     *
     */
    public function __construct($canvas=null){
        parent::__construct();
        
    }
    /**
     * Renders Polygon
     *
     */ 
    protected function renderShapes()
    {
        $points = [];
        for($a = 0;$a <= 360; $a += 360/$this->sides)
        {
            $points[] = $this->x + ($this->size) * cos(deg2rad($a));
            $points[] = $this->y + ($this->size) * sin(deg2rad($a));
        }
        if($this->fill_type=="solid" ){
            imagefilledpolygon($this->canvas,$points,$this->sides,$this->fill_color);
        }
        imagepolygon($this->canvas,$points,$this->sides,$this->border_color);
    }

}
?>