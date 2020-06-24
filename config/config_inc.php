<?php
//根目錄路徑位置
define("SITE_PATH",__DIR__."/..");//正式站選這個

//載入Composer套件
include SITE_PATH."/vendor/autoload.php";
//動態載入class
function autoload($classname) {
    //Controller
    $classpath=SITE_PATH."/controller/".$classname.".php";
    if(file_exists($classpath))
        require $classpath;
    //Model 【DB的部分】
    $classpath=SITE_PATH."/lib/model/".$classname.".php";
    if(file_exists($classpath))
        require $classpath;
    //Lib 【工具Class】
    $classpath=SITE_PATH."/lib/class/".$classname.".php";
    if(file_exists($classpath))
        require $classpath;
}
spl_autoload_register('autoload'); //PHP7.2开始必须这样写
//
date_default_timezone_set('Asia/Taipei');

/***【系統設定】***/
define("SQL_SHOW","N");//Y代表輸出SQL_ERROR
define("DEBUG_SHOW",0);

/***【路徑】***/
define("VIEW_PATH",SITE_PATH."/view");

/***【正式站】***/
$DB_IP = 'localhost:3306';
define("DB_NAME","");
define("DB_HOST_M",$DB_IP);
define("DB_HOST_S",$DB_IP);
define("DB_USER_M","");
define("DB_USER_S","");
define("DB_PASSWD_M","");
define("DB_PASSWD_S","");
define("DB_PORT","");
?>
