<?php 
class GET
{
    function  __construct($entity1 = null, $id = null, $entity2 = null){

        header("Content-Type: application/json");
        if($entity1 == "board" || $entity1 == "boards") {
            $this->board($entity1, $id, $entity2);
        } else if($entity1 == "state" || $entity1 == "states") {
            $this->state($entity1, $id);
        } else if($entity1 == "card" || $entity1 == "cards") {
            $this->card($entity1, $id);
        } else if($entity1 == "user" || $entity1 == "users") {
        
        }
        else{
            echo "error";
        }
    }
    function board($entity1, $id, $entity2){
        $boardsModel = new boardsModel();
        $r = null;
        if($id !== null){
            
            if($entity2 !== null){
                //select boardid X's cards or states
                if($entity2 == 'card' || $entity2 == 'cards'){
                    $r = $boardsModel->select_cards_for_board($id);
                } else if ($entity2 == 'state' || $entity2 == 'states'){
                    $r = $boardsModel->select_states_for_board($id);
                }
                else{
                    echo "URI Not Supported ";
                    return;
                }
            }
            else{
                // select board with id
                $r = $boardsModel->select_board($id);
            }
        } else {
            $r = $boardsModel->select_all_boards();
        }
        $r = json_encode($r);
        echo($r);
    }

    function state($entity1, $id){
        $boardsModel = new boardsModel();
        $r = null;
        if($id !== null){
            $boardsModel->select_all_states();
        } else {
            $r = $boardsModel->select_single_state($id);
        }
        $r = json_encode($r);
        echo($r);
    }
    
}
?>