@extends('frontend.layouts.app')

@section('content')
<h1>{{ trans("forms.title")}}</h1>
<h3>{{ trans("forms.instruction")}}</h2>
<form action="{{route('shapes.render')}}" class="form-horizontal render-form" role="form" method="post">
    <div class="row">
        <div class="col-md-8">
            <label for="data">{{trans('forms.fields.json_data')}}</label>
            <textarea id="data" name="data" class="form-control">
            {"shapes": [
            {"type": "polygon","x":200,"y":200,"size": 50,"sides":6,"fill":{"type":"solid","color":"blue"},"border":{"color": "yellow","width": 2}},
            {"type": "polygon","x":250,"y":80,"size": 80,"sides":4,"fill":{"type":"solid","color":"red"},"border":{"color": "gray","width": 3}},
            {"type": "polygon","x":350,"y":150,"size": 80,"sides":5,"fill":{"type":"solid","color":"black"},"border":{"color": "navy","width": 3}},
            {"type": "polygon","x":300,"y":300,"size": 80,"sides":3,"fill":{"type":"solid","color":"green"},"border":{"color": "fuchsia","width": 3}},
            {"type": "circle","x":0,"y":0,"perimeter": 300,"fill":{"type":"solid","color":"green"},"border":{"color": "red","width": 2}},
            {"type": "square","x":550,"y":90,"sideLength": 150,"fill":{"type":"solid","color":"blue"},"border": {"color": "#776cff","width": 2}},
            {"type": "rectangle","x":30,"y":250,"width": 600,"height":100,"fill":{"type":"solid","color":"red"},"border": {"color": "#ff6cff","width": 3}}]}
            </textarea>
        </div>
    </div>
     <div class="row">
        <div class="col-md-8 ">
                <label for="format">{{trans('forms.fields.output_format')}}</label>
                <input type="radio" class="" name="format" value="array"/>
                <span>{{trans('forms.fields.output_array')}}</span>
                <input type="radio" class="" name="format" value="binary" checked="checked"/>
                <span>{{trans('forms.fields.output_binary')}}</span>
                
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 ">
                <label for="rendering_side">{{trans('forms.fields.rendering')}}</label>
                <ul><li>
                <input type="radio" class="" name="rendering_side" value="server"/>
                <span>{{trans('forms.fields.rendering_server')}}</span>
                </li><li>
                <input type="radio" class="" name="rendering_side" value="client" />
                <span>{{trans('forms.fields.rendering_client')}}</span>
                </li><li>
                <input type="radio" class="" name="rendering_side" value="client_oop" checked="checked"/>
                <span>{{trans('forms.fields.rendering_client_oop')}}</span>
                </li><li>
                <input type="radio" class="" name="rendering_side" value="client_oop_svg" checked="checked"/>
                <span>{{trans('forms.fields.rendering_client_oop_svg')}}</span>
                </ul
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <input type="submit" class="btn btn-success btn-xs" value="{{trans('forms.general.crud.create')}}"/>
        </div>
    </div>
</form>


@endsection

