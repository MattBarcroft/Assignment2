<?php
class useractions{
    public $user_action_id;
    public $user_id;
    public $action_timestamp;
    public $action;
    public $board_id;

    //getter and setter for membership id
    function get_user_action_id(){
        return $this->user_action_id;
    }
    function set_user_action_id($user_action_id){
        return $this->user_action_id = $user_action_id;
    }

    //getter and setter for user_id
    function get_user_id(){
        return $this->user_id;
    }
    function set_user_id($user_id){
        return $this->user_id = $user_id;
    }

    //getter and setter for state_id
    function get_action_timestamp(){
        return $this->action_timestamp;
    }
    function set_action_timestamp($action_timestamp){
        return $this->action_timestamp = $action_timestamp;
    }

    //getter and setter for state_id
    function get_action(){
        return $this->action;
    }
    function set_action($action){
        return $this->action = $action;
    }

    //getter and setter for state_id
    function get_board_id(){
        return $this->board_id;
    }
    function set_board_id($board_id){
        return $this->board_id = $board_id;
    }
    
}

?>