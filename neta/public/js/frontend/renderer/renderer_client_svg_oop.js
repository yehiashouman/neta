    function Stage(canvas_id,w,h,background)
    {
        this.width = w? w : 900;
        this.height = h? h: 400;
        this.background = background? background : "#ffffff";
        this.shapes = [];
        this.svg = document.getElementById(canvas_id);
        this.svgNS = "http://www.w3.org/2000/svg";
        this.svg.setAttribute("width",this.width+"px");
        this.svg.setAttribute("height",this.height+"px");
        this.svg.style.height = this.height;

    }
    Stage.prototype.clear = function(){
        this.shapes = [];
    }
    Stage.prototype.parse=function(data){
        for(var shape_data_key in data.shapes)
        {
            var shape = new Shape(this.svg);
            shape.parse(data.shapes[shape_data_key]);
            this.shapes.push(shape);
        }
    }
    Stage.prototype.render=function()
    {
        while (this.svg.lastChild) {
            this.svg.removeChild(this.svg.lastChild);
        }
        this.svg.style.backgroundColor = this.background;
        for(var shapeKey in this.shapes)
        {
            this.shapes[shapeKey].render(this.svg);
        }        
        
    }
    
    function Shape(svg){
        this.svg = svg;
        this.attributes = [];
        this.svgNS = "http://www.w3.org/2000/svg";
    }
    Shape.prototype.parse= function(data)
    {
        this.attributes=data;
    }
    Shape.prototype.render= function(canvas){
        if(!this.svg){
            throw Error("SVG Element Not Found");
        }
        var type = this.attributes.type;
        this.border_color = this.attributes.border.color?this.attributes.border.color : "";
        this.border_width = this.attributes.border.width? this.attributes.border.width: "1";
        this.fill_color = this.attributes.fill.color?this.attributes.fill.color : "";
        this.fill_type = this.attributes.fill.type? this.attributes.fill.type: "solid";
        this.renderShape();
        
    }
    Shape.prototype.renderShape=function(){
        switch(this.attributes.type)
        {
            case "square":
                var shape = document.createElementNS(this.svgNS,"rect");
                shape.setAttributeNS(null,"x"    , this.attributes.x);
                shape.setAttributeNS(null,"y"    , this.attributes.y);
                shape.setAttributeNS(null,"width"    , this.attributes.sideLength);
                shape.setAttributeNS(null,"height"    , this.attributes.sideLength);
                shape.setAttributeNS(null,"fill"  , this.fill_color);
                shape.setAttributeNS(null,"stroke", this.border_color);
                shape.setAttributeNS(null,"stroke", this.border_color);
                this.svg.appendChild(shape);
            break;
            case "circle":
                var sA = 0;
                var eA = 2 * Math.PI;
                var cC = false;
                //find radius (P = 2 PI R)
                var r = this.attributes.perimeter / (2 * Math.PI);
                var shape = document.createElementNS(this.svgNS,"circle");
                shape.setAttributeNS(null,"cx"    , this.attributes.x+r);
                shape.setAttributeNS(null,"cy"    , this.attributes.y+r);
                shape.setAttributeNS(null,"r"     , r);
                shape.setAttributeNS(null,"fill"  , this.fill_color);
                shape.setAttributeNS(null,"stroke", this.border_color);
                shape.setAttributeNS(null,"stroke-width", this.border_width);
                this.svg.appendChild(shape);
            break;
            case "rectangle":
                var width = this.attributes.width;
                var height = this.attributes.height;
                var shape = document.createElementNS(this.svgNS,"rect");
                shape.setAttributeNS(null,"x"    , this.attributes.x);
                shape.setAttributeNS(null,"y"    , this.attributes.y);
                shape.setAttributeNS(null,"width"    , this.attributes.width);
                shape.setAttributeNS(null,"height"    , this.attributes.height);
                shape.setAttributeNS(null,"fill"  , this.fill_color);
                shape.setAttributeNS(null,"stroke", this.border_color);
                shape.setAttributeNS(null,"stroke-width", this.border_width);
                this.svg.appendChild(shape);
                //this.ctx.rect(this.attributes.x, this.attributes.y, width, height);
            break;
            case "polygon":
                var sides = this.attributes.sides;
                var size = this.attributes.size;
                var points = "";
                points += (this.attributes.x +  this.attributes.size * Math.cos(0))+","+(this.attributes.y +  this.attributes.size *  Math.sin(0))+" ";   
                for (var i = 1; i <= this.attributes.sides;i += 1) {
                  points += (this.attributes.x + this.attributes.size * Math.cos(i * 2 * Math.PI / this.attributes.sides)) +","+(this.attributes.y + this.attributes.size * Math.sin(i * 2 * Math.PI / this.attributes.sides))+" ";   
                }
                var shape = document.createElementNS(this.svgNS,"polygon");
                shape.setAttributeNS(null,"x"    , this.attributes.x);
                shape.setAttributeNS(null,"y"    , this.attributes.y);
                shape.setAttributeNS(null,"points"    , points);
                shape.setAttributeNS(null,"fill"  , this.fill_color);
                shape.setAttributeNS(null,"stroke", this.border_color);
                shape.setAttributeNS(null,"stroke-width", this.border_width);
                this.svg.appendChild(shape);
                //<polygon points="200,10 250,190 160,210" style="fill:lime;stroke:purple;stroke-width:1" />
                
            break;
            
       }
       //this.ctx.stroke();
        
    }
    document.addEventListener("DOMContentLoaded", function(event) { 
      var stage= new Stage("canvas",stage_props.width,stage_props.height,stage_props.background);
      stage.parse(data);
      stage.render();
    });
    /*(function(){
        
    })();
    */