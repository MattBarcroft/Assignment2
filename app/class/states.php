<?php
class states{
    public $state_id;
    public $state_name;
    public $state_created;
    public $state_last_modified;
    public $board_id;
    public $deleted;
    public $position;

    //getter and setter for board id
    function get_state_id(){
        return $this->state_id;
    }
    function set_state_id($state_id){
        return $this->state_id = $state_id;
    }

    //getter and setter for state_id
    function get_state_name(){
        return $this->state_name;
    }
    function set_state_name($state_name){
        return $this->state_name = $state_name;
    }

    //getter and setter for state_id
    function get_state_created(){
        return $this->state_created;
    }
    function set_state_created($state_created){
        return $this->state_created = $state_created;
    }

    //getter and setter for board last mod
   function get_state_last_modified(){
        return $this->state_last_modified;
    }
    function set_state_last_modified($state_last_modified){
           return $this->state_last_modified = $state_last_modified;
    }

    //getter and setter for board_id
    function get_board_id(){
        return $this->board_id;
    }
    function set_board_id($board_id){
        return $this->board_id = $board_id;
    }

    //getter and setter for position
    function get_position(){
        return $this->position;
    }
    function set_position($position){
        return $this->position = $position;
    }
}

?>