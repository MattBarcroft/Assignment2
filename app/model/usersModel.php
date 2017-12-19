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
    function get_user_id($username){
        
        $pdo = get_db();
        
        $r = $pdo->prepare("select user_id from Users
        where username = :username" );
    
        $r->execute(array(':username' => $username));
    
        return $r->fetch(PDO::FETCH_OBJ);
        
    }

}