    //canvas and context where drawing takes place.
    var canvas,ctx;
    /**
    * setup function is where the stage is prepared.
    */
    function setup()
    {
        canvas = document.getElementById("canvas");
        ctx = canvas.getContext("2d");
        ctx.canvas.width  = stage_props.width;
        ctx.canvas.height = stage_props.height;
        ctx.fillStyle = stage_props.background;
        ctx.fillRect(0, 0, ctx.canvas.width, ctx.canvas.height);
        ctx.moveTo(0, 0);
    }
    /**
    * render function is where the shapes rendering takes place.
    *
    */
    function render(){
        for(var i=0;i<data.shapes.length;i++)
        {
            renderShape(ctx,data.shapes[i]);
        }
    }
    /**
    * setup function is where the stage is prepared.
    *
    * @param {string} ctx - Context of drawing
    * @param {string} shapeObj a single shape object to render
    */
    function renderShape(ctx,shapeObj){
        var type = shapeObj.type;
        var border = shapeObj.border;
        var fill = shapeObj.fill;
        var x = shapeObj.x;
        var y = shapeObj.y;
        ctx.beginPath();
        ctx.lineWidth = border.width;
        ctx.strokeStyle = border.color;
        var fill_color = fill.color? fill.color : "";
        var fill_type = fill.type? fill.type: "solid";
        
        switch(shapeObj.type)
        {
            case "square":
                var sideLength = shapeObj.sideLength;
                ctx.rect(x, y, sideLength, sideLength);
                if(fill_type=="solid" && fill_color!="")
                {
                    ctx.fillStyle= fill_color;
                    ctx.fill();
                }
            break;
            case "circle":
                var sA = 0;
                var eA = 2 * Math.PI;
                var cC = false;
                //find radius (P = 2 PI R)
                r = shapeObj.perimeter / (2 * Math.PI);
                ctx.arc(x+(r), y+(r), r, sA, eA,cC);
                if(fill_type=="solid" && fill_color!=="")
                {
                    ctx.fillStyle= fill_color;
                    ctx.fill();
                }
            break;
            case "rectangle":
                var width = shapeObj.width;
                var height = shapeObj.height;
                ctx.rect(x, y, width, height);
                if(fill_type=="solid" && fill_color!=="")
                {
                    ctx.fillStyle= fill_color;
                    ctx.fill();
                }
            break;
            case "polygon":
                ctx.moveTo (x +  shapeObj.size * Math.cos(0), y +  shapeObj.size *  Math.sin(0));   
                for (var i = 1; i <= shapeObj.sides;i += 1) {
                  ctx.lineTo(x + shapeObj.size * Math.cos(i * 2 * Math.PI / shapeObj.sides), y + shapeObj.size * Math.sin(i * 2 * Math.PI / shapeObj.sides));
                }
                if(fill_type=="solid" && fill_color!=="")
                {
                    ctx.fillStyle= fill_color;
                    ctx.fill();
                }
            break;
    
       }
       ctx.stroke();
        
    }
    /**
    * Pure JS Equivalent of document.ready(), starts script when document is loaded.
    */
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
