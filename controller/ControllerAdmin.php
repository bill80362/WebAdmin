<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/4/20
 * Time: 下午 04:55
 */

class ControllerAdmin
{
    public function __construct($Middleware){
        $this->oMiddleware = $Middleware;
        $this->oMiddleware->AuthGuardSession("Admin");
    }

    public function board(){
        //Middle Var
        $AuthType = $this->oMiddleware->AuthType;
        $AuthInfo = $this->oMiddleware->AuthInfo;


        include VIEW_PATH."/admin/board.php";
    }


}