<?php 
class userRolesModel {
    function insert_users_role($userid){
        $pdo = get_db();

        $r = $pdo->prepare("
            INSERT INTO User_Roles ( user_id , role_id ) VALUES (:user_id, '1')
            ");
        try{
            $r->execute(array(
                ':user_id' => $userid)
            );
            echo "insert executed";
        } catch (PDOException $e) {
            $r = 'Connection failed: ' . $e->getMessage();
            var_dump( $e->getMessage());
            return false;
        }
            
        $r = $pdo->lastInsertId();
        return $r;

    }
}