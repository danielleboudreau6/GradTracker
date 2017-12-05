<?php

include 'mail/sendmail.php';

$replyToEmail = 'danielle_boudreau_6@hotmail.com';
    $replyToName = 'Danielle Boudreau';
    $mailSubject = 'mail subject';                       
    $messageTEXT = "Thank you for registering";
    $messageHTML = "<p><strong>Thank you for registering</strong></p>";


    $fromEmail = 'fakegradtrackers@gmail.com';
    $fromName = 'TestGradTracker';
    $toEmail = 'danielle_boudreau_6@hotmail.com';
    $toName = 'Danielle Boudreau';                  

    //2.  Send email
    $mail = new sendMail($replyToEmail, $replyToName, $mailSubject, $messageHTML, $messageTEXT, $fromEmail, $fromName, $toEmail, $toName);
    
            $result = $mail->SendMail();
                
if ($result){
    echo "success";
}else{
    echo "fail";
}