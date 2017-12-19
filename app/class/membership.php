<?php
class membership{
    public $membership_id;
    public $user_id;
    public $board_id;

    //getter and setter for membership id
    function get_membership_id(){
        return $this->membership_id;
    }
    function set_membership_id($membership_id){
        return $this->membership_id = $membership_id;
    }

    //getter and setter for user_id
    function get_user_id(){
        return $this->user_id;
    }
    function set_user_id($user_id){
        return $this->user_id = $user_id;
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