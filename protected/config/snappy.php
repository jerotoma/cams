<?php

return array(


    'pdf' => array(
        'enabled' => true,
        //'binary'  => "/usr/local/wkhtmlto/bin/wkhtmltopdf", //For linux remove comments nd add coments to bellow line
        'binary'  => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        //'binary'  => "\"C:/Program Files/wkhtmltopdf/bin/wkhtmltopdf.exe\"", //For windows remove comments
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64'),
        //'binary'  => "/usr/local/wkhtmlto/bin/wkhtmltoimage", //For linux remove comments nd add coments to bellow line
        //'binary'  => "\"C:/Program Files/wkhtmltopdf/bin/wkhtmltoimage.exe\"", //For windows remove comments
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
