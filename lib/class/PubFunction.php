<?php
class PubFunction
{

    /**
     * 各系統用到的function寫在這裡。
     * 不要濫用，有必要才放
     * 1.sql_insert();----------------INSERT SQL語法產生
     * 2.js_alert();------------------JavaScript 彈跳視窗
     * 3.js_location();---------------JavaScript 導頁
     * 4.js_back();-------------------JavaScript回上一頁
     * 6.page_count();----------------static public function 分頁
     * 7.get_seq();-------------------取得序號
     * 8.sql_update();----------------UPDATE SQL語法產生
     * 9.get_product_type_option()----產品別的下拉選單
     * 10.GetSuggest()----------------關鍵字建議清單
     * 11.print_message()-------------訊息頁
     * 12.deCheckCode()---------------驗證碼 (解)
     * 13.url_encode()----------------URL 加密
     * 14.url_decode()----------------URL 解密
     * 15.custom_encode()-------------加密
     * 16.custom_decode()-------------解密
     * 17.js_reload()-----------------javascript 重整
     * 18.check_format()--------------檢查資料格式
     * 19.sabsi()---------------------陣列排序
     * 20.getIP()---------------------取得ip位址
     * 21.unlawful_record()-----------紀錄違法動作
     * 22.timeformat()----------------時間轉換格式
     * 23.modify_date()---------------站成及退水的修改時間
     * 24.write_record()--------------寫紀錄檔
     * 25.getCurrencyOption-----------幣值選單
     * 26.show_meeage()---------------秀訊息
     * 27.get_user_account()----------取人的帳號
     * 28.get_user_line()-------------取人的Line
     * 29 mouse_right_key()-----------鎖右鍵
     * 30 ob_gzip()
     * 31.js_color_alert();----------color alert
     * 32.WriteMonitor----------------寫背景監控
     * 33.WriteStratTime--------------寫程式啟動時間
     * 34.WriteErrorRecord------------寫客戶出現的錯誤訊息
     * 35.do_round------------取小數 四捨五入
     * 36.three_sec_load_once------------小球三秒內重複載入就擋掉
     * 37.three_sec_load_once_sport------------大球三秒內重複載入就擋掉
     * 38.js_color_msg------------color msg,讀秒後自動導頁
     * 39.DBLoadBalance-----------DB連線負載平衡
     * 40.Pub_CheckFloatLength--------檢查小數位數
     * 41.Creat_IPAccessDeny--------生成IP資料
     * 42.UPDATE_IPAccessDeny-------更新IP資訊
     * 43.getBrowser-------抓取瀏覽器資訊
     * 44.ip2long_v4v6-------ip轉數字
     * 45.long2ip_v4v6-------數字轉ip
     * 46.preg_array_key_exists()----------用表達示尋找array的key存不存在
     */

    /**
     *INSERT SQL語法產生
     */
    static public function sql_insert($_table, $_arr)
    {
        $str = "INSERT INTO $_table (%s) VALUES (%s)";
        $str_field = array();
        $str_value = array();
        if (count($_arr) == 0 || !is_array($_arr)) return false;
        foreach ($_arr as $key => $_value) {
            $str_field[] = $key;
            if (substr($_value, 0, 1) == "@") {
                $str_value[] = "" . substr($_value, 1) . "";
            } else {
                $str_value[] = "'" . $_value . "'";
            }
        }
        return sprintf($str, join(',', $str_field), join(',', $str_value));
    }

    /**
     *INSERT SQL語法產生 2代版本....Bill 改寫
     */
    static public function sql_insert_2($_table, $_arr)
    {
        $_SQL_INSERT_ARRAY = [];
        foreach ($_arr as $key=>$value){
            $_SQL_INSERT_ARRAY[] = $key."='".$value."'";
        }
        $sql = "INSERT INTO ".$_table." SET ".implode(" , ",$_SQL_INSERT_ARRAY);
        return $sql;
    }

    /**
     * UPDATE SQL語法產生
     *
     * @param string $_table
     * @param array $_arr
     * @param string $_where
     * @return string
     */

    static public function sql_update($_table, $_arr, $_where)
    {
        $str = "UPDATE $_table SET %s ";
        $str_value = array();
        if (count($_arr) == 0 || !is_array($_arr)) return false;
        foreach ($_arr as $key => $_value) {

            if (substr($_value, 0, 1) == "@") {
                $str_value[] = $key . "='" . substr($_value, 1) . "'";
            } else {
                $str_value[] = $key . "='" . $_value . "'";
            }
        }
        return sprintf($str, join(',', $str_value)) . " WHERE " . $_where;
    }

    /**
     * Replace SQL語法產生
     *
     * @param string $_table
     * @param array $_arr
     * @param string $_where
     * @return string
     */

    static public function sql_replace($_table, $_arr)
    {
        $str = "REPLACE INTO $_table (%s) VALUES (%s)";
        $str_field = array();
        $str_value = array();
        if (count($_arr) == 0 || !is_array($_arr)) return false;
        foreach ($_arr as $key => $_value) {
            $str_field[] = $key;
            if (substr($_value, 0, 1) == "@") {
                $str_value[] = "'" . substr($_value, 1) . "'";
            } else {
                $str_value[] = "'" . $_value . "'";
            }
        }
        return sprintf($str, join(',', $str_field), join(',', $str_value));
    }


    /**
     * Replace SQL語法產生
     *
     * @param string $_table
     * @param array $_arr
     * @param string $_where
     * @return string
     */

    static public function sql_insert_or_update($_table, $_arr, $_PrimaryKey)
    {
        $insert_sql = sql_insert($_table, $_arr);
        foreach ($_PrimaryKey as $key => $_value) {
            unset($_arr[$_value]);
        }
        if (count($_arr) == 0 || !is_array($_arr)) return false;
        $update_sql = array();
        foreach ($_arr as $key => $_value) {
            if ($_value != "") {
                $update_sql[] = $key . "='" . $_value . "'";
            }
        }
        return $insert_sql . " ON DUPLICATE KEY UPDATE " . join(',', $update_sql);
    }

    /**
     *INSERT IGNORE  SQL語法產生
     */
    static public function sql_insert_ignore($_table, $_arr)
    {
        $str = "INSERT IGNORE INTO $_table (%s) VALUES (%s)";
        $str_field = array();
        $str_value = array();
        if (count($_arr) == 0 || !is_array($_arr)) return false;
        foreach ($_arr as $key => $_value) {
            $str_field[] = $key;
            if (substr($_value, 0, 1) == "@") {
                $str_value[] = substr($_value, 1);
            } else {
                $str_value[] = "'" . $_value . "'";
            }
        }
        return sprintf($str, join(',', $str_field), join(',', $str_value));
    }

    /**
     *JavaScript 彈跳視窗
     */


    static public function js_alert($_value, $_meta = 'utf-8')
    {
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$_meta\">";
        echo "<script>\n";
        echo " var str='{$_value}';";
        echo "var ta=document.createElement(\"textarea\");";
        echo "ta.innerHTML=str.replace(/</g,\"&lt;\").replace(/>/g,\"&gt;\");";
        echo "  alert(ta.value)\n";
        echo "</script>\n";
    }

    static public function js_alert_no_script($_value, $_meta = 'utf-8')
    {
        echo "var str='{$_value}';";
        echo "var ta=document.createElement(\"textarea\");";
        echo "ta.innerHTML=str.replace(/</g,\"&lt;\").replace(/>/g,\"&gt;\");";
        echo "alert(ta.value)\n";
    }

    /**
     *JavaScript 自動關閉視窗
     */
    static public function js_close()
    {
        echo "<script>\n";
        echo "setTimeout('self.close();',0000)";
        echo "</script>\n";
    }

    /**
     *JavaScript 導頁
     */
    static public function js_location($_url, $_target = 'self')
    {
        echo "<script>\n";
        echo "  $_target.location = '$_url';\n";
        echo "</script>\n";
    }

    static public function js_location_no_script($_url, $_target = 'self')
    {
        echo "  $_target.location = '$_url';\n";
    }

    static public function js_back()
    {
        echo "<script>\n";
        echo " history.back();\n";
        echo "</script>\n";
    }

    static public function js_color_alert($_value, $_meta = 'utf-8', $_back_rul = '')
    {
        if ($_back_rul == '') {
            $bak_action = "history.back();";
        } else {
            $bak_action = "self.location='{$_back_rul}';";
        }
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$_meta\">";
        echo "<script language=\"javascript\" src=\"/js/jquery.3.1.1.min.js\"></script>
        <link href=\"/bootstrap/css/bootstrap.css?ver=1221\" rel=\"stylesheet\" type=\"text/css\">
        <script language=\"javascript\" src=\"/bootstrap/js/bootstrap.min.js\"></script>";
        echo "
	<div align=\"center\" id=\"divAlert\">
        <div style=\"border:2px outset buttonhighlight;width:400px;font:9pt Verdana; background-color:buttonface;\">
        <div style=\"background-color:highlight;padding:1px;color:white;text-align:left;font-weight:bold;\">Message</div>
        <div style=\" padding:30px;\">
                {$_value}                
                <p> <button onclick=\"divAlert.style.display='none';{$bak_action}\"> - O K - </button> </p>
                </div>
        </div>
	</div>";
    }

    /**
     * 分頁下拉選單
     *
     * @param int $_now_page --目前頁數
     * @param int $_totol_nums --總共筆數
     * @param int $_page_nums --單頁筆數
     * @return string
     */
    static public function page_count($_now_page, $_totol_nums, $_page_nums)
    {
        if ($_now_page == "") $_now_page = 1;
        $j = 1;
        for ($i = 1; $i <= $_totol_nums; $i = $i + $_page_nums) {
            if ($j == $_now_page) {
                $str .= "<option valu=$j selected>" . $j . "</option>";
            } else {
                $str .= "<option valu=$j>" . $j . "</option>";
            }
            $j++;
        }
        return $str;
    }

    /**
     * 取得序號
     *
     * @param object $_db
     * @param string $_seq_name
     * @return int
     */
    static public function get_seq($_db, $_seq_name)
    {
        $qstr = "INSERT INTO " . $_seq_name . " VALUES () ";
        $_db->query($qstr);
        return $_db->insert_id;
    }

    /**
     * 訊息頁
     *
     * @param String $_message
     * @param String $_back_url
     */

    static public function print_message($tpl, $tpl_dir, $_message, $_back_url)
    {

        $tpl->assign("BACK_URL", $_back_url);
        $tpl->assign("MESSAGE", $_message);
        $tpl->assign("TPL_DIR", $tpl_dir);
        $tpl->display("message.html");
    }


//網址加碼
    static public function url_encode($url)
    {
        if (GLOAB_URL_ENCODE_SWITCH == "Y") {
            return "p=" . urlencode(urlencode(custom_encode($url)));
        } else {
            return $url;
        }
    }

//網址解碼
    static public function url_decode()
    {
        //GET 解密
        if (GLOAB_URL_ENCODE_SWITCH == "Y") {
            $p = urldecode(urldecode(custom_decode($_GET['p'])));
            $ap = explode("&", $p);
            foreach ($ap as $key => $b) {
                $b = explode('=', $b);
                $_GET[htmlspecialchars(urldecode($b[0]))] = htmlspecialchars(urldecode($b[1]));
            }
        }
    }

//自定加密base64
    static public function custom_encode($str)
    {
        if ($str == '') return '';
        $out = "QWERTYU" . base64_encode(strrev($str));
        return $out;
    }

//自定解密base64
    static public function custom_decode($out)
    {
        if ($out == '') return '';
        $out = str_replace("QWERTYU", "", $out);
        $str = strrev(base64_decode($out));
        return $str;
    }

    static public function js_reload($target = 'self')
    {
        echo "<script>\n";
        echo "   $target.location.reload();\n";
        echo "</script>\n";
    }

    /**
     * 檢查資料格式
     *
     * @param unknown_type $data
     * @param int,float,sign_float,natural_number,date $format
     * @return unknown
     */
    static public function check_format($data, $format)
    {
        switch ($format) {
            case 'int':
                $eregstr = "/^-{0,1}[0-9]*$/";
                //整數
                break;
            case 'float':
                //浮點數
                $eregstr = "/^-{0,1}[0-9]*\.?[0-9]*$/";
                break;
            case 'sign_float':
                //大於0的浮點數
                $eregstr = "/^[0-9]{0,}\.?[0-9]*$/";
                break;
            case 'natural_number':
                //自然數 正整數
                $eregstr = "/^[1-9][0-9]*$/";
                break;
            case 'date':
                //日期 YYYY-MM-DD
                break;
            default:
                break;
        }
        if (!preg_match($eregstr, $data)) {
            return array(false, 'ERROR..' . $format);
        } else {
            return array(true);
        }
    }

    /**
     * 陣列排序
     *
     * @param unknown_type $array
     * @param unknown_type $index
     * @param unknown_type $order
     * @param unknown_type $natsort
     * @param unknown_type $case_sensitive
     * @return unknown
     */
    static public function sabsi($array, $index, $order = 'asc', $natsort = FALSE, $case_sensitive = FALSE)
    {
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) $temp[$key] = $array[$key][$index];
            if (!$natsort) ($order == 'asc') ? asort($temp) : arsort($temp);
            else {
                ($case_sensitive) ? natsort($temp) : natcasesort($temp);
                if ($order != 'asc') $temp = array_reverse($temp, TRUE);
            }
            foreach (array_keys($temp) as $key) (is_numeric($key)) ? $sorted[$key] = $array[$key] : $sorted[$key] = $array[$key];
            return $sorted;
        }
        return $array;
    }

    /**
     * 時間格式轉換
     *
     * @param unknown_type $time
     * @param unknown_type $s
     * @param unknown_type $t
     */

    static public function timeformat($time, $format, $source = "", $target = "")
    {
        if ($source == "" and $target == "") {
            //return date($format,$time-12*60*60);//台灣時間轉換成美東時間
            return date($format, $time);//台灣時間轉換成美東時間
        }
    }

    /**
     * 取得ip位址
     */
    static public function ChangeClientIP()
    {
        //利用sky ap 更改 proxy ip 為客戶ip
        $HTTP_HOST = $_SERVER['HTTP_HOST'];
        $HTTP_HOST_ARR = explode(".", $HTTP_HOST);
        $_SERVER['ProxyAddr'] = '';
        if ($HTTP_HOST_ARR[0] == "sky" || $HTTP_HOST_ARR[0] == "asky") {
            preg_match("/PIP:(.*?):PIP/", $_SERVER['HTTP_USER_AGENT'], $matches);
            $iphost = $matches[1];
            $iphost = base64_decode(str_replace("RIwiW", "", $iphost));
            $_SERVER['ProxyAddr'] = $_SERVER['REMOTE_ADDR'];
            $_SERVER['REMOTE_ADDR'] = $iphost;
        }
    }

    static public function getIP()
    {
        PubFunction::ChangeClientIP();
        $ip = false;
        if (!empty($_SERVER["HTTP_CLIENT_IP"]) &&
            (filter_var($_SERVER["HTTP_CLIENT_IP"], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)
                || filter_var($_SERVER["HTTP_CLIENT_IP"], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
        ) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }

        $HTTP_X_FORWARDED_TYPE = TRUE;
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $HTTP_X_FORWARDED = explode(",", str_replace(" ", "", $_SERVER['HTTP_X_FORWARDED_FOR']));
        if( isset($HTTP_X_FORWARDED) && is_array($HTTP_X_FORWARDED) )
            foreach ($HTTP_X_FORWARDED as $key => $value) {
                if (!filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) && !filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    $HTTP_X_FORWARDED_TYPE = FALSE;
                    break;
                }
            }
        if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) && $HTTP_X_FORWARDED_TYPE) {
            $ips = explode(",", str_replace(" ", "", $_SERVER['HTTP_X_FORWARDED_FOR']));
            if ($ip) {
                array_unshift($ips, $ip);
                $ip = FALSE;
            }
            for ($i = 0; $i < count($ips); $i++) {
                if (!preg_match("/^(10\.|172\.16\.|192\.168\.)/i", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        ($ip ? $ipa['REMOTE_ADDR'] = $ip : $ipa['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR']);
        $ipa['SERVER_ADDR'] = $_SERVER['SERVER_ADDR'];
        return $ipa;
    }

    /**
     * @param $_MenuKey
     * @param $_Account
     * @param $_UserID
     * @param $_UserType   Admin,Agent,Mem
     * @param $_Content
     * @param $_sql_command
     * @return bool|string
     */
    static public function write_record($_MenuKey, $_Account, $_UserID, $_UserType, $_Content, $_sql_command = "", $_MID = "", $_AID = "", $_CID = "")
    {
        if (empty($_db)) {
            $_db = new DB(DB_HOST_M, DB_USER_M, DB_PASSWD_M, DB_NAME);
        }
        if (is_array($_sql_command)) {
            $_sql_command = join(";", $_sql_command);
        }
        $_sql_command = str_replace("'", "", $_sql_command);
        $_Content = str_replace("'", "", $_Content);
        $addr = getIP();
        $data = array(
            'MenuKey' => $_MenuKey,
            'Account' => $_Account,
            'UserID' => $_UserID,
            'UserType' => $_UserType,
            'RemoteAddr' => $addr['REMOTE_ADDR'],
            'Content' => $_Content,
            'MID' => $_MID,
            'AID' => $_AID,
            'CID' => $_CID,
            'PName' => $_SERVER['PHP_SELF'],
            'SqlCommand' => $_sql_command,
            'HOST' => $_SERVER['HTTP_HOST']
        );
        $qstr = SQL_INSERT('CtlRecord', $data);
        if ($_db == "") {
            return $qstr;
        } else {
            $_db->query($qstr);
        }
    }

    /**
     * 接受到不正常行為 寫記錄用
     * @param $_Account
     * @param $_UserID
     * @param $_UserType
     * @param $_Content
     * @return bool|string
     */
    static public function addUnlawfulRecord($_Account, $_UserID, $_UserType, $_Content)
    {
        $_db = new DB(DB_HOST_M, DB_USER_M, DB_PASSWD_M, DB_NAME);
        $_Content = str_replace("'", "", $_Content);
        $addr = getIP();
        $data = array(
            'Account' => $_Account,
            'UserID' => $_UserID,
            'UserType' => $_UserType,
            'RemoteAddr' => $addr['REMOTE_ADDR'],
            'Content' => $_Content,
            'PName' => $_SERVER['PHP_SELF'],
            'HOST' => $_SERVER['HTTP_HOST']
        );
        $qstr = SQL_INSERT('UnlawfulRecord', $data);
        if ($_db == "") {
            return $qstr;
        } else {
            $_db->query($qstr);
        }
    }


    static public function Behavior_Record($_Behavior_id, $_UserID, $_Account, $_db = "")
    {
        global $auth_obj;
        if (empty($_db)) {
            global $db_host_arr, $db_user_arr, $db_passwd_arr, $db_name_arr;
            $_db = new StockDB($db_host_arr[WEB_CODE]['RM'], $db_user_arr[WEB_CODE]['RM'], $db_passwd_arr[WEB_CODE]['RM'], $db_name_arr[WEB_CODE]['RM']);
        }
        $addr = getIP();
        $data = array(
            'BehaviorID' => $_Behavior_id,
            'UserID' => $_UserID,
            'Account' => $_Account
        );
        $qstr = SQL_INSERT('BehaviorRecord', $data);
        if ($_db == "") {
            return $qstr;
        } else {
            $_db->query($qstr);
        }
    }


    static public function show_message($tpl, $tpl_dir, $msg)
    {
        echo '<pre>';
        echo 'ERROR!' . '<br>';
        echo $msg;
        echo '</pre>';
    }


//網頁壓縮
    static public function DoCompress()
    {
        //檢查瀏覽器是否支援gzip壓縮格式
        if (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false) {
            //取出緩衝區裡的資料
            $gzip_contents = ob_get_contents();
            //清空緩衝區
            ob_end_clean();
            //將緩衝區的回傳資料使用gzip壓縮
            $gzip_contents = gzencode($gzip_contents, 9);
            //回應瀏覽器資料壓縮格式是使用gzip

            header('Content-Encoding: gzip');
            //輸出壓縮後的資料

            echo $gzip_contents;
        }
    }

    static public function mouse_right_key($show)
    {
        if ($show == '0') {
            //echo "<SCRIPT Language=\"javascript\">document.oncontextmenu=function(){return false;}</SCRIPT>";
        }
    }


    static public function ob_gzip($content)
    {
        if (!headers_sent() &&
            extension_loaded("zlib") &&
            strstr($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip")) {
            $content = gzencode($content . "", 9);

            header("Content-Encoding: gzip");
            header("Vary: Accept-Encoding");
            header("Content-Length: " . strlen($content));
        }
        return $content;
    }

//階層函式
    static public function Factorial($n)
    {
        if ($n == 1 || $n == 0) {
            return 1;
        } else {
            return $n * Factorial($n - 1);
        }
    }

    static public function C($n, $c)
    {
        $x = 1;
        for ($i = 0; $i < $c; $i++) {
            $x = ($n - $i) * $x;
        }
        return $x / Factorial($c);
    }

    static public function XmlErrorMsg($_ErrorMessage)
    {
        header("Content-type: application/xml");
        echo "<?xml version='1.0' encoding='utf-8'?>\n";
        echo "<data>\n";
        echo "<error_tag>true</error_tag>";
        echo "<error_msg>{$_ErrorMessage}</error_msg>";
        echo "</data>\n";
        exit();
    }

    static public function WriteMonitor($db)
    {
        $SCRIPT_FILENAME = $_SERVER['SCRIPT_FILENAME'];
        $qstr = "SELECT COUNT(*) AS C FROM Monitor WHERE HOSTNAME='{$_SERVER['HOSTNAME']}' AND SCRIPT_FILENAME='{$SCRIPT_FILENAME}'";
        $db->query($qstr, 1);
        if ($db->f('C') == 0) {
            $qstr = "INSERT INTO Monitor SET HOSTNAME='{$_SERVER['HOSTNAME']}',SCRIPT_FILENAME='{$SCRIPT_FILENAME}',StartTime=SYSDATE(),MemLimit='" . ini_get('memory_limit') . "'";
        } else {
            $membytes = memory_get_usage();
            if ($membytes < 0) {
                $membytes = PHP_INT_MAX + ($membytes - ~PHP_INT_MAX);
            }
            $qstr = "UPDATE Monitor SET UPTime=SYSDATE(),MemLimit='" . ini_get('memory_limit') . "',MemUsage='" . number_format($membytes / (1024 * 1024)) . "M' WHERE HOSTNAME='{$_SERVER['HOSTNAME']}' AND SCRIPT_FILENAME='{$SCRIPT_FILENAME}'";
        }
        $db->query($qstr);
        $db->close();
    }

    static public function WriteStratTime($db)
    {
        $SCRIPT_FILENAME = $_SERVER['SCRIPT_FILENAME'];
        $qstr = "SELECT COUNT(*) AS C FROM Monitor WHERE HOSTNAME='{$_SERVER['HOSTNAME']}' AND SCRIPT_FILENAME='{$SCRIPT_FILENAME}'";
        $db->query($qstr, 1);
        if ($db->f('C') != 0) {
            $qstr = "UPDATE Monitor SET StartTime=SYSDATE() WHERE HOSTNAME='{$_SERVER['HOSTNAME']}' AND SCRIPT_FILENAME='{$SCRIPT_FILENAME}'";
        }
        $db->query($qstr);
        $db->close();
    }

    static public function WriteMemCacheTime($_memcacheTime, $db)
    {
        $SCRIPT_FILENAME = $_SERVER['SCRIPT_FILENAME'];
        $qstr = "SELECT COUNT(*) AS C FROM Monitor WHERE HOSTNAME='{$_SERVER['HOSTNAME']}' AND SCRIPT_FILENAME='{$SCRIPT_FILENAME}'";
        $db->query($qstr, 1);
        if ($db->f('C') != 0) {
            $qstr = "UPDATE Monitor SET MemCTime='" . $_memcacheTime . "' WHERE HOSTNAME='{$_SERVER['HOSTNAME']}' AND SCRIPT_FILENAME='{$SCRIPT_FILENAME}'";
        }
        $db->query($qstr);
        $db->close();
    }

    static public function WriteErrorRecord($_db, $_UserID, $_ErrorMessage, $_NewTime)
    {
        $data = array(
            'UserID' => $_UserID,
            'Message' => strip_tags($_ErrorMessage),
            'NewTime' => $_NewTime
        );
        $qstr = SQL_INSERT('ErrorRecord', $data);
        $_db->query($qstr);
        $_db->close();
    }

    static public function WriteLimitMonitor($_db, $_GameID, $_ErrorMessage, $_NewTime)
    {
        $data = array(
            'GameID' => $_GameID,
            'Message' => $_ErrorMessage,
            'Monitor' => 'Y',
            'NewTime' => $_NewTime
        );
        $qstr = SQL_INSERT('LimitMonitor', $data);
        $_db->query($qstr);
        $_db->close();
    }

    static public function do_round($_Value, $_Precision = 0)
    {
        $tmpval = 0;
        $tmpval = round($_Value * pow(10, $_Precision + 3), 0);
        $tmpval = round($tmpval, 0) / 10;
        $tmpval = round($tmpval, 0) / 10;
        $tmpval = round($tmpval, 0) / 10;
        $tmpval = round($tmpval, 0) / pow(10, $_Precision);
        return $tmpval;
    }

    static public function three_sec_load_once()
    {
        if (isset($_SESSION["order_loadtime"]) && ((strtotime(NOW_TIME) - strtotime($_SESSION["order_loadtime"])) <= 3)) {
            js_color_msg("查询过于频繁，请稍后查询!!");
            exit();
        } else {
            $_SESSION["order_loadtime"] = NOW_TIME;
        }
    }

    static public function three_sec_load_once_sport()
    {
        if (isset($_SESSION["order_loadtime_sport"]) && ((strtotime(NOW_TIME) - strtotime($_SESSION["order_loadtime_sport"])) <= 3)) {
            js_color_msg("查询过于频繁，请稍后查询!!");
            exit();
        } else {
            $_SESSION["order_loadtime_sport"] = NOW_TIME;
        }
    }

    static public function js_color_msg($_value, $_meta = 'utf-8')
    {
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$_meta\">";
        echo "<script language=\"javascript\" src=\"/js/jquery.3.1.1.min.js\"></script>
        <link href=\"/bootstrap/css/bootstrap.css?ver=1221\" rel=\"stylesheet\" type=\"text/css\">
        <script language=\"javascript\" src=\"/bootstrap/js/bootstrap.min.js\"></script>";

        echo "
	<div class=\"modal fade\" id=\"myModal\" role=\"dialog\" style='color:black;'>
    <div class=\"modal-dialog\">    
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
          <h4 class=\"modal-title\">警告</h4>
        </div>
        <div class=\"modal-body\">{$_value}<span id='time_div' style='color:#ff0000;'></span>秒后自动重整</div>       
        <div class=\"modal-footer\">
          <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">关闭</button>
        </div>
      </div>      
    </div>
  </div>	";
        echo "<script>\n";
        echo "var count_down=10;\n";
        echo "static public function myTimer(){
	count_down--;\n
	if(count_down > 0){
		document.getElementById('time_div').innerHTML=count_down;
	}
	if(count_down <= 0){
		count_down=10;\n
		self.location.reload();\n
		return;\n
	}
	window.setTimeout(\"myTimer()\", 1000);
	}\n";
        echo "myTimer();\n";
        echo "$(\"#myModal\").modal();";
        echo "</script>\n";
    }

    /**
     * * 用在Slave連線
     *
     * @param $_DBArr
     * @return DB的host ip
     */
    static public function DBLoadBalance($_DBArr)
    {
        $dbnums = count($_DBArr);
        if ($dbnums == 1) {
            $dbhost = $_DBArr[0];
            return $dbhost;
        }
        $dbid = array_rand($_DBArr);
        $dbhost = $_DBArr[$dbid];
        return $dbhost;
    }

    /**
     * * 檢查小數位數
     *
     */
    static public function Pub_CheckFloatLength($_Value, $_Precision = 0)
    {
        $str_arr = explode(".", (float)$_Value);
        if (count($str_arr) > 2 || strlen($str_arr[1]) > $_Precision) {
            return false;
        }
        return true;
    }

    /**
     * * 生成IP資訊
     *
     */
    static public function Creat_IPAccessDeny($_DB)
    {
        global $ip_memcache_server;
        $MemCacheObj = new MemcachedAggregator($ip_memcache_server);

        $today = getdate();
        $web_time_zone = 8;//美東時間換算
        $beforeten = gmdate("Y-m-d H:i:s", mktime($today['hours'] + $web_time_zone, $today['minutes'] - 10, $today['seconds'], $today['mon'], $today['mday'], $today['year']));

        //取資料
        $qry_str = "SELECT IP1,IP2,NetOrg,IPTag,NewTime FROM IPAccessDeny WHERE IPTag=0 || (IPTag=1 AND NewTime>'" . $beforeten . "') ORDER BY IP1,IP2,NewTIme";
        $_DB->query($qry_str);//echo $qry_str;
        $d = 0;
        $p = 0;
        while ($_DB->next_record()) {
            $r = $_DB->record;
            if ($r['IPTag'] == "1") {
                $_IPArr["Err"][$r['IP1']] = $r['IP1'];
                $_IPArr["ErrTime"][$r['IP1']] = $r['NewTime'];
            } elseif ($r['IPTag'] == "2") {
                $_IPArr["Err2"][$r['IP1']] = $r['IP1'];
                $_IPArr["ErrTime"][$r['IP1']] = $r['NewTime'];
            } elseif ($r['NetOrg'] == "Passable") {
                $_IPArr["Pass"][$p]['S'] = $r['IP1'];
                $_IPArr["Pass"][$p]['E'] = $r['IP2'];
                $p++;
            } else {
                $_IPArr["Deny"][$d]['S'] = $r['IP1'];
                $_IPArr["Deny"][$d]['E'] = $r['IP2'];
                $d++;
            }
        }

        if (!isset($_IPArr) || count($_IPArr) == 0) {
            $Msg = "IP資料錯誤";
            return $Msg;
        }

        $MemCacheObj->set("IPAccess", $_IPArr);
        return true;
    }

    /**
     * * 更新IP資訊
     *
     */
    static public function UPDATE_IPAccessDeny($_IP, $_Time, $_Err = "")
    {
        global $ip_memcache_server;
        require(STOCK_LIB_PATH . "/class_memcache.php");
        $MemCacheObj = new MemcachedAggregator($ip_memcache_server);
        $_IPArr = $MemCacheObj->get('IPAccess');
        $_IPArr["Err" . $_Err][$_IP] = $_IP;
        $_IPArr["ErrTime"][$_IP] = $_Time;
        $MemCacheObj->set("IPAccess", $_IPArr);
    }

    /**
     * PHP stdClass Object转array
     * @param $array
     * @return array
     */
    static public function object_array($array)
    {
        if (is_object($array)) {
            $array = (array)$array;
        }
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $array[$key] = object_array($value);
            }
        }
        return $array;
    }

    static public function getBrowser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser = 'Unknown';
        $version = "";

        if (preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent)) {
            $browser = 'IE';
            $pattern = "MSIE";
        } elseif (preg_match('/Firefox/i', $user_agent)) {
            $browser = 'Firefox';
            $pattern = "Firefox";
        } elseif (preg_match('/Edge/i', $user_agent)) {
            $browser = 'Edge';
            $pattern = "Edge";
        } elseif (preg_match('/Chrome/i', $user_agent)) {
            $browser = 'Chrome';
            $pattern = "Chrome";
        } elseif (preg_match('/Safari/i', $user_agent)) {
            $browser = 'Safari';
            $pattern = "Safari";
        } elseif (preg_match('/Opera/i', $user_agent)) {
            $browser = 'Opera';
            $pattern = "Opera";
        } elseif (preg_match('/Netscape/i', $user_agent)) {
            $browser = 'Netscape';
            $pattern = "Netscape";
        }


        if (preg_match("#($pattern)[/ ]?([0-9.]*)#", $user_agent, $match)) {
            $version = $match[2];
        }

        return array(
            'userAgent' => $user_agent,
            'browser' => $browser,
            'version' => $version,
        );
    }

    static public function xml2array($xmlObject, $out = array())
    {
        foreach ((array)$xmlObject as $index => $node)
            $out[$index] = (is_object($node)) ? xml2array($node) : $node;

        return $out;
    }

    /*
     *將字串部分內容替換成星號或其他符號
     * @param string $string 原始字串
     * @param string $symbol 替換的符號
     * @param int $begin_num 顯示開頭幾個字元
     * @param int $end_num 顯示結尾幾個字元
     * return string
     */
    static public function replace_symbol_text($string, $symbol, $begin_num = 0, $end_num = 0)
    {
        $string_length = strlen($string);
        $begin_num = (int)$begin_num;
        $end_num = (int)$end_num;
        $string_middle = '';
        $check_reduce_num = $begin_num + $end_num;
        if ($check_reduce_num >= $string_length) {
            for ($i = 0; $i < $string_length; $i++) {
                $string_middle .= $symbol;
            }
            return $string_middle;
        }
        $symbol_num = $string_length - ($begin_num + $end_num);
        $string_begin = substr($string, 0, $begin_num);
        $string_end = substr($string, $string_length - $end_num);
        for ($i = 0; $i < $symbol_num; $i++) {
            $string_middle .= $symbol;
        }
        return $string_begin . $string_middle . $string_end;
    }

    /*
     *將字串部分內容替換成星號或其他符號，固定隱藏前四碼
     * @param string $string 原始字串
     * @param string $symbol 替換的符號
     * @param int $begin_num 顯示開頭幾個字元
     * @param int $end_num 顯示結尾幾個字元
     * return string
     */
    static public function replace_symbol_text_regular($string, $symbol, $begin_num = 0, $end_num = 0)
    {
        $string_length = strlen($string);
        $begin_num = (int)$begin_num;
        $end_num = (int)$end_num;
        $string_middle = '';
        $check_reduce_num = $begin_num + $end_num;
        if ($check_reduce_num >= $string_length) {
            for ($i = 0; $i < $string_length; $i++) {
                $string_middle .= $symbol;
            }
            return $string_middle;
        }
        $symbol_num = 4;
        $string_begin = substr($string, 0, $begin_num);
        $string_end = substr($string, 4);
        for ($i = 0; $i < $symbol_num; $i++) {
            $string_middle .= $symbol;
        }
        return $string_begin . $string_middle . $string_end;
    }

    static public function trimzero($str)
    {
        list($int, $dec) = explode('.', (string)$str); //拆解字串,格式為: 整數.小數
        $dec = rtrim($dec, '0'); //將小數點 右邊的0去除
        if (empty($dec)) return trim($int . $dec);
        return trim($int . '.' . $dec); //重組格式
    }

    static public function ip2long_v4v6($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false)
            return ip2long($ip);
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false)
            return false;

        $ip_n = inet_pton($ip);
        $bin = '';
        for ($bit = strlen($ip_n) - 1; $bit >= 0; $bit--) {
            $bin = sprintf('%08b', ord($ip_n[$bit])) . $bin;
        }

        if (function_exists('gmp_init')) {
            return gmp_strval(gmp_init($bin, 2), 10);
        } elseif (function_exists('bcadd')) {
            $dec = '0';
            for ($i = 0; $i < strlen($bin); $i++) {
                $dec = bcmul($dec, '2', 0);
                $dec = bcadd($dec, $bin[$i], 0);
            }
            return $dec;
        } else {
            trigger_error('GMP or BCMATH extension not installed!', E_USER_ERROR);
        }
    }

    static public function long2ip_v4v6($dec)
    {

        if (strlen($dec) <= 10) return long2ip((int)$dec);// ipv4

        if (function_exists('gmp_init')) {
            $bin = gmp_strval(gmp_init($dec, 10), 2);
        } elseif (function_exists('bcadd')) {
            $bin = '';
            do {
                $bin = bcmod($dec, '2') . $bin;
                $dec = bcdiv($dec, '2', 0);
            } while (bccomp($dec, '0'));
        } else {
            trigger_error('GMP or BCMATH extension not installed!', E_USER_ERROR);
        }

        $bin = str_pad($bin, 128, '0', STR_PAD_LEFT);
        $ip = array();
        for ($bit = 0; $bit <= 7; $bit++) {
            $bin_part = substr($bin, $bit * 16, 16);
            $ip[] = dechex(bindec($bin_part));
        }
        $ip = implode(':', $ip);
        return inet_ntop(inet_pton($ip));
    }

    /*判断函数*/
    static public function isDate($dateString)
    {
        return strtotime(date('Y-m-d', strtotime($dateString))) === strtotime($dateString);
        /*date函数会给月和日补零，所以最终用unix时间戳来校验*/
    }

    /**
     * 密碼明碼加密
     */
    static public function PasswordEncode($_pwd)
    {
        return strrev(base64_encode($_pwd));
    }

    /**
     * 密碼暗碼解密
     */
    static public function PasswordDDecode($_pwd)
    {
        return base64_decode(strrev($_pwd));
    }

    static public function getDeviceType()
    {
        //Detect special conditions devices
        $iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
        $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
        $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
        if (stripos($_SERVER['HTTP_USER_AGENT'], "Android") && stripos($_SERVER['HTTP_USER_AGENT'], "mobile")) {
            $Android = true;
        } else if (stripos($_SERVER['HTTP_USER_AGENT'], "Android")) {
            $Android = false;
            $AndroidTablet = true;
        } else {
            $Android = false;
            $AndroidTablet = false;
        }
        $webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");
        $BlackBerry = stripos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
        $RimTablet = stripos($_SERVER['HTTP_USER_AGENT'], "RIM Tablet");
//do something with this information
        if ($iPod || $iPhone) {
            return "iPhone";
        } else if ($iPad) {
            return "iPad";
        } else if ($Android) {
            return "Android Phone";
        } else if ($AndroidTablet) {
            return "AndroidTablet";
        } else if ($webOS) {
            //we're a webOS device -- do something here
            return "webOS";
        } else if ($BlackBerry) {
            return "BlackBerryPhone";
            //we're a BlackBerry phone -- do something here
        } else if ($RimTablet) {
            return "BlackBerry";
        } else {
            return "PC";
        }
    }

    //uuid生成方法（可以指定前缀）
    static public function create_uuid($prefix = "")
    {
        $str = md5(uniqid(mt_rand(), true));
        $uuid = substr($str, 0, 8) . '-';
        $uuid .= substr($str, 8, 4) . '-';
        $uuid .= substr($str, 12, 4) . '-';
        $uuid .= substr($str, 16, 4) . '-';
        $uuid .= substr($str, 20, 12);
        return $prefix . $uuid;
    }
    //shop_id
    static public function sql_id_create($prefix = "")
    {
        $str = md5(uniqid(mt_rand(), true));

        $uuid = substr($str, 0, 10) ;
//        $uuid .= substr($str, 8, 4) ;
//        $uuid .= substr($str, 12, 4) ;
//        $uuid .= substr($str, 16, 4) ;
//        $uuid .= substr($str, 20, 12);
        return $prefix .time(). $uuid;
    }

    static public function set_var($var, $type, $multibyte = false)
    {
        settype($var, $type);
        $result = $var;

        if ($type == 'string') {
            $result = trim(htmlspecialchars(str_replace(array("\r\n", "\r", "\0"), array("\n", "\n", ''), $result), ENT_COMPAT, 'UTF-8'));
            if (!empty($result)) {
                // Make sure multibyte characters are wellformed
                if ($multibyte) {
                    if (!preg_match('/^./u', $result)) {
                        $result = '';
                    }
                } else {
                    // no multibyte, allow only ASCII (0-127)
                    //s$result = preg_replace('/[\x80-\xFF]/', '?', $result);
                }
            }

            $result = stripslashes($result);
        }
        return $result;
    }

    static public function preg_array_key_exists($pattern, $array)
    {
        $keys = array_keys($array);
        return preg_grep($pattern, $keys);
    }

    static public function checkDateTime($date_time)
    {
        $check = false;

        if (strtotime($date_time)) {
            //不管檢查時間或日期格式，都只取第一個陣列值
            list($first) = explode(" ", $date_time);
            //如果包含「:」符號，表示只檢查時間
            if (strpos($first, ":")) {
                //strtotime函數已經檢查過，直接給true
                $check = true;
            } else {
                //將日期分年、月、日，區隔符用「-/」都適用
                list($y, $m, $d) = preg_split("/[-\/]/", $first);
                //檢查是否為4碼的西元年及日期邏輯(潤年、潤月、潤日）
                if (substr($date_time, 0, 4) == $y && checkdate($m, $d, $y)) {
                    $check = true;
                }
            }
        }
        return $check;
    }

    //Bearer Token 用
    static function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
    //Bearer Token 用
    static function getBearerToken() {
        $headers = PubFunction::getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
    //
    static public function getIPAddr(){
        //抓IP
        if ($_SERVER["HTTP_CLIENT_IP"]) {
            $_IP = $_SERVER["HTTP_CLIENT_IP"];
        } elseif ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
            $ip_cfg = $_SERVER["HTTP_X_FORWARDED_FOR"];
            $ip_cfg_ary = explode(',', $ip_cfg, 2);
            $_IP = $ip_cfg_ary[0];
        } else {
            $_IP = $_SERVER["REMOTE_ADDR"];
        }
        return $_IP;
    }
    //處理浮點數(字串處理)，去除小數尾巴0
    static public function float_kick_tail_0($number){
        if(strpos($number,'.')!==false)
            $number =  preg_replace('/0*$/','',$number);
        return $number;
    }
    //上傳圖片
    static public function ImageFileMethod($myArray,$ImageDir)
    {
        $file_type_array = [1 => 'GIF', 2 => 'JPG', 3 => 'PNG', 4 => 'SWF', 5 => 'PSD', 6 => 'BMP', 7 => 'TIFF', 8 => 'TIFF', 9 => 'JPC', 10 => 'JP2', 11 => 'JPX', 12 => 'JB2', 13 => 'SWC', 14 => 'IFF', 15 => 'WBMP', 16 => 'XBM',];

        $tmpFile = tempnam($ImageDir, "TMP0");

        $image = arrayToBinaryString($myArray);

        file_put_contents($tmpFile, $image);

        $imageData = getimagesize($tmpFile);
        $filedir = pathinfo($tmpFile)['dirname'] . "\\";
        $filename = pathinfo($tmpFile)['filename'];

        rename($tmpFile, $filedir . $filename . '.' . $file_type_array[$imageData[2]]);

        $percent = 1;
        $cmp_image = (new imgcompress($filedir . $filename . '.' . $file_type_array[$imageData[2]], 1))->compressImg($filedir . $filename . '.' . $file_type_array[$imageData[2]]);

        return $ImageDir . $filename . '.' . $file_type_array[$imageData[2]] ;

    }
    //上傳圖片
    static public function arrayToBinaryString(array $arr)
    {
        $str = "";
        foreach ($arr as $elm) {
            $str .= chr((int)$elm);
        }
        return $str;
    }
    //Image轉成Base64
    static public function Image_to_Base64($_Path){
        $type = pathinfo($_Path, PATHINFO_EXTENSION);
        $data = file_get_contents($_Path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
    //Base64轉成Image
    static public function Base64_to_Image($_Base64String,$_Path){
        list($type, $data) = explode(';', $_Base64String);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        file_put_contents($_Path, $data);
        chmod($_Path, 0664);
        return true;
    }
    //Base64圖片類型
    static public function What_Is_Base64Image_Type($_Base64String){
        if(strpos($_Base64String,'jpg') !== false){
            return "jpg";
        }elseif(strpos($_Base64String,'jpeg') !== false){
            return "jpg";
        }elseif(strpos($_Base64String,'png') !== false){
            return "png";
        }elseif(strpos($_Base64String,'gif') !== false){
            return "gif";
        }else{
            return "jpg";
        }

    }
    //上傳圖片工具
    static public function Base64_UploadFile($_Base64String,$PreFIlename=""){
        $ImageType = PubFunction::What_Is_Base64Image_Type($_Base64String);
        $FilePath = URL_PATH.$PreFIlename.time().rand(0,100000000).".".$ImageType;//檔案路徑
        $HostImagePath = SITE_PATH."/portal".$FilePath;//本機儲存位置
        $rs = PubFunction::Base64_to_Image($_Base64String,$HostImagePath);
        if($rs){
            return $FilePath;
        }else{
            return false;
        }
    }

}