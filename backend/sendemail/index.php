<?php
header("Access-Control-Allow-Origin: http://localhost:3000");

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;

require 'C:\Program Files\Ampps\www\sendemail\vendor\phpmailer\phpmailer\src\Exception.php';
require 'C:\Program Files\Ampps\www\sendemail\vendor\phpmailer\phpmailer\src\PHPMailer.php';
//require 'C:\Program Files\Ampps\www\sendemail\vendor\phpmailer\phpmailer\src\SMTP.php';

//POST referer server
if ($_SERVER['HTTP_REFERER'] === "http://localhost:3000/" || "http://localhost:80/") {
    // extract the data from POST method
    $email = isset($_POST['sendto']) ? $_POST['sendto'] : null;
    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : null;
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : null;
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    $street = isset($_POST['street']) ? $_POST['street'] : null;
    $number = isset($_POST['number']) ? $_POST['number'] : null;
    $city = isset($_POST['city']) ? $_POST['city'] : null;
    $postalCode = isset($_POST['postalCode']) ? $_POST['postalCode'] : null;
    $utmSource = isset($_POST['utm_source']) ? $_POST['utm_source'] : null;
    $utmMedium = isset($_POST['utm_medium']) ? $_POST['utm_medium'] : null;
    $ref = isset($_POST['ref']) ? $_POST['ref'] : null;
    var_dump($_POST);

    //if ($email && $firstName && $lastName && $phone && $street && $number && $city && $postalCode && $utmSource && $utmMedium && $ref) {

    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                 //Enable verbose debug output
        $mail->isSMTP();                                               //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                            //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                     //Enable SMTP authentication
        $mail->Username = 'testing.ajix@gmail.com';            //SMTP username
        $mail->Password = 'testing@123';                        //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption;`PHPMailer::ENCRYPTION_SMTP` encouraged
        $mail->Port = 587;                                          // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTP` above

        //Recipients
        $mail->setFrom('testing.ajix@gmail.com', 'React Form');
        $mail->addAddress('testing.ajix@gmail.com');       // Recipient Address('mail', 'name') Name is optional
        $mail->addReplyTo('testing.ajix@gmail.com', 'Information');

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'React PHP,  Roy Aji - משימת הכרות';
        $mail->Body = "<p dir='rtl'>מייל " . $email . "<br/>" .
            "שם פרטי " . $firstName . "<br/>" .
            "שם משפחה " . $lastName . "<br/>" .
            "נייד " . $phone . "<br/>" .
            "רחוב " . $street . "<br/>" .
            "מספר " . $number . "<br/>" .
            "עיר " . $city . "<br/>" .
            "מיקוד " . $postalCode . "<br/></p><br/>" .
            "<h2 dir='ltr'>utm_source=" . $utmSource . "<br/>" .
            "utm_medium=" . $utmMedium . "<br/>" .
            "ref=" . $ref . "</h2>" .
            "<a href='https://github.com/raj264275183/ReactPHPMailer/tree/contact-us-is-working' style='text-decoration:none; color:#ff00ff;'>Github Project Repo --></a>";

        if ($mail->send()) {
            echo "Message has been sent!";
        }
    } catch (Exception $e) {
        echo "Message couldn't be sent. Error: ", $mail->ErrorInfo;
    }
} //else {
//echo "All the fields are required!";
//}
//}
else {
    echo "You can't use this server!";
}
