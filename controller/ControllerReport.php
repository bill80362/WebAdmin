<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/4/20
 * Time: 下午 04:55
 */

class ControllerReport
{
    public function __construct($Middleware){
        $this->oMiddleware = $Middleware;
        $this->oMiddleware->AuthGuardSession("Admin");//驗證權限
    }
    public function report(){
        //Middle Var
        $AuthType = $this->oMiddleware->AuthType;
        $AuthInfo = $this->oMiddleware->AuthInfo;

        include VIEW_PATH."/admin/report/report.php";
    }
    public function reportData(){
        $Data = [];
        for($i=0;$i<10;$i++){
            $Data[] = array(
                "id"=>$i,
                "name"=>"Bill".($i+1),
                "date"=>"2022-".(12-$i),
                "price"=>5000*rand(1,20),
            );
        }
        echo json_encode($Data);
    }
    public function make(){
        include VIEW_PATH."/admin/report/make.php";
    }
}