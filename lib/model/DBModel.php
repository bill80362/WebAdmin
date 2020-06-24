<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2019/12/4
 * Time: 上午 10:43
 */

abstract class DBModel
{
    protected $TableName = "";
    protected $PrimaryID = "";
    protected $_DB ;
    protected $InsertID;
    public $_SQL;

    function __construct()
    {
        $this->_DB['M'] = new DBconn(DB_HOST_M, DB_USER_M, DB_PASSWD_M, DB_NAME);
        $this->_DB['S'] = new DBconn(DB_HOST_S, DB_USER_S, DB_PASSWD_S, DB_NAME);
        if($this->TableName==""){
            $this->TableName = get_class($this);//DB資料表名稱與Class一致
        }
        if($this->PrimaryID==""){
            $this->PrimaryID = $this->TableName."ID";
        }
    }
    public function getPrimaryID(){
        echo $this->PrimaryID;
    }
    //全部列表
    public function all($Sql=""){
        $sql = "SELECT * FROM ".$this->TableName." ".$Sql;
        $this->_SQL = $sql;
        $this->_DB['S']->query($sql);
        $List = $this->_DB['S'] -> get_total_data();
        return $List;
    }
    //根據ID找單筆資料
    public function find($_ID){
        $sql = "SELECT * FROM ".$this->TableName." WHERE ".$this->PrimaryID."='".$_ID."'";//ID前面都要加上Table名稱
        $this->_SQL = $sql;
        $this->_DB['S']->query($sql,true);
        $Data = $this->_DB['S']->record;
        return $Data;
    }
    //新增
    public function create($_Data){
        $sql = PubFunction::sql_insert($this->TableName, $_Data);
        $this->_SQL = $sql;
        if($this->_DB['M']->query($sql)){
            $this->InsertID = $this->_DB['M']->insert_id;
            return true;
        }else{
            return false;
        }
    }
    //取得剛剛新增的ID
    public function getInsertID(){
        return $this->InsertID;
    }
    //更新
    public function update($_Data,$_WHERE){
        $sql = PubFunction::sql_update($this->TableName, $_Data,$_WHERE);
        $this->_SQL = $sql;
        return $this->_DB['M']->query($sql);
    }
    //條件搜尋列表
    public function getList($_WHERE){
        $sql = "SELECT * FROM ".$this->TableName." WHERE ".$_WHERE;
        $this->_SQL = $sql;
        $this->_DB['S']->query($sql);
        $List = $this->_DB['S'] -> get_total_data();
        return $List;
    }
    //條件搜尋單一檔案
    public function getData($_WHERE){
        $sql = "SELECT * FROM ".$this->TableName." WHERE ".$_WHERE;
        $this->_SQL = $sql;
        $this->_DB['S']->query($sql,true);
        return $this->_DB['S']->record;
    }
    //條件搜尋列表 透過ID陣列
    public function getListbyID($_IDArray,$_field="",$_WHERE=""){
        if($_field=="")
            $_field = $this->PrimaryID;
//            $_field = $this->TableName."ID";
        if($_WHERE!="")
            $_WHERE = " AND ".$_WHERE;
        if(count($_IDArray)==0)
            return false;
        $sql = "SELECT * FROM ".$this->TableName." WHERE ".$_field." IN ('".join("','",$_IDArray)."') ".$_WHERE;
        $this->_SQL = $sql;
        $this->_DB['S']->query($sql);
        $List = $this->_DB['S'] -> get_total_data();
        return $List;
    }
    //條件搜尋列表 透過ID陣列
    public function delData($_WHERE){
        $sql = "DELETE FROM ".$this->TableName." WHERE ".$_WHERE;
        $this->_SQL = $sql;
        return $this->_DB['M']->query($sql);
    }



}