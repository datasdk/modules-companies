<?php

return [
    'name' => 'Companies',

    'model' => Modules\Companies\Models\Companies::class,

    'rules' => [
        "company" => [
           
            
        ]
            ],


    'admin' => [


        'navigationbar' => [


            "group" => "Company",

            "sorting" => 900,
            
            "link" => ["name" => "Companies", "icon" => "fas fa-building", "link" => "companies.index", "new_window" => false ],

            "submenu" => [

                [ "name" => "Add company", "icon"=> "fas fa-video", "link" => "companies.create" ],

                [ "name" => "Company applications", "icon"=> "fas fa-video", "link" => "teams.applications.index" ],
                
            ],
             
        ],

     

    ]
];
