<?php

spl_autoload_register(function ($class_name) {

    $classs = explode('\\', $class_name);
    
    if (current($classs) != 'NewTik'){
        return;
    }
    array_shift($classs);
    
    if (current($classs) != 'API'){
        return;
    }
    array_shift($classs);
    
    if (current($classs) != 'NovaPay'){
        return;
    }    
    array_shift($classs);
    
    include_once __dir__. '/' . (implode('/', $classs)) . '.php';
});
