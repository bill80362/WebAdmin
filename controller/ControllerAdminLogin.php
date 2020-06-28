<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/4/20
 * Time: 下午 04:55
 */

class ControllerAdminLogin
{
    public $oMiddleware;

    public function __construct($Middleware){
        $this->oMiddleware = $Middleware;
    }

    public function login(){
        //清空登入資訊
        session_destroy();
        //登入介面
        include VIEW_PATH."/login/login.php";
    }

    public function loginData(){
        //Admin
        $oAdmin = new Admin();
        $Result = $oAdmin->login($_POST["Account"],$_POST["Password"]);
        if($Result){
            $_SESSION["Auth"]["Type"] = "Admin";
            $_SESSION["Auth"]["Data"] = $Result;
            header("Location: /my");
            exit();
        }
        //User
        $oUser = new User();
        $Result = $oUser->login($_POST["Account"],$_POST["Password"]);
        if($Result){
            $_SESSION["Auth"]["Type"] = "User";
            $_SESSION["Auth"]["Data"] = $Result;
            header("Location: /my");
            exit();
        }
        //
        exit("請問您找誰!");

    }
    public function register(){

    }
    public function logout(){

    }


}