<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PHPMailSending
 *
 * @author krisada.thiangtham
 */
include '../com.qrc.mgr.mail.lib/class.phpmailer.php';
include '../com.qrc.mgr.mail.lib/class.pop3.php';
include '../com.qrc.mgr.mail.lib/class.smtp.php';

class PHPMailSending {

    //put your code here
    public function sendingMail($mailUsrename, $password, $mailFrom, $toEmail, $toEmailName) {
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->IsSMTP();
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->Port = 465; // set the SMTP port for the GMAIL server
        $mail->Username = $mailUsrename; // GMAIL username
        $mail->Password = $password; // GMAIL password
        $mail->From = $mailFrom; // "name@yourdomain.com";
        //$mail->AddReplyTo = "support@thaicreate.com"; // Reply
        $mail->FromName = "บริษัท ควอลิตี้ รูฟ แอนด์ คอนสตรัคชั่น จำกัด";  // set from Name
        $mail->Subject = "Test sending mail.";
        $mail->Body = "My Body & <b>My Description</b>";

        $mail->AddAddress($toEmail, $toEmailName); // to Address
//        $mail->AddAttachment("thaicreate/myfile.zip");
//        $mail->AddAttachment("thaicreate/myfile2.zip");
        //$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
        //$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC

        $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

        if ($mail->Send()) {
            return 200;
        } else {
            return "505: Error Sending Email";
        }
    }

}
