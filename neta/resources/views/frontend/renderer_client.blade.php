@extends('frontend.layouts.app')
<h3>Rendered Client Side (HTML5 Canvas/Pure Javascript functions)</h3>
@section('content')
    <canvas id="canvas" name="canvas"></canvas>
@endsection
@section('after-scripts')
<script type="text/javascript">
    var canvas,ctx;
    var data= JSON.parse('{!!$data!!}');
    function setup()
    {
        canvas = document.getElementById("canvas");
        ctx = canvas.getContext("2d");
        ctx.canvas.width  = 900;
        ctx.canvas.height = 400;
        ctx.fillStyle = "#ffffff";
        ctx.fillRect(0, 0, ctx.canvas.width, ctx.canvas.height);
        ctx.moveTo(0, 0);
    }
    function render(){
        for(var i=0;i<data.shapes.length;i++)
        {
            renderShape(ctx,data.shapes[i]);
        }
    }
    function renderShape(ctx,shapeObj){
        var type = shapeObj.type;
        var border = shapeObj.border;
        var x = shapeObj.x;
        var y = shapeObj.y;
        ctx.beginPath();
        ctx.lineWidth = border.width;
        ctx.strokeStyle = border.color;
        switch(shapeObj.type)
        {
            case "square":
                var sideLength = shapeObj.sideLength;
                ctx.rect(x, y, sideLength, sideLength);
            break;
            case "circle":
                var sA = 0;
                var eA = 2 * Math.PI;
                var cC = false;
                //find radius (P = 2 PI R)
                r = shapeObj.perimeter / (2 * Math.PI);
                ctx.arc(x, y, r, sA, eA,cC);
            break;
            case "rectangle":
                var width = shapeObj.width;
                var height = shapeObj.height;
                ctx.rect(x, y, width, height);
            break;
       }
       ctx.stroke();
        
    }
    document.addEventListener("DOMContentLoaded", function(event) { 
      setup();
      render();
    });
    /*
    // or using jQuery ready function
    (function(){
      setup();
      render();
        
    })();
    */
</script>
@endsection 

