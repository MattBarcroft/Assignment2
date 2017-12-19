<?php 
class membershipModel
{

    public function insert_membership($membership)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            INSERT INTO `Membership` (`user_id`, `board_id`) VALUES (:user_id, :board_id);
        ");

        $r->execute(array(
            ':user_id' => $membership->get_user_id(), 
            ':board_id' => $membership->get_board_id()
        ));

        return $r;
    }
}
?>