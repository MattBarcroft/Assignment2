<?php 
function router($controller, $action, $id){
    $urlString = "";

    if($controller === "" || $controller === null){
        $controller = 'home';
        $controller = apendController($controller);
        $action = 'index';
    } 
    else if($controller == "api"){
        //header('Location: '.$_SERVER['DOCUMENT_ROOT'].'/app/api/index.php');
        include $_SERVER['DOCUMENT_ROOT'].'/app/api/apirouter.php';
        return;
    }
    else if($action === null || $action === ""){
        $controller = apendController($controller);
        $action = 'index';
        if(!file_exists($_SERVER['DOCUMENT_ROOT']."/app/Controller/".$controller.".php")){
            $controller = "error";
            $controller = apendController($controller);
        }
    }
    else{
        $controller = apendController($controller);
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/app/Controller/".$controller.".php")){
            if(!method_exists($controller,$action)){
                $controller = "error";
                $controller = apendController($controller);
                $action = "index";
            }
        }
        else{
            $controller = "error";
            $controller = apendController($controller);
            $action = "index";
        }
    }
    $controller = new $controller();
    if(isset($id)){
        $controller->$action($id);
    } else {
        $controller->$action();
    }
}
function apendController($controller){
    return $controller."Controller";
     
}
function render($folder, $view, $data = null){
    include $_SERVER['DOCUMENT_ROOT'] .'/app/viewComponents/'.$folder.'/'.$view.'.php';
}

$baseUrl = $_SERVER['REQUEST_URI'];
$path = parse_url($baseUrl, PHP_URL_PATH);
$segments = explode('/', $path);

isset($segments[1]) ? $controller = $segments[1] : $controller = null;
  
isset($segments[2]) ? $action = $segments[2] : $action = null;

isset($segments[3]) ? $id = $segments[3] : $id = null;

router($controller, $action, $id);

?>