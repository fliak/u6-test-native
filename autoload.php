<?php

spl_autoload_register(function ($class) {

    $prefix = 'App\\';

    //source code base directory
    $baseDir = BASE_PATH . '/app/src/App/';

    //check prefix match
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    //calculate file path
    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});