    <?php
    if(isset($_POST['email'])) {
        $email_to = 'samuraizero4@gmail.com';
        $email_subject = 'Service Request';
        $first_name = $_POST['firstname']; // not required
        $last_name = $_POST['lastname']; // not required
        $email_from = $_POST['email']; // required
        $telephone = $_POST['phonenumber']; // required
        $message = $_POST['messages']; // not required

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

    // create email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n".
    'X-Mailer: PHP/'.phpversion();
    if(mail($email_to, $email_subject, $email_message, $headers)){
        echo 'Mail sent successfully';
    }
    else{
        echo 'Send failed, try again.';
    }
}
    ?>