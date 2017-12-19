<?php
class boards{
    public $board_id;
    public $board_name;
    public $hex_color;
    public $board_created;
    public $board_last_modified;
    public $deleted;
    public $public;

    //getter and setter for board id
    function get_board_id(){
        return $this->board_id;
    }
    function set_board_id(){
        return $this->board_id = $board_id;
    }
    //getter and setter for board id
    function get_board_name(){
        return $this->board_name;
    }
    function set_board_name($board_name){
        return $this->board_name = $board_name;
    }

    //getter and setter for board id
    function get_hex_color(){
        return $this->hex_color;
    }
    function set_hex_color($hex_color){
        return $this->hex_color = $hex_color;
    }

    //getter and setter for board_created
    function get_board_created(){
        return $this->board_created;
    }
    function set_board_created($board_created){
        return $this->board_created = $board_created;
    }

    //getter and setter for board last mod
   function get_board_last_modified(){
        return $this->board_last_modified;
    }
    function set_board_last_modified($board_last_modified){
           return $this->board_last_modified = $board_last_modified;
    }

    //getter and setter for deleted
    function get_deleted(){
        return $this->deleted;
    }
    function set_deleted($deleted){
        return $this->deleted = $deleted;
    }

    //getter and setter for public
    function get_public(){
        return $this->public;
    }
    function set_public($public){
        return $this->public = $public;
    }
}


?>