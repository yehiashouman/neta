@extends('frontend.layouts.app')
<h3>{{trans('forms.fields.rendering_client')}}</h3>
@section('content')
    <canvas id="canvas" name="canvas"></canvas>
@endsection
@section('after-scripts')
    <script type="text/javascript">
        var stage_props = JSON.parse('{!!$stage_props!!}');
        var data= JSON.parse('{!!$data!!}');
    </script>
    <script src="/js/frontend/renderer/renderer_client.js" type="text/javascript"></script>
@endsection 

