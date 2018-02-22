<?php
//本文件携带账号密码供PHP发送邮件学习使用，请勿私自更改，谢谢！--by Zjmainstay(http://zjmainstay.cn)
require("class.phpmailer.php"); //下载的文件必须放在该文件所在目录
$mail = new PHPMailer(); //建立邮件发送类											//QQ用法
$mail->IsSMTP(); // 使用SMTP方式发送												//特别提示：QQ需要在“QQ邮箱”->“设置”->“账户”->“POP3/IMAP/SMTP/Exchange服务”->开启“POP3/SMTP服务”
$mail->Host = "smtp.sina.cn"; // 您的企业邮箱域名									//smtp.qq.com
$mail->SMTPAuth = true; // 启用SMTP验证功能	
$mail->Username = "smtptester@sina.cn"; // 邮箱用户名(请填写完整的email地址)		//QQ号码@qq.com
$mail->Password = "test123456"; // 邮箱密码											//QQ密码
$mail->Port=25;	
$mail->From = "smtptester@sina.cn"; //邮件发送者email地址							//QQ号码@qq.com
$mail->FromName = "smtptester";														//显示的名字，可以随意定义
$toAddress ="951086941@qq.com";														//发送到的邮件地址
$mail->AddAddress("$toAddress", "Zjmainstay");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//$mail->AddReplyTo("", "");

$attachFile1 = './attach/en_name.txt';                              //附件测试文件1
$attachFile2 = iconv('utf-8', 'gb2312', './attach/中文名.txt');     //附件测试文件2，中文文件名要转码（GB2312编码）才能访问
$mail->AddAttachment($attachFile1, 'en_name.txt');                  // 添加附件1
$mail->AddAttachment($attachFile2, '中文名.txt');                   // 添加附件2，后一个参数是显示在邮件中的附件名（UTF-8编码）
//$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式

$fromIp         = getServerIp();
$mail->Subject  = "PHPMailer测试邮件【来自{$fromIp}】"; //邮件标题
$bodyTpl        = "Hello,这是测试邮件。";

/*
 * 重要提示
 * 这里会连带发送当前文件内容
 */
// $bodyTpl        = "Hello,这是测试邮件，文件内容为：<br /><br />%s";
//$bodyTpl        = sprintf($bodyTpl, highlight_file(__FILE__, true)); //邮件内容
 
$mail->Body = $bodyTpl;
$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略

header("Content-type: text/html; charset=utf-8"); 
if(!$mail->Send())
{
echo "邮件发送失败. <p>";
echo "错误原因: " . $mail->ErrorInfo;
exit;
}

echo "邮件发送成功";


function getServerIp($onlyIp=false) {
    if(function_exists('ini_set')) ini_set('default_socket_timeout', 3);
    $ipCheckContent = iconv('gb2312', 'utf-8', file_get_contents('http://iframe.ip138.com/ic.asp'));
    $pattern        = '#\[(.*?)\].*：([^<]*)#is';
    if(preg_match($pattern, $ipCheckContent, $match)) {
        if($onlyIp) return $match[1];
        else return sprintf('%s[%s]', $match[1], $match[2]);
    } else {
        return getenv('REMOTE_ADDR');
    }
}

/*************************************************

附件：
phpmailer 中文使用说明（简易版）
A开头：
$AltBody--属性
出自：PHPMailer::$AltBody
文件：class.phpmailer.php
说明：该属性的设置是在邮件正文不支持HTML的备用显示
AddAddress--方法
出自：PHPMailer::AddAddress()，文件：class.phpmailer.php
说明：增加收件人。参数1为收件人邮箱，参数2为收件人称呼。例 AddAddress("eb163@eb163.com","eb163")，但参数2可选，AddAddress(eb163@eb163.com)也是可以的。
函数原型：public function AddAddress($address, $name = '') {}
AddAttachment--方法
出自：PHPMailer::AddAttachment()
文件：class.phpmailer.php。
说明：增加附件。
参数：路径，名称，编码，类型。其中，路径为必选，其他为可选
函数原型：
AddAttachment($path, $name = '', $encoding = 'base64', $type = 'application/octet-stream'){}
AddBCC--方法
出自：PHPMailer::AddBCC()
文件：class.phpmailer.php
说明：增加一个密送。抄送和密送的区别请看[SMTP发件中的密送和抄送的区别] 。
参数1为地址，参数2为名称。注意此方法只支持在win32下使用SMTP，不支持mail函数
函数原型：public function AddBCC($address, $name = ''){}
AddCC --方法
出自：PHPMailer::AddCC()
文件：class.phpmailer.php
说明：增加一个抄送。抄送和密送的区别请看[SMTP发件中的密送和抄送的区别] 。
参数1为地址，参数2为名称注意此方法只支持在win32下使用SMTP，不支持mail函数
函数原型：public function AddCC($address, $name = '') {}
AddCustomHeader--方法
出自：PHPMailer::AddCustomHeader()
文件：class.phpmailer.php
说明：增加一个自定义的E-mail头部。
参数为头部信息
函数原型：public function AddCustomHeader($custom_header){}
AddEmbeddedImage --方法
出自：PHPMailer::AddEmbeddedImage()
文件：class.phpmailer.php
说明：增加一个嵌入式图片
参数：路径,返回句柄[,名称,编码,类型]
函数原型：public function AddEmbeddedImage($path, $cid, $name = '', $encoding = 'base64', $type = 'application/octet-stream') {}
提示：AddEmbeddedImage(PICTURE_PATH. "index_01.jpg ", "img_01 ", "index_01.jpg ");
在html中引用
AddReplyTo--方法
出自：PHPMailer:: AddRepl
*************************************************/
?>
