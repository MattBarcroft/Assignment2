<?php 
class PUT
{
    function  __construct($entity1 = null, $id){
        //header("Content-Type: application/json");
        if($entity1 == "board" || $entity1 == "boards") {
            $this->board($id);
        } else if($entity1 == "state" || $entity1 == "states") {
            $this->state($id);
        } else if($entity1 == "card" || $entity1 == "cards") {
            $this->card($id);
        } else {
            echo "Error - Poor Request";
        }

    }
    function board($id){
        
        $board_id = $id;
        isset($_GET['hex_color']) ? $hex_color = $_GET['hex_color'] : $hex_color =null;
        isset($_GET['deleted']) ? $deleted = $_GET['deleted'] : $deleted = null;
        isset($_GET['public']) ? $public = $_GET['public'] : $public = null;
        isset($_GET['board_name']) ? $board_name = $_GET['board_name'] : $board_name = null;

        $boardsModel = new BoardsModel();
        $r = $boardsModel->update_board($board_id, $board_name, $hex_color, $deleted, $public);
        if($r > 0){
            echo "Successfully updated $r records";
        }else{
            echo "fail";
        }
    }
    function state($id){
        
        $state_id = $id;
        isset($_GET['state_name']) ? $state_name = $_GET['state_name'] : $state_name = null;
        isset($_GET['deleted']) ? $deleted = $_GET['deleted'] : $deleted = null;
        $boardsModel = new BoardsModel();
        $r = $boardsModel->update_state($state_id, $state_name, $deleted);
        if($r > 0){
            echo "Successfully updated $r records";
        }else{
            echo "fail";
        }
    }
    function card($id){
        
        $card_id = $id;
        isset($_GET['card_name']) ? $card_name = $_GET['card_name'] : $card_name = null;
        isset($_GET['deleted']) ? $deleted = $_GET['deleted'] : $deleted = null;
        $boardsModel = new BoardsModel();
        $r = $boardsModel->update_card($card_id, $card_name, $deleted);
        if($r > 0){
            echo "Successfully updated $r records";
        }else{
            echo "fail";
        }
    }

}