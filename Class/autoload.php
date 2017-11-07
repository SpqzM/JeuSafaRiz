<?php

//Chargement de toutes les classes

function autoload($classname) {
    if (file_exists($file = __DIR__ . '/' . $classname . '.php')) {
        require $file;
    }
    
        elseif (file_exists($file = __DIR__ . '/' . strtolower($classname) . '.php')) {
            require $file;
    }
    
    
}

spl_autoload_register('autoload');
