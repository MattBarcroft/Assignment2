<?php 
class POST
{
    function  __construct($entity1 = null, $id){
        //header("Content-Type: application/json");
        if($entity1 == "board" || $entity1 == "boards") {
            $this->board();
        } else if($entity1 == "state" || $entity1 == "states") {
            $this->state();
        } else if($entity1 == "card" || $entity1 == "cards") {
            $this->card();
        } else {
            echo "Error - Poor Request";
        }

    }
    function board(){
        //https://stackoverflow.com/questions/26664947/codeception-post-raw-json-string
        if(isset($_POST["board_name"])) {
            //insert single board
            $board_name = $_POST["board_name"];
            isset($_POST["hex_color"]) ? $hex_color = $_POST["hex_color"] : $hex_color = "grey";
            isset($_POST["public"]) ? $public = $_POST["public"] : $public = 0;
            $boards = new boards();
            $boards->set_board_name($board_name);
            $boards->set_hex_color($hex_color);
            $boards->set_public($public);

            $boardsModel = new boardsModel();
            $id = $boardsModel->insert_new_board($boards);
            echo "boardid $id inserted";
            
        } else {
            //insert board - state - card using JSON Array - use /jsonAPITest.json for example
            $rawdata = file_get_contents('php://input'); 
            $array = json_decode($rawdata, true);
            $boards = new boards();
            $membership = new membership();

            $boardsModel = new boardsModel();
            $membershipModel = new membershipModel();
            foreach($array as $board){
                $boards->set_board_name($board["board_name"]);
                $boards->set_hex_color($board["hex_color"]);
                $boards->set_public($board["public"]);
                $id = $boardsModel->insert_new_board($boards);
                echo "inserted board $id";

                $membership->set_membership_id($id);
                $membership->set_user_id($board["user_id"]);

                $userid = $membershipModel->insert_membership($id, $board["user_id"]);
                echo "inserted membership for user " . $board["user_id"];
                
                
                foreach($board["states"] as $states){
                    $state_name = $states["state_name"];
                    $board_id = $id;
                    $position = $states["state_name"];
                    $state_id = $boardsModel->insert_new_state($state_name, $board_id, $position);
                    echo "inserted state $state_id";

                    foreach($states["cards"] as $cards){
                        $card_name = $cards["card_name"];
                        $card_id = $boardsModel->insert_new_card($state_id, $card_name);
                        echo "inserted state $card_id";
                    }
                }
            }




        }
    }
    function state(){
        isset($_POST["board_id"]) ? $board_id =  $_POST["board_id"] :  $board_id = null;
        isset($_POST["position"]) ? $position =  $_POST["position"] :  $position = null;
        isset($_POST["state_name"]) ? $state_name = $_POST["state_name"] :  $state_name = null;

        if ($board_id == null || $state_name == null){
            echo "fail board id or state name not supplied";
        }
        else{
            $boardsModel = new boardsModel();
            $r = $boardsModel->insert_new_state($state_name, $board_id, $position);
            echo "state inserted at line $r";
        }
    }
    function card(){
        isset($_POST["state_id"]) ? $state_id =  $_POST["state_id"] :  $state_id = null;
        isset($_POST["card_name"]) ? $card_name = $_POST["card_name"] :  $card_name = null;

        if ($state_id == null || $card_name == null){
            echo "fail cardname or stateid not supplied";
        }
        else{
            $boardsModel = new boardsModel();
            $r = $boardsModel->insert_new_card($state_id, $card_name);
            echo "card inserted at line $r";
        }
    }

}