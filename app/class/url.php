<?php
class url{
    public $controller;
    public $action;

    //getter and setter for role id
    function get_controller(){
        return $this->controller;
    }
    function set_controller($controller){
        return $this->controller = $controller;
    }

    //getter and setter for name
    function get_action(){
        return $this->action;
    }
    function set_action($action){
        return $this->action = $action;
    }
}

?>