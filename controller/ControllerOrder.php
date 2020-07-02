<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/4/20
 * Time: 下午 04:55
 */

class ControllerOrder
{
    public function __construct($Middleware){
        $this->oMiddleware = $Middleware;
        $this->oMiddleware->AuthGuardSession("Admin");//驗證權限
    }

    public function list(){
        //Middle Var
        $AuthType = $this->oMiddleware->AuthType;
        $AuthInfo = $this->oMiddleware->AuthInfo;


        include VIEW_PATH."/admin/order/list.php";
    }
    public function getData(){
        $Data = [];
        for($i=0;$i<10;$i++){
            $Data[] = array(
                "id"=>($i+1),
                "name"=>"Bill".($i+1),
                "account"=>"Bill".($i+1),
                "phone"=>"0912-345678",
                "email"=>"Bill@gmail.com",
                "intro"=>"Bill888",
                "new_time"=>"2022-".str_pad((12-$i),2,'0',STR_PAD_LEFT),
                "order_data"=>"商品ABC*5<BR>商品CCC*1",
                "price"=>8000,
            );
        }
        echo json_encode($Data);
    }

}