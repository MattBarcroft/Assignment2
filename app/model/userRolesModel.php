<?php 
class userRolesModel {
    function insert_users_role($userid){
        $pdo = get_db();

        $r = $pdo->prepare("
            INSERT INTO User_Roles ( user_id , role_id ) VALUES (:user_id, '2')
            ");
        try{
            $r->execute(array(
                ':user_id' => $userid)
            );
            echo "insert executed";
        } catch (PDOException $e) {
            $r = 'Connection failed: ' . $e->getMessage();
            error_log("insert user role failed", 0);
            var_dump( $e->getMessage());
            return false;
        }
        
        $r = $pdo->lastInsertId();
        return $r;

    }
    public function is_admin($userid){
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT * FROM myKanban.User_Roles WHERE user_id = :user_id and role_id = 1
            ");
        try{
            $r->execute(array(
                ':user_id' => $userid)
            );
        } catch (PDOException $e) {
            $r = 'Connection failed: ' . $e->getMessage();
            error_log("is admin function failed", 0);
            var_dump( $e->getMessage());
            return false;
        }
        $count = $r->rowCount();
        return $count;
    }
    public function select_user_roles($userid){
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT user_roles.user_id, roles.role_name FROM myKanban.User_Roles 
            JOIN Roles
            ON roles.role_id = user_roles.role_id
            WHERE user_id = :user_id
        ");
        try{
            $r->execute(array(
                ':user_id' => $userid)
            );
            $r = $r->fetchAll();
        } catch (PDOException $e) {
            $r = 'Connection failed: ' . $e->getMessage();
            error_log("select user role failed", 0);
            var_dump( $e->getMessage());
            return false;
        }
        return $r;
    }
    function make_admin($userid){
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
            error_log("make admin failed", 0);
            var_dump( $e->getMessage());
            return false;
        }
            
        $r = $pdo->lastInsertId();
        return $r;

    }
    function remove_admin($userid){
        $pdo = get_db();

        $r = $pdo->prepare("
            DELETE FROM User_Roles WHERE user_id = :user_id AND role_id = 1
            ");
        try{
            $r->execute(array(
                ':user_id' => $userid)
            );
            echo "delete executed";
        } catch (PDOException $e) {
            error_log("remove admin failed", 0);
            $r = 'Connection failed: ' . $e->getMessage();
            var_dump( $e->getMessage());
            return false;
        }
        return $r;

    }
}