<?php 
class membershipModel
{
    public function insert_membership($userid, $boardid)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            INSERT INTO `Membership` (`user_id`, `board_id`) VALUES (:user_id, :board_id);
        ");

        $r->execute(array(
            ':user_id' => $userid, 
            ':board_id' => $boardid
        ));
        $r = $pdo->lastInsertId();
        return $r;

    }
    function users_with_access_to_board($boardid){
        
        $pdo = get_db();
        
        $r = $pdo->prepare("    
            SELECT users.user_id , Users.username
            FROM myKanban.Membership 
            JOIN myKanban.Users
            ON  Users.user_id = Membership.user_id
            where Membership.board_id = :board_id
        ");
    
        $r->execute(array(
            ':board_id' => $boardid
        ));
    
        $r = $r->fetchAll();
        return $r;
        
    }
    function remove_membership($user_id, $board_id){
        
        $pdo = get_db();
        $r = $pdo->prepare("    
            DELETE FROM `myKanban`.`Membership` 
            WHERE `user_id`=:user_id
            AND `board_id`=:board_id;
        ");
    
        $r->execute(array(
            ':user_id' => $user_id,
            ':board_id' => $board_id
        ));
    
        return $r;
        
    }
}
?>