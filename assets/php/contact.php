<?php
//Include required phpmailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail(){
    //Create instances of phpmailer
    $mail = new PHPMailer();
    //Set mailer to use smtp
    $mail->isSMTP();
    //define smtp host
    $mail->Host = "smtp.gmail.com";
    //enable smtp authentication
    $mail->SMTPAuth = "true";
    //set type of encryption (ssl/tls)
    $mail->SMTPSecure = "tls";
    //set port to connect smtp
    $mail->Port = "587";
    //set gmail username
    $mail->Username = "crystalclearpoolservice.916@gmail.com";
    //set gmail pw
    $mail->Password = "akskgeevsqgfqpvt";
    //set email subject
    if(isset($_POST['email'])) {
        $email_to = 'samuraizero4@gmail.com';
        $email_subject = 'Service Request';
        $first_name = $_POST['firstname']; // not required
        $last_name = $_POST['lastname']; // not required
        $email_from = $_POST['email']; // required
        $telephone = $_POST['phonenumber']; // required
        $message = $_POST['messages']; // not required
        //set email sender
        $mail->setFrom("crystalclearpoolservice.916@gmail.com",'CrystalClearPoolService.DoNotReply',$auto=true);
        //enable html
        $mail->isHTML(true);
        function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
        }

        $email_message = "Form details below.\n\n";
        $email_message .= "First Name: ".clean_string($first_name)."\n";
        $email_message .= "Last Name: ".clean_string($last_name)."\n";
        $email_message .= "Email: ".clean_string($email_from)."\n";
        $email_message .= "Telephone: ".clean_string($telephone)."\n";
        $email_message .= "Message: ".clean_string($message)."\n";
        $mail -> Body = $email_message;
        //add recepient
        $mail -> addAddress("samuraizero4@gmail.com");
        //Send email
        if($mail->Send()) {
            header("Location:service_manager.php");
        }
        else{
            echo "Fail to send, please try again later.";

        }
    //Closing smtp connection
        $mail->smtpClose();
    }
}
if($_POST['action'] == 'send'){
    sendMail();
}
exit();
/*


    // create email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n".
    'X-Mailer: PHP/'.phpversion();
    if(mail($email_to, $email_subject, $email_message, $headers)){
        console_log('Mail sent successfully');
    }
    else{
        console_log('Send failed, try again.');
    }
}*/
    ?>