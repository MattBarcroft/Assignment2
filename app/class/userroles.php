<?php
class userroles{
    public $user_role_id;
    public $user_id;
    public $role_id;

    //getter and setter for user role id
    function get_user_role_id(){
        return $this->user_role_id;
    }
    function set_user_role_id($user_role_id){
        return $this->user_role_id = $user_role_id;
    }

    //getter and setter for user_id
    function get_user_id(){
        return $this->user_id;
    }
    function set_user_id($user_id){
        return $this->user_id = $user_id;
    }

    //getter and setter for role id
    function get_role_id(){
        return $this->role_id;
    }
    function set_role_id($role_id){
        return $this->role_id = $role_id;
    }
}

?>