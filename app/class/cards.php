<?php
class cards{
    public $card_id;
    public $state_id;
    public $card_created;
    public $card_last_modified;
    public $deleted;

    //getter and setter for board id
    function get_card_id(){
        return $this->card_id;
    }
    function set_card_id($card_id){
        return $this->card_id = $card_id;
    }

    //getter and setter for state_id
    function get_state_id(){
        return $this->state_id;
    }
    function set_state_id($state_id){
        return $this->state_id = $state_id;
    }

    //getter and setter for state_id
    function get_card_created(){
        return $this->card_created;
    }
    function set_card_created($card_created){
        return $this->card_created = $card_created;
    }

    //getter and setter for board last mod
   function get_card_last_modified(){
        return $this->card_last_modified;
    }
    function set_card_last_modified($card_last_modified){
           return $this->card_last_modified = $card_last_modified;
    }

    //getter and setter for deleted
    function get_deleted(){
        return $this->deleted;
    }
    function set_deleted($deleted){
        return $this->deleted = $deleted;
    }
}

?>