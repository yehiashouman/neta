<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Stage;
use Validator;
use App\Rules\ShapesJSONValid;
/**
 * Class ShapeController
 * @package App\Http\Controllers
 */
class ShapeController extends Controller
{
    /**
    * Renders the index page.
    * 
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
      return response(view('frontend.index'));
    }
    /**
    * Renders the json data payload with the chosen renderer.
    * 
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function render(Request $request){
        $raw_data = $request->input("data");
    	$data = json_decode($raw_data);
    	//simple validation for json data whether it is valid and has a shapes attribute.
    	$validator = Validator::make($request->all(), [
                'data' => new ShapesJSONValid(),    
        ]);
        //if it fails redirect back with errors and original invalid json data, 
        //the reason it is done this way is that Lumen does not support flash error messages or sessions
        if ($validator->fails()) {
            $_SESSION['errors'] = $validator->getMessageBag();
            $_SESSION['data']= $raw_data;
                return redirect()->route("shapes.index");
        }
       
        //whether binary or array format
    	$format = $request->input("format");
    	//how to render and where client side or server side
    	$rendering_side = $request->input("rendering_side") ;
        //simplifying used templates for rendering in an associative array for minimizing code.
    	$view_templates = [
                "server"=> "renderer_server",
                "client"=> "renderer_client",
                "client_oop"=> "renderer_client_js_oop",
                "client_oop_svg"=> "renderer_client_svg_oop"
        ];
        //pick proper template to render
        $view_template = 'frontend.'.$view_templates[$rendering_side];
        //configurable properties of stage 
        $stage_props = [
            "width"=> env("STAGE_WIDTH"),
            "height"=> env("STAGE_HEIGHT"),
            "background"=> "#".env("STAGE_BACKGROUND"),
            
        ];
        switch($format)
        {
            case "binary":
                        //if rendering is server-side then use data model Stage and Shape to render the given array.
                 	    if($rendering_side=="server"){
                 	        //instantiate the stage with the stage props from configuration
                            $stage = new Stage($stage_props);
                            $stage->parse($data);
                            $stage->render();
                            //use the server side rendering view which has nothing but the exported image
                            return response(view($view_template,["img"=> $stage->export($format)]));
                        } else{
                            //use the suitable rendering view for client side which points at the proper client script to load
                            return response(view($view_template,["data"=>json_encode($data),"stage_props"=>json_encode($stage_props)]));
                        }
                break;
            case "array":
                        //since in the requirements it is not defined how the array should look like, i decided to return it as it was given.
                 	    return response(json_encode($data))->header("Content-Type", "text/json");
                break;
        }
    }
}
