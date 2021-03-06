    /**
    * @class Stage 
    *
    * Stage class is used to represent the stage (canvas) where all the rendering takes place
    * @param {string} canvas_id - HTML element id of the canvas
    * @param {string} w configuration width of the canvas
    * @param {string} h configuration height of the canvas
    * @param {string} background configuration background color of the canvas
    *
    * @example
    *   new Stage("myCanvas",900,400,"#d2d2d2");
    */
    function Stage(canvas_id,w,h,background)
    {
        this.width = w? w : 900;
        this.height = h? h: 400;
        this.background = background? background : "#ffffff";
        this.shapes = [];
        this.canvas = document.getElementById(canvas_id);
        this.ctx = this.canvas.getContext("2d");
        this.ctx.canvas.width  = this.width;
        this.ctx.canvas.height = this.height;
        this.ctx.moveTo(0, 0);
        
    }
    /**
    * Clears the shapes array.
    *
    */
    Stage.prototype.clear = function(){
        this.shapes = [];
    }
    /**
    * Parses an array of shapes.
    *
    * @param {string} data - an array of shapes
    */
    Stage.prototype.parse=function(data){
        for(var shape_data_key in data.shapes)
        {
            var shape = new Shape(this.canvas);
            shape.parse(data.shapes[shape_data_key]);
            this.shapes.push(shape);
        }
    }
    /**
    * Renders an array of shapes.
    *
    */
    Stage.prototype.render=function()
    {
        this.ctx.fillStyle = this.background;
        this.ctx.fillRect(0, 0, this.width, this.height);
        for(var shapeKey in this.shapes)
        {
            this.shapes[shapeKey].render(this.canvas);
        }        
        
    }
    /**
    * @class Shape 
    *
    * Shape class is used to represent the individual shapes being rendered 
    * @param {string} canvas - HTML5 canvas where it will be drawn
    *
    * @example
    *   var shape = new Shape(myCanvas);
    */
    
    function Shape(canvas){
        this.attributes = [];
    }
    /**
    * Sets the canvas for the shape to draw itself.
    *
    */
    Shape.prototype.setCanvas=function(canvas){
        this.canvas = canvas;
        this.ctx = this.canvas.getContext("2d");
        this.fill_type = "solid";
        this.fill_color = "";
    }
    /**
    * Parses shape attributes.
    *
    * @param {string} data the shape draw to draw
    */
    Shape.prototype.parse= function(data)
    {
        this.attributes=data;
    }
    /**
    * Renders shape.
    *
    * @param {string} canvas - HTML5 canvas to render the shape on
    */
    Shape.prototype.render= function(canvas){
        this.setCanvas(canvas);
        if(!this.canvas){
            throw Error("CanvasNotFoundException");
        }
        var type = this.attributes.type;
        this.ctx.beginPath();
        this.ctx.lineWidth = this.attributes.border.width?this.attributes.border.width : 1;
        this.ctx.strokeStyle = this.attributes.border.color? this.attributes.border.color: "";
        this.fill_color = this.attributes.fill.color?this.attributes.fill.color : "";
        this.fill_type = this.attributes.fill.type? this.attributes.fill.type: "solid";
        this.renderShape();
        
    }
    /**
    * Generic shape rendering. Can be extended to have sub classes of shape (Circle, Rectangle ..etc)
    *
    */
    Shape.prototype.renderShape=function(){
        switch(this.attributes.type)
        {
            case "square":
                var sideLength = this.attributes.sideLength;
                this.ctx.rect(this.attributes.x, this.attributes.y, this.attributes.sideLength, this.attributes.sideLength);
                if(this.fill_type=="solid" && this.fill_color!=="")
                {
                    this.ctx.fillStyle= this.fill_color;
                    this.ctx.fill();
                }
            break;
            case "circle":
                var sA = 0;
                var eA = 2 * Math.PI;
                var cC = false;
                //find radius (P = 2 PI R)
                var r = this.attributes.perimeter / (2 * Math.PI);
                this.ctx.arc(this.attributes.x+(r), this.attributes.y+(r), r, sA, eA,cC);
                if(this.fill_type=="solid" && this.fill_color!=="")
                {
                    this.ctx.fillStyle= this.fill_color;
                    this.ctx.fill();
                }
            break;
            case "rectangle":
                var width = this.attributes.width;
                var height = this.attributes.height;
                this.ctx.rect(this.attributes.x, this.attributes.y, width, height);
                if(this.fill_type=="solid" && this.fill_color!=="")
                {
                    this.ctx.fillStyle= this.fill_color;
                    this.ctx.fill();
                }
            break;
            case "polygon":
                this.ctx.moveTo (this.attributes.x +  this.attributes.size * Math.cos(0), this.attributes.y +  this.attributes.size *  Math.sin(0));   
                for (var i = 1; i <= this.attributes.sides;i += 1) {
                  this.ctx.lineTo(this.attributes.x + this.attributes.size * Math.cos(i * 2 * Math.PI / this.attributes.sides), this.attributes.y + this.attributes.size * Math.sin(i * 2 * Math.PI / this.attributes.sides));
                }
                if(this.fill_type=="solid" && this.fill_color!=="")
                {
                    this.ctx.fillStyle= this.fill_color;
                    this.ctx.fill();
                }
            break;
            
       }
       this.ctx.stroke();
        
    }
    /**
    * Pure JS Equivalent of document.ready(), starts script when document is loaded.
    */
    document.addEventListener("DOMContentLoaded", function(event) { 
      var stage= new Stage("canvas",stage_props.width,stage_props.height,stage_props.background);
      stage.parse(data);
      stage.render();
    });
    /*(function(){
        
    })();
    */