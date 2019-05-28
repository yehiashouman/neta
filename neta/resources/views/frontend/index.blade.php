@extends('frontend.layouts.app')

@section('content')
<h1>JSON Renderer</h1>
<h3>Please enter Shapes JSON data:</h2>
<form action="{{route('shapes.render')}}" class="form-horizontal" role="form" method="post">
    <div class="row">
        <div class="col-md-8">
            <label for="data">JSON Data:</label>
            <textarea id="data" name="data" class="form-control">
            {"shapes": [{"type": "circle","x":100,"y":100,"perimeter": 300,"border":{"color": "red","width": 1}},{"type": "square","x":10,"y":20,"sideLength": 150,"border": {"color": "#776cff","width": 2}},{"type": "rectangle","x":50,"y":50,"width": 200,"height":50,"border": {"color": "#ff6cff","width": 3}}]}
            </textarea>
        </div>
    </div>
     <div class="row">
        <div class="col-md-8 ">
                <label for="format">Output Format:</label>
                <input type="radio" class="" name="format" value="array"/>
                <span>Array</span>
                <input type="radio" class="" name="format" value="binary" checked="checked"/>
                <span>Binary</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 ">
                <label for="rendering_side">Rendering:</label>
                <input type="radio" class="" name="rendering_side" value="server"/>
                <span>Server Side (GD Library)</span>
                <input type="radio" class="" name="rendering_side" value="client" />
                <span>Client Side (HTML5 Canvas/Pure Javascript)</span>
                <input type="radio" class="" name="rendering_side" value="client_oop" checked="checked"/>
                <span>Client Side (HTML5 Canvas/Pure JS + prototype inheritence)</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <input type="submit" class="btn btn-success btn-xs" value="Render"/>
        </div>
    </div>
</form>


@endsection

