<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Stage;
class ShapeController extends Controller
{
  public function index(Request $request){
      $data = [];
      $type = "text/html";
      return response(view('frontend.index', $data))->header('Content-Type', $type);
      
  }
  public function render(Request $request){
    $raw_data = $request->input("data");
	$data = json_decode($raw_data);
	$format = $request->input("format");
	$rendering_side = $request->input("rendering_side") ;
	$view_templates = [
            "server"=> "renderer_server",
            "client"=> "renderer_client",
            "client_oop"=> "renderer_client_js_oop",
            "client_oop_svg"=> "renderer_client_svg_oop"
    ];
    $view_template = 'frontend.'.$view_templates[$rendering_side];
    $stage_props = [
        "width"=> env("STAGE_WIDTH"),
        "height"=> env("STAGE_HEIGHT"),
        "background"=> "#".env("STAGE_BACKGROUND"),
        
    ];
    switch($format)
    {
        case "binary":
             	    if($rendering_side=="server"){
                        $stage = new Stage($stage_props);
                        $stage->parse($data);
                        $stage->render();
                        return response(view($view_template,["img"=> $stage->export($format)]));
                    } else{
                        return response(view($view_template,["data"=>json_encode($data),"stage_props"=>json_encode($stage_props)]));
                    }
            break;
        case "array":
             	    return response(json_encode($data))->header("Content-Type", "text/json");
            break;
     }
 }
}
