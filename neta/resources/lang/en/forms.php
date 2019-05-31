<?php 
return [
        'title'=>'JSON Renderer',
        'instruction'=> 'Please enter Shapes JSON data:',
        'fields'=>[
            'json_data'=> 'JSON Data:',
            'output_format'=>'Output Format:',
            'output_array'=> 'Array',
            'output_binary'=>'Binary',
            'rendering' => 'Rendering:',
            'rendering_server' => 'Server Side (GD Library)',
            'rendering_client' => 'Client Side (HTML5 Canvas/Pure Javascript)',
            'rendering_client_oop' => 'Client Side (HTML5 Canvas/Pure JS + prototype inheritence)',
            'rendering_client_oop_svg' => 'Client Side (SVG/Pure JS + prototype inheritence)',
            
            ],
        'general'=>[
                'crud'=>[
                    'create'=> 'Render'
                    
                    
                    ]
            
            
            ],
        'validation'=>[
                    'ShapesJSONValid'=> 'The JSON field value must be a valid shapes JSON value.'
            ]
    
    ];

?>