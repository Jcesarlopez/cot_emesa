<?php
    function loadLibraries($class)
    {
        $path = _DIR_."/lib";
        require_once $path.$class.".php";
    }


    spl_autoload_register("loadLibraries");




