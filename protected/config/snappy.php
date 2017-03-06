<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => "/usr/local/wkhtmlto/bin/wkhtmltopdf",
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => "/usr/local/wkhtmlto/bin/wkhtmltoimage",
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
