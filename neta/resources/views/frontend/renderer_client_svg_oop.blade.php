@extends('frontend.layouts.app')
<h3>{{trans('forms.fields.rendering_client_oop_svg')}}</h3>
@section('content')
    <svg id="canvas" name="canvas"></svg>
@endsection
@section('after-scripts')
    <script type="text/javascript">
        var stage_props = JSON.parse('{!!$stage_props!!}');
        var data= JSON.parse('{!!$data!!}');
    </script>
    <script src="/js/frontend/renderer/renderer_client_svg_oop.js" type="text/javascript"></script>
@endsection 

