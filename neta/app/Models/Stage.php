<?php
namespace App\Models;
use App\Models\Shape;
use App\Models\Colorable;
class Stage {  
    
    use Colorable;
    protected $data;
    protected $canvas;
    protected $shapes;
    protected $width;
    protected $height;
    protected $backgroundColor;
    function __construct($w,$h,$canvas=null)
    {
        $this->backgroundColor = "#ffffff";
        $this->width = $w;
        $this->height = $h;
        $this->canvas = isset($canvas)? $canvas: imagecreatetruecolor($this->width, $this->height); 
        $this->clear();
    }
    public function clear(){
        $this->shapes = [];
    }
    public function parse($data)
    {
        $this->clear();
        foreach($data->shapes as $key=>$shape_data)
        {
            $shape = new Shape();
            $shape->parse($shape_data);
            array_push($this->shapes, $shape);
        }
    }
    public function render(){
        imagefilledrectangle($this->canvas, 0, 0, $this->width, $this->height, $this->hexToAllocatedColor($this->canvas,$this->backgroundColor));
        foreach($this->shapes as $shape)
        {
            $shape->render($this->canvas);
        }
    }
    public function export($format){
        switch($format){
            case "binary":
                $stream = fopen("php://memory", "w+");
                imagejpeg($this->canvas,$stream,100);
                rewind($stream);
                $contents = stream_get_contents($stream);
                $base64   = base64_encode($contents); 
                $mime = 'image/jpeg';
                imagedestroy($this->canvas);  
                return ('<img src="data:' . $mime . ';base64,' . $base64.'"/>');
                
            break;
            case "array":
                return json_encode($this->shapes);    
            break;
        
        }
        
    }
}

?>