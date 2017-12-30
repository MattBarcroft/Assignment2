<?php
class adminController
{
    public function index()
    {
        render("layout", "head");
        render("layout", "navbar");
        if(isset($_SESSION['admin'])){
            if($_SESSION['admin'] == 1){
                render("admin", "index");
            }
        } else {
            render("home", "notAdmin");
        }

        render("layout", "footer");

    }
    public function deleted_boards()
    {
        render("layout", "head");
        render("layout", "navbar");
        $boards = new boardsModel();
        $r = $boards->select_deleted_boards();

        if(isset($_SESSION['admin'])){
            if($_SESSION['admin'] == 1){
                render("admin", "deleted_boards", $r);
            }
        } else {
            render("home", "notAdmin");
        }
        render("layout", "footer");

    }
    public function user_actions()
    {
        render("layout", "head");
        render("layout", "navbar");
        if(isset($_SESSION['admin'])){
            if($_SESSION['admin'] == 1){
                render("admin", "user_actions");
            }
        } else {
            render("home", "notAdmin");
        }
        render("layout", "footer");

    }
    public function user_details($id)
    {
        $usersModel = new usersModel();
        $r = $usersModel->user_details($id);
        $userRolesModel = new userRolesModel();
        $userroles = $userRolesModel->select_user_roles($r["user_id"]);

        render("layout", "head");
        render("layout", "navbar");
        if(isset($_SESSION['admin'])){
            if($_SESSION['admin'] == 1){
                render("admin", "user_details", $r);
                render("admin", "user_roles", $userroles);
            }
        } else {
            render("home", "notAdmin");
        }

        render("layout", "footer");

    }

    
    public function mark_board_undeleted($id)
    {
        if(isset($_SESSION['admin'])){
            if($_SESSION['admin'] == 1){
                $boardsModel = new boardsModel();
                $r = $boardsModel->mark_board_undeleted($id);
                header("location: /admin/deleted_boards");
            }
        } else {
            render("home", "notAdmin");
        }

    }
    public function all_users()
    {
        $usersModel = new usersModel();
        $r = $usersModel->select_all_users();
        
        render("layout", "head");
        render("layout", "navbar");
        if(isset($_SESSION['admin'])){
            if($_SESSION['admin'] == 1){
                render("admin", "all_users", $r);
            }
        } else {
            render("home", "notAdmin");
        }


        render("layout", "footer");

    }
    public function mark_user_undeleted($id){

        if(isset($_SESSION['admin'])){
            if($_SESSION['admin'] == 1){
                $usersModel = new usersModel();
                $r = $usersModel->mark_user_undeleted($id);
                header("location: /admin/user_details/$id");
            }
        } else {
            render("home", "notAdmin");
        }
    }
    public function mark_user_deleted($id){

        if(isset($_SESSION['admin'])){
            if($_SESSION['admin'] == 1){
                $usersModel = new usersModel();
                $r = $usersModel->mark_user_deleted($id);
                header("location: /admin/user_details/$id");
            }
        } else {
            render("home", "notAdmin");
        }
    }

    public function make_admin($id){
        if(isset($_SESSION['admin'])){
            if($_SESSION['admin'] == 1){
                $userRolesModel = new userRolesModel();
                $r = $userRolesModel->make_admin($id);
                header("location: /admin/user_details/$id");
            }
        } else {
            render("home", "notAdmin");
        }

    }
    public function remove_admin($id){

        if(isset($_SESSION['admin'])){
            if($_SESSION['admin'] == 1){
                $userRolesModel = new userRolesModel();
                $r = $userRolesModel->remove_admin($id);
                header("location: /admin/user_details/$id");
            }
        } else {
            render("home", "notAdmin");
        }
    }


}

?>