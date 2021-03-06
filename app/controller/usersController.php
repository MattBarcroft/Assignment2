<?php 
class usersController{
    public function index(){
        render("layout", "head");
        render("layout", "navbar");
        render("users", "register");
        render("layout", "footer");
    }
    public function register(){
        render("layout", "head");
        render("layout", "navbar");
        render("users", "register");
        render("layout", "footer");
    }
    public function user_creation_success(){
        render("layout", "head");
        render("layout", "navbar");
        render("users", "user_creation_success");
        $boardsController = new boardsController();
        render("boards", "boardsTopWrapper");
        $boardsController->usersBoards();
        $boardsController->publicBoards();
        render("boards", "boardsBottomWrapper");
        render("layout", "footer");
    }
    public function user_creation_failure(){
        render("layout", "head");
        render("layout", "navbar");
        render("users", "user_creation_failure");
        render("layout", "footer");
    }
    public function insert_user(){
    
        $user = new users();

        $user->set_name($_POST['name']);
        $user->set_username($_POST['username']);
  
        $user->set_password(password_hash($_POST['password'], PASSWORD_DEFAULT));
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
          header("location: /users/user_creation_failure");
        } else{ 
            $user->set_email($_POST['email']);
        }
        
        $usersModel = new usersModel();

        $id = $usersModel->insert_user($user);
        
        if($id != 0){
            $_SESSION['username'] = $user->get_username();
            $_SESSION['userid'] = $id;
            $userRolesModel = new userRolesModel();
            $userRolesModel->insert_users_role($id);
            header("location: /users/user_creation_success");
        }
        else{
            header("location: /users/user_creation_failure");
        }
        render("layout", "footer");  
    }
    
    public function check_login(){
        render("layout", "head");
        render("layout", "navbar");
        $username = $_POST['username'];

        $usersModel = new usersModel();
        $bool = $usersModel->check_login_credentials($username, $_POST['password']);
        
        if($bool){
            $r = $usersModel->get_user_id($_POST['username']);
            $_SESSION['username'] = $username;
            $_SESSION['userid'] = $r->user_id;
            $userRolesModel = new userRolesModel();
            $admin = $userRolesModel->is_admin($r->user_id);
            if ($admin){
                $_SESSION['admin'] = 1;
            }
            render("users", "login_successful");
            
        } else {
            render("users", "login_failure");
        }
        
        render("layout", "footer");
    }
    public function logout(){
        render("layout", "head");
        render("layout", "navbar");
        if(isset($_SESSION['username'])){
            unset($_SESSION['username']);
            unset($_SESSION['password']);
      
            session_unset();
            session_destroy();
      
            setcookie("username", "", time()+60, "/");
            setcookie("password", "", time()+60, "/");
        }

        render("users", "logout");
        render("layout", "footer");
    }
}
?>
