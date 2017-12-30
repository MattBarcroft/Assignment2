<?php 
class homeController{
    public function index(){

        render("layout", "head");
        render("layout", "navbar");
        if(isset($_SESSION['userid'])){
            $boardsController = new boardsController();
            render("boards", "boardsTopWrapper");
            $boardsController->usersBoards();
            $boardsController->publicBoards();
            render("boards", "boardsBottomWrapper");
        } else {
            render("home", "notLoggedIn");
        }
        render("layout", "footer");
    }
    public function notLoggedIn(){
        render("home", "notLoggedIn");
    }
    public function notAdmin(){
        render("home", "notAdmin");
    }
    public function isAdmin(){
        if(isset($_SESSION['userid'])){
            $userRolesModel = new userRolesModel();
            $r = $userRolesModel->is_admin();
        }
    
    }
}