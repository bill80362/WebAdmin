<?php

use Respect\Validation\Exceptions\ValidationException;

class ResData
{
    static public function success($_JSON){
        $_JSON['code']=200;
//        header('Content-Type: application/json; charset=utf-8');
        return json_encode($_JSON);
    }
    static public function fail($_JSON,$error_code=500,$ErrorDetail=""){
        //ErrorMsg
        $_JSON['code']=$error_code;
        $_JSON['success']=false;
        //Log
//        ChatLog::Error("錯誤碼".$error_code, "" ,
//            array(
//                "ErrorMsg" => $_JSON,
//                "ErrorDetail" => $ErrorDetail,
//                "ReqData" => Middleware::$ReqData,
//                "UserID"=> Middleware::$UserID,
//            )
//        );
        //Res
//        header('Content-Type: application/json; charset=utf-8');
        return json_encode($_JSON);
    }
    static public function failException(Exception $e,$error_code=""){
        //ErrorMsg

        $_JSON['code']=$error_code==""?$e->getCode():$error_code;
        $_JSON['msg']=$e->getMessage();
        $_JSON['dev_error_detail']=$e->getTraceAsString();
        //Log
//        ChatLog::Error("錯誤碼".$e->getCode(),$e->getMessage(),
//            array(
//                "ErrorDetail" => $e->getTraceAsString(),
//                "ReqData" => Middleware::$ReqData,
//                "UserID"=> Middleware::$UserID,
//            )
//        );
        //Res
//        header('Content-Type: application/json; charset=utf-8');
        return json_encode($_JSON);
    }
    //資料驗證錯誤
    static public function failValException(ValidationException $e){
        //ErrorMsg
        $_JSON['code']=400;
        $_JSON['msg']=$e->getMessage();
        $_JSON['dev_error_detail']=$e->getTraceAsString();
        //Log
//        ChatLog::Error("ResData驗證錯誤", $e->getMessage(),
//            array(
//                "ErrorDetail" => $e->getTraceAsString(),
//                "ReqData" => Middleware::$ReqData,
//                "UserID"=> Middleware::$UserID,
//            )
//        );
        //Res
//        header('Content-Type: application/json; charset=utf-8');
        return json_encode($_JSON);
    }

}