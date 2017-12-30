<?php 
class membershipController{
    public function insert_membership(){
        $user_id = $_POST["user_id"];
        $board_id = $_POST["board_id"];
        $membershipModel = new membershipModel();
        $r = $membershipModel->insert_membership($user_id, $board_id);

        return $r;
    }
    public function users_with_access_to_board(){
        $board_id = $_GET["board_id"];
        $membershipModel = new membershipModel();
        $r = $membershipModel->users_with_access_to_board($board_id);
        $usernames = array();
        foreach($r as $un){
            $usernames[$un["user_id"]] = $un["username"];
        }
        $usernames = json_encode($usernames);
        print_r($usernames);
        return $usernames;
    }
    public function remove_membership(){
        $board_id = $_POST["board_id"];
        $user_id = $_POST["user_id"];
        $membershipModel = new membershipModel();
        $r = $membershipModel->remove_membership($user_id, $board_id);
        return $r;
    }
}

?>
