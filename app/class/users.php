<?php
class users{
    public $user_id;
    public $username;
    public $name;
    public $password;
    public $email;
    public $account_created;
    public $account_modified;
    public $deleted;
    public $admin;

    //getter and setter for user_id
    function get_user_id(){
        return $this->user_id;
    }
    function set_user_id($user_id){
        return $this->user_id = $user_id;
    }

    //getter and setter for username
    function get_username(){
        return $this->username;
    }
    function set_username($username){
        return $this->username = $username;
    }

    //getter and setter for name
    function get_name(){
        return $this->name;
    }
    function set_name($name){
        return $this->name = $name;
    }

    //getter and setter for password
    function get_password(){
        return $this->password;
    }
    function set_password($password){
        return $this->password = $password;
    }

    //getter and setter for email
    function get_email(){
        return $this->email;
    }
    function set_email($email){
        return $this->email = $email;
    }

    //getter and setter for account created
    function get_account_created(){
        return $this->account_created;
    }
    function set_account_created($account_created){
        return $this->account_created = $account_created;
    }

    //getter and setter for account modified
    function get_account_modified(){
        return $this->account_modified;
    }
    function set_account_modified($account_modified){
        return $this->account_modified = $account_modified;
    }

    //getter and setter for deleted
    function get_deleted(){
        return $this->deleted;
    }
    function set_deleted($deleted){
        return $this->deleted = $deleted;
    }

    //verifys password hash with supplied password
    function verify_password($pass){
        return password_verify($pass, $this->password);
        
    }

}

?>