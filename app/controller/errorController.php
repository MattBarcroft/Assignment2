<?php 
class errorController{
    public function index(){
            render("layout", "head");
            render("layout", "navbar");
            render("error", "index");
            render("layout", "footer");

    }
}
