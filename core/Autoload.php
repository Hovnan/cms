<?php
 
spl_autoload_register(function ($class)
{
    $array_paths = array(
        '/controllers/',
        '/core/',
        '/models/'
    );

    foreach ($array_paths as $path) 
    {
        $path = ROOT . $path . $class . '.php';
        
        if (is_file($path)) {
            require_once $path;
        }
    }

});