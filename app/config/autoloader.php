<?php

spl_autoload_register(function ($class) {
    if (file_exists($_SERVER['DOCUMENT_ROOT']."/app/class/"."$class.php")) {
        require $_SERVER['DOCUMENT_ROOT']."/app/class/"."$class.php";
    } else if (file_exists($_SERVER['DOCUMENT_ROOT']."/app/controller/".$class.".php")) {
        require $_SERVER['DOCUMENT_ROOT']."/app/controller/".$class.".php";
    } else if (file_exists($_SERVER['DOCUMENT_ROOT']."/app/model/"."$class.php")){
        require $_SERVER['DOCUMENT_ROOT']."/app/model/"."$class.php";
    } else {
        $controller = "errorController";
        $controller = new $controller();
        $controller->index();
    }
});
?>