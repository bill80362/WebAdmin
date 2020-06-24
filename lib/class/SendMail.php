<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/5/5
 * Time: 下午 12:09
 */

class SendMail
{
    protected $GmailUsername;
    protected $GmailPassword;

    protected $SendFromMail;
    protected $SendFromName;

    public function __construct(){
        //SMTP
        $this->GmailUsername = GMAIL_USERNAME;//SMTP伺服器 Gmail帳號
        $this->GmailPassword = GMAIL_PASSWD;//SMTP伺服器 Gmail密碼
        //寄件人
        $this->SendFromMail = $this->GmailUsername;//寄件人郵件
        $this->SendFromName = GMAIL_MAILFromName;//寄件人名稱

    }
    //使用GMAIL需要開啟該帳戶權限:https://myaccount.google.com/ > 安全性 > 低安全性應用程式存取權 > 開啟
    public function sendMail($SendToMail,$Title,$Body){
        try {
            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername($this->GmailUsername)
                ->setPassword($this->GmailPassword);
            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);
            // Create a message
            $message = (new Swift_Message($Title))
                ->setFrom([$this->SendFromMail => $this->SendFromName])
                ->setTo([$SendToMail])
                ->setBody($Body)
                ->setContentType('text/html');
            // Send the message
            $mailer->send($message);
        }catch (Exception $e){
            ResData::failException($e);
        }
    }

    public function sendMailTpl1($Data){

        $MailBody = "";
        $MailBody .= $Data["Name"]."先生您好，感謝您此次的訂購，單號為:".$Data["ShopID"]."<BR>";
        $MailBody .= "【基本資料】<BR>";
        $MailBody .= "收件人: ".$Data["Name"]."<BR>";
        $MailBody .= "Email: ".$Data["Email"]."<BR>";
        $MailBody .= "手機: ".$Data["Phone"]."<BR>";
        $MailBody .= "地址: ".$Data["Address"]."<BR>";
        $MailBody .= "備註: ".$Data["CustomerRemark"]."<BR>";
        $MailBody .= "【訂單內容】<BR>";
        $MailBody .= "交易金額: ".$Data["DiscountTotal"]."<BR>";
        $MailBody .= "交易方式: ".Shop::$Payment[$Data["Payment"]]."<BR>";
        if( $Data["Payment"]=="ATM" ){
            $MailBody .= "匯款帳號: ".$Data["ECData"]."<BR>";
        }elseif ( $Data["Payment"]=="CREDIT"){

        }elseif( $Data["Payment"]=="CVS" ){
            $MailBody .= "超商資訊: ".$Data["ECData"]."<BR>";
        }elseif( $Data["Payment"]=="COD" ){

        }
        //是否免運
        if($Data["ShippingFeeFree"]!="Y"){
            $MailBody .= "運費: ".$Data["ShippingFee"]."<BR>";
        }
        $MailBody .= "【商品明細】<BR>";
        $oShopProduct = new ShopProduct();
        $ShopProductList = $oShopProduct->getList("ShopID='".$Data["ShopID"]."' ");
        foreach ( (array)$ShopProductList as $key=>$value ){
            $MailBody .= "商品名稱:".$value["Title"]."_數量:".$value["Count"]."_單價:".$value["Price"]."<BR>";
        }

        if(isset($Data["ECRtnCode"])){
            $MailBody .= "【訂單狀態回報】<BR>";
            $MailBody .= $Data["ECRtnCode"]."_".$Data["ECRtnMsg"]."<BR>";
        }else{
            $MailBody .= "【訂單建立成功】<BR>";
        }

        $this->sendMail($Data["Email"],"【".$Data["Name"]."先生您好】您的訂購單(".$Data["ShopID"].")建立成功",$MailBody);
    }

    //測試送信
    public function ContactUs($Data){
        $MailBody = "";
        $MailBody .= "姓名: ".$Data["Name"]."<BR>";
        $MailBody .= "Email: ".$Data["Email"]."<BR>";
        $MailBody .= "電話: ".$Data["Phone"]."<BR>";
        $MailBody .= "問題類型: ".$Data["Type"]."<BR>";
        $MailBody .= "內容: ".$Data["Content"]."<BR>";
        $this->sendMail($this->SendFromMail,"tightpac聯絡我們表單留言",$MailBody);
    }
}