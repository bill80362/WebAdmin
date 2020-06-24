<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2019/12/4
 * Time: 下午 03:03
 */

class UserToken extends DBModel
{
    public $_Expire = "+12 hour";//Token到期時間長度
    public $_Token ;
    public $oDateTime_Expire;

    public function newToken($_UserID){
        //讓之前的Token ExpireTime都到期
        $Data = array();
        $oDateTime_Now = new Datetime();
        $Data["ExpireTime"] = $oDateTime_Now->format("Y-m-d H:i:s");
        $this->update($Data," UserID=".$_UserID." AND ExpireTime>'".$oDateTime_Now->format("Y-m-d H:i:s")."'");
        //新建一筆Token
        $this->_Token = PubFunction::create_uuid();
        $this->oDateTime_Expire = new Datetime();
        $this->oDateTime_Expire->modify($this->_Expire);
        $Data = array();
        $Data["UserID"] = $_UserID;
        $Data["Token"] = $this->_Token;
        $Data["ExpireTime"] = $this->oDateTime_Expire->format("Y-m-d H:i:s");
        $this->create($Data);
    }
    public function getUserIDbyToken($_Token){
        $oDateTime_Now = new Datetime();
        $Data = $this->getData(" Token='".$_Token."' AND ExpireTime>'".$oDateTime_Now->format('Y-m-d H:i:s')."' ");
        return $Data["UserID"];
    }
    public function getNewestTime($_IDArray){
        $sql = "SELECT UserID,MAX(NewTime) as NewestTime FROM ".$this->TableName." WHERE UserID IN (".join(',',$_IDArray).") GROUP BY UserID ";
        $this->_SQL = $sql;
        $this->_DB['S']->query($sql);
        $List = $this->_DB['S'] -> get_total_data();
        return $List;
    }

}