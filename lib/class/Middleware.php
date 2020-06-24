<?php


class Middleware
{
    public $AuthType;
    public $AuthInfo;

    //驗證Session
    public function AuthGuardSession($Auth){
        //可以過關的權限
        if($Auth=="All"){
            $GuardAuth = ["Admin","User"];
        }elseif($Auth=="Admin"){
            $GuardAuth = [$Auth];
        }elseif($Auth=="User"){
            $GuardAuth = [$Auth];
        }else{
            $GuardAuth = [];
        }
        //驗證
        if( in_array($_SESSION["Auth"]["Type"],$GuardAuth) && is_array($_SESSION["Auth"]["Data"])){
            $this->AuthType = $_SESSION["Auth"]["Type"];
            $this->AuthInfo = $_SESSION["Auth"]["Data"];
        }else{
            session_destroy();
            header("Location: /login");
            exit("Login First Please!");
        }
    }


}