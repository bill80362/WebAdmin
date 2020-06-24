<?php
// 驗證資料使用套件:https://respect-validation.readthedocs.io/en/1.1/
use Respect\Validation\Validator as Val;
use Respect\Validation\Exceptions\ValidationException;

//用於檢查
class Validator
{
    //固定變數
    public static function checkNickname($_Data){
        try{
            $Val = Val::noWhitespace()->length(1,10)->setName('nickname');
            $Val->check($_Data);
        }catch (ValidationException $exception){
//            ResData::failValException($exception);
            ResData::fail(array("msg"=>"请输入1~10个字"),400);
        }
    }
    public static function checkUsername($_Data){
        try{
            $Val = Val::noWhitespace()->length(4,15)->setName('username');
            $Val->check($_Data);
        }catch (ValidationException $exception){
//            ResData::failValException($exception);
            ResData::fail(array("msg"=>"帐号密码错误"),400);
        }
    }
    public static function checkPassword($_Data){
        try{
            $Val = Val::noWhitespace()->length(6,12)->setName('password');
            $Val->check($_Data);
        }catch (ValidationException $exception){
//            ResData::failValException($exception);
            ResData::fail(array("msg"=>"帐号密码错误"),400);
        }
    }
    public static function checkTpl($_Data){
        try{
            $Val = Val::noWhitespace()->notEmpty()->setName('tpl');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkLevel($_Data){
        try{
            $Val = Val::in(['agent','member'])->setName('level');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkUserID($_Data){
        try{
            $Val = Val::IntVal()->setName('user_id');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkUserIDArray($_Data){
        try{
            $Val = Val::arrayType()->setName('user_id');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkAvatar($_Data){
        try{
            $Val = Val::notEmpty()->setName('Avatar');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkChatID($_Data){
        try{
            $Val = Val::noWhitespace()->length(36,36)->setName('chat_id');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkRoomGroup($_Data){
        try{
            $Val = Val::IntVal()->in(array_keys(Room::$RoomType))->setName('room_group');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkRoomName($_Data){
        try{
            $Val = Val::notEmpty()->noWhitespace()->length(1,20)->setName('room_name');
            $Val->check($_Data);
        }catch (ValidationException $exception){
//            ResData::failValException($exception);
            ResData::fail(array("msg"=>"请输入1~20个字"),400);
        }
    }
    public static function checkGameCode($_Data){
        try{
            $oWBPortal = new WBPortal();
            $GameCode = array_keys($oWBPortal->PlayCode);
            $Val = Val::length(2,2)->in($GameCode)->setName('game_code');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkRoomID($_Data){
        try{
            $Val = Val::IntVal()->setName('room_id');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkRoomStatus($_Data){
        try{
            $Val = Val::in(Room::$GameRoomStatus)->setName('room_status');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkMsgID($_Data){
        try{
            $Val = Val::IntVal()->setName('msg_id');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkMsgRead($_Data){
        try{
            $Val = Val::arrayType()->setName('MsgRead');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkMsgContent($_Data){
        try{
            $Val = Val::notEmpty()->setName('MessageContent');
            $Val->check($_Data);
        }catch (ValidationException $exception){
//            ResData::failValException($exception);
            ResData::fail(array("msg"=>"请输入讯息内容"),400);
        }
    }
    public static function checkGameLine($_Data){
        try{
            $Val = Val::in(['A','B','C','D'])->setName('game_line');
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    //彈性變數
    public static function checkInt($_Data,$_Var){
        try{
            $Val = Val::IntVal()->setName($_Var);
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkNotEmpty($_Data,$_Var){
        try{
            $Val = Val::notEmpty()->setName($_Var);
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkDate($_Data,$_Var){
        try{
            $Val = Val::date()->setName($_Var);
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkArrayValue($_Data,$_Array,$_Var){
        try{
            $Val = Val::in($_Array)->setName($_Var);
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkStringLength($_Data,$minString,$maxString,$_Var){
        try{
            $Val = Val::noWhitespace()->length($minString,$maxString)->setName($_Var);
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkEmail($_Data,$_Var){
        try{
            $Val = Val::noWhitespace()->email()->setName($_Var);
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    public static function checkArray($_Data,$_Var){
        try{
            $Val = Val::arrayType()->setName($_Var);
            $Val->check($_Data);
        }catch (ValidationException $exception){
            ResData::failValException($exception);
        }
    }
    //蘋果系統是否 回傳true/false
    public static function checkTokenIOS($_Data){
        //蘋果Token規則 長度64、不能有空白
        return Val::length(64,64)->noWhitespace()->validate($_Data);
    }
}