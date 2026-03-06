<?php

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'mail51.lwspanel.com';
$mail->SMTPAuth = true;
$mail->Username = 'webmaster@iescongo.com';
$mail->Password = 'Gilbert-95';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('webmaster@iescongo.com', 'ICT4D IES-Congo');
$mail->addReplyTo('webmaster@iescongo.com', 'ICT4D IES-Congo');
