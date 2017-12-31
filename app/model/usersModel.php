<?php 
class usersModel {
    function insert_user($user){
        
        $pdo = get_db();

        $r = $pdo->prepare("
        INSERT INTO Users (username, name, password, email, deleted) 
        VALUES (:username, :name, :password, :email, '0');");

        $r->execute(array(
          ':username' => $user->get_username(), 
          ':name' => $user->get_name(), 
          ':password' => $user->get_password(),
          ':email' => $user->get_email()));
    
        $r = $pdo->lastInsertId();
        return $r;
        
    }
    function check_login_credentials($username, $password){
        
        $pdo = get_db();
        
        $r = $pdo->prepare("select * from Users
        where username = :username");
    
        $r->execute(array(':username' => $username));
    
        $r = $r->fetch(PDO::FETCH_OBJ);
    
        $users = new users();
        $users->set_username($username);
        $users->set_password($r->password);

        return $users->verify_password($password);
        
    }
    function user_details($id){
        
        $pdo = get_db();
        
        $r = $pdo->prepare("select * from Users
        where user_id = :user_id");
    
        $r->execute(array(':user_id' => $id));
    
        $r = $r->fetch();

        return $r;
        
    }
    function get_user_id($username){
        
        $pdo = get_db();
        
        $r = $pdo->prepare("select user_id from Users
        where username = :username" );
    
        $r->execute(array(':username' => $username));
    
        return $r->fetch(PDO::FETCH_OBJ);
        
    }
    function select_all_users(){
        
        $pdo = get_db();
        
        $r = $pdo->prepare("select user_id, username, accountcreated, deleted from Users");
    
        $r->execute();
    
        $r = $r->fetchAll();
        return $r;
        
    }

    public function mark_user_undeleted($user_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            UPDATE `Users` SET `deleted`='0' WHERE `user_id`=:user_id;
        ");

        try {
            $r->execute(array(
                ':user_id' => $user_id,
            ));
            $rowCount = $r->rowCount();
            return $rowCount;
        } catch (Exception $e) {
            error_log("user not marked undeleted $user_id", 0);
            echo 'Updated failed!';
        }

        return $r;
    }
    public function mark_user_deleted($user_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            UPDATE `Users` SET `deleted`='1' WHERE `user_id`=:user_id;
        ");

        try {
            $r->execute(array(
                ':user_id' => $user_id,
            ));
            $rowCount = $r->rowCount();
            return $rowCount;
        } catch (Exception $e) {
            error_log("user not marked deleted $user_id", 0);
            echo 'Updated failed!';
        }

        return $r;
    }


}