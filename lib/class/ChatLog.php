<?php
/***
 * 套件使用說明 https://github.com/Seldaek/monolog
 * RotatingFileHandler : https://github.com/Seldaek/monolog/blob/master/src/Monolog/Handler/RotatingFileHandler.php
 ***/

use Monolog\Logger;
//use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;

class ChatLog
{
    static public function LoginRecord($Title, $Msg, $DataArray)
    {
        $logger = new Logger($Title);
        $handler = new RotatingFileHandler(SITE_PATH.'/log/LoginRecord.log', 0, Logger::INFO, true, 0664);
        $handler->setFilenameFormat('{date}_{filename}','Y-m-d');
        $logger->pushHandler($handler);
        $DataArray["SYSTEM"]["IP"] = PubFunction::getIPAddr();
        $DataArray["SYSTEM"]["PHP_SELF"] = $_SERVER["PHP_SELF"];
        $logger->info($Msg,$DataArray);
    }
    static public function Error($Title, $Msg, $DataArray)
    {
        $logger = new Logger($Title);
        $handler = new RotatingFileHandler(SITE_PATH.'/log/Error.log', 0, Logger::DEBUG, true, 0664);
        $handler->setFilenameFormat('{date}_{filename}','Y-m-d');
        $logger->pushHandler($handler);
        $DataArray["SYSTEM"]["IP"] = PubFunction::getIPAddr();
        $DataArray["SYSTEM"]["PHP_SELF"] = $_SERVER["PHP_SELF"];
        $logger->error($Msg,$DataArray);
    }
}