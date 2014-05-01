<?php
require_once 'lib/swift_required.php';
//
//POST FIELDS
$POST_FIELD_NAME        = "name";
$POST_FIELD_EMAIL       = "email";
////POST VARS
$name                   = $_POST[$POST_FIELD_NAME];
$email                  = $_POST[$POST_FIELD_EMAIL];
//- Configuration --------------------------------
$SMTP_USER              = 'javi@quadramma.com';         //IMPORTANT
$SMTP_PASS              = "";                           //IMPORTANT
$SMTP                   = "smtp.gmail.com";             //IMPORTANT
$SMTP_PORT              = 465;                          //IMPORTANT
$SMTP_SECURITY               = "ssl"; // ssl or null    //IMPORTANT
$SUCCESS_MSG            = "E-mail sended";
$FAILED_MSG             = "E-mail failed. Retry later";
//VALIDATIONS
$NAME_REQUIRED          = "Name required";
$EMAIL_REQUIRED         = "E-mail required";
//MESSAGE
$MSG_TITLE              = 'Colpermin pdf shared by ' . $name;
$MSG_FROM               = 'web@colpermin.com';
$MSG_FROM_NICK          = 'Colpermin';
$MSG_TO                 = $email;                       //IMPORTANT
$MSG_BODY               =  $name . ' share a pdf from Colpermin with you';
$MSG_ATTACH_FILE_PATH   = '../colpermin.pdf';
//--------------------------------------
//--------------------------------------
//--------------------------------------

//--------------------------------------
//--------------------------------------
//--------------------------------------
$rta = 0;
if (empty($name)) {
  $rta = $NAME_REQUIRED;
}else{
    if (empty($email)) {
      $rta = $EMAIL_REQUIRED;
    } else{
        $rta = sendMail();
    }
}
echo($rta);


function sendMail(){
    $transport = Swift_SmtpTransport::newInstance($GLOBALS["SMTP"], $GLOBALS["SMTP_PORT"], $GLOBALS["SMTP_SECURITY"])
      ->setUsername($GLOBALS["SMTP_USER"])
      ->setPassword($GLOBALS["SMTP_PASS"]);
    $mailer = Swift_Mailer::newInstance($transport);
    $message = Swift_Message::newInstance($GLOBALS["MSG_TITLE"])
      ->setFrom($GLOBALS["MSG_FROM"] , $GLOBALS["MSG_FROM_NICK"])
      ->setTo($GLOBALS["MSG_TO"],$GLOBALS["MSG_TO"])
      ->setBody($GLOBALS["MSG_BODY"])
      ->attach(Swift_Attachment::fromPath($GLOBALS["MSG_ATTACH_FILE_PATH"]));
    $r = $mailer->send($message);
    //
    if($r == 1) return $GLOBALS["SUCCESS_MSG"];
    else        return $GLOBALS["FAILED_MSG"];
}
?>