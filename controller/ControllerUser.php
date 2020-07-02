<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/4/20
 * Time: 下午 04:55
 */

class ControllerUser
{
    public function __construct($Middleware){
        $this->oMiddleware = $Middleware;
        $this->oMiddleware->AuthGuardSession("Admin");//驗證權限
        $this->oMiddleware->getReqJsonData();
    }

    public function list(){
        //Middle Var
        $AuthType = $this->oMiddleware->AuthType;
        $AuthInfo = $this->oMiddleware->AuthInfo;


        include VIEW_PATH."/admin/user/list.php";
    }
    public function getDataList(){
        //get ReqData
        $ReqData = $this->oMiddleware->ReqData;

        $Data = [];
        $limit = 0;
        for($i=0;$i<100;$i++){
            if($i==0){
                if($ReqData["offset"]>0){
                    $i=$ReqData["offset"];
                }
            }
            $Data[] = array(
                "id"=>($i+1),
                "name"=>"Bill".($i+1),
                "account"=>"Bill".($i+1),
                "phone"=>"0912-345678",
                "email"=>"Bill@gmail.com",
                "intro"=>"Bill888",
                "new_time"=>"2022-".str_pad((12-$i),2,'0',STR_PAD_LEFT),
            );
            $limit++;
            if($limit==$ReqData["limit"]){
                break;
            }
        }
        echo json_encode(array(
            "total"=>100,
            "rows"=>$Data,
        ));
    }
    public function getData($arg){
        $id = $arg["id"];
        $Data = array(
            "id"=>$id,
            "name"=>"Bill".($id+1),
            "account"=>"Bill".($id+1),
            "phone"=>"0912-345678",
            "email"=>"Bill@gmail.com",
            "intro"=>"Bill888",
            "new_time"=>"2022-".str_pad((12-$id),2,'0',STR_PAD_LEFT),
        );
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($Data);
    }
    public function updateData(){
        //get ReqData
        $ReqData = $this->oMiddleware->ReqData;
        print_r($ReqData);
    }

}