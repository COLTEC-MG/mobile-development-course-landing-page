<?php
$receiver = "secgeral@coltec.ufmg.br";

/* All form fields are automatically passed to the PHP script through the array $HTTP_POST_VARS. */
$email = $_POST['email'];
$name = $_POST['name'];
$subject = "[COLTEC - Subsequente]: Dúvida";
$message = $_POST['message'];

// Set email headers
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: $name <$email>" . "\r\n";
$headers .= "Cc: $email" . "\r\n";

/* PHP form validation: the script checks that the Email field contains a valid email address and the Subject field isn't empty. preg_match performs a regular expression match. It's a very powerful PHP function to validate form fields and other strings - see PHP manual for details. */
if (!preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) {
//   echo "<h4>Invalid email address</h4>";
//   echo "<a href='javascript:history.back(1);'>Back</a>";
    http_response_code(400);
    echo "Invalid email address: $email";
} elseif ($subject == "") {
    //   echo "<h4>No subject</h4>";
    //   echo "<a href='javascript:history.back(1);'>Back</a>";
    http_response_code(400);
    echo "No subject";
}

/* Sends the mail and outputs the "Thank you" string if the mail is successfully sent, or the error string otherwise. */
elseif (mail($receiver, $subject, $message, $headers)) {
//   echo "<h4>Thank you for sending email</h4>";
    http_response_code(200);
    echo "e-mail sent successfully";
} else {
//   echo "<h4>Can't send email to $email</h4>";
    http_response_code(400);
    echo "can't send email to $email";
}
?>