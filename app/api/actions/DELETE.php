<?php 
class DELETE
{
    function  __construct($entity1 = null, $id = null){
        
        header("Content-Type: application/json");
        if($entity1 == "board" || $entity1 == "boards") {
            $this->board($entity1, $id);
        } else if($entity1 == "state" || $entity1 == "states") {
            $this->state($entity1, $id);
        } else if($entity1 == "card" || $entity1 == "cards") {
            $this->card($entity1, $id);
        } else {
            echo "Error - Poor Request";
        }
    }
    function board($entity1, $id){
        $boardsModel = new BoardsModel();
        $r = $boardsModel->mark_board_deleted($id);
        var_dump($r);
        if($r > 0){
            echo json_encode("Board " . $id . " Deleted Successfully");
        } else {
            echo json_encode("Board Not Deleted Successfully");
        }
    }
    function state($entity1, $id){
        $boardsModel = new BoardsModel();
        $r = $boardsModel->remove_state($id);
        var_dump($r);
        if($r > 0){
            echo json_encode("State " . $id . " Deleted Successfully");
        } else {
            echo json_encode("State Not Deleted Successfully");
        }
    }
    function card($entity1, $id){
        $boardsModel = new BoardsModel();
        $r = $boardsModel->mark_card_deleted($id);
        var_dump($r);
        if($r > 0){
            echo json_encode("Card " . $id . " Deleted Successfully");
        } else {
            echo json_encode("Card Not Deleted Successfully");
        }
    }


}



?>