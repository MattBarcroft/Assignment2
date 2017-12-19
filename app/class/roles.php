<?php
class roles{
    public $role_id;
    public $name;

    //getter and setter for role id
    function get_role_id(){
        return $this->role_id;
    }
    function set_role_id($role_id){
        return $this->role_id = $role_id;
    }

    //getter and setter for name
    function get_name(){
        return $this->name;
    }
    function set_name($name){
        return $this->name = $name;
    }
}

?>