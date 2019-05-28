@extends('frontend.layouts.app')
<h3>Rendered Client Side (HTML5 Canvas/Pure Javascript with prototype inheritence)</h3>
@section('content')
    <canvas id="canvas" name="canvas"></canvas>
@endsection
@section('after-scripts')
<script type="text/javascript">
    function Stage(canvas_id,w,h)
    {
        this.width = w;
        this.height = h;
        this.background = "#ffffff";
        this.shapes = [];
        this.canvas = document.getElementById(canvas_id);
        this.ctx = this.canvas.getContext("2d");
        this.ctx.canvas.width  = this.width;
        this.ctx.canvas.height = this.height;
        this.ctx.moveTo(0, 0);
        
    }
    Stage.prototype.clear = function(){
        this.shapes = [];
    }
    Stage.prototype.parse=function(data){
        for(var shape_data_key in data.shapes)
        {
            var shape = new Shape(this.canvas);
            shape.parse(data.shapes[shape_data_key]);
            this.shapes.push(shape);
        }
    }
    Stage.prototype.render=function()
    {
        this.ctx.fillStyle = this.background;
        this.ctx.fillRect(0, 0, this.width, this.height);
        for(var shapeKey in this.shapes)
        {
            this.shapes[shapeKey].render(this.canvas);
        }        
        
    }
    
    function Shape(canvas){
        this.attributes = [];
    }
    Shape.prototype.setCanvas=function(canvas){
        this.canvas = canvas;
        this.ctx = this.canvas.getContext("2d");
    }
    Shape.prototype.parse= function(data)
    {
        this.attributes=data;
    }
    Shape.prototype.render= function(canvas){
        this.setCanvas(canvas);
        if(!this.canvas){
            throw Error("CanvasNotFoundException");
        }
        var type = this.attributes.type;
        this.ctx.beginPath();
        this.ctx.lineWidth = this.attributes.border.width;
        this.ctx.strokeStyle = this.attributes.border.color;
        this.renderShape();
        
    }
    Shape.prototype.renderShape=function(){
        switch(this.attributes.type)
        {
            case "square":
                var sideLength = this.attributes.sideLength;
                this.ctx.rect(this.attributes.x, this.attributes.y, this.attributes.sideLength, this.attributes.sideLength);
            break;
            case "circle":
                var sA = 0;
                var eA = 2 * Math.PI;
                var cC = false;
                //find radius (P = 2 PI R)
                var r = this.attributes.perimeter / (2 * Math.PI);
                this.ctx.arc(this.attributes.x, this.attributes.y, r, sA, eA,cC);
            break;
            case "rectangle":
                var width = this.attributes.width;
                var height = this.attributes.height;
                this.ctx.rect(this.attributes.x, this.attributes.y, width, height);
            break;
       }
       this.ctx.stroke();
        
    }
    var data= JSON.parse('{!!$data!!}');
    document.addEventListener("DOMContentLoaded", function(event) { 
      var stage= new Stage("canvas",900,400);
      stage.parse(data);
      stage.render();
    });
    /*(function(){
        
    })();
    */
</script>
@endsection 

