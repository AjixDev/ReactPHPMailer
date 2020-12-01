<?php
header("Access-Control-Allow-Origin: http://localhost:3000");

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'C:\Program Files\Ampps\www\sendemail\vendor\phpmailer\phpmailer\src\Exception.php';
require 'C:\Program Files\Ampps\www\sendemail\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'C:\Program Files\Ampps\www\sendemail\vendor\phpmailer\phpmailer\src\SMTP.php';

//POST referer server
if ($_SERVER['HTTP_REFERER'] === "http://localhost:3000/" || "http://localhost:80/") {
    // POST data from POST method
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
    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    echo $ref;
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'testing.ajix@gmail.com'; // SMTP username
        $mail->Password = 'testing@123'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption;`PHPMailer::ENCRYPTION_SMTP` encouraged
        $mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTP` above

        //Recipients
        $mail->setFrom('testing.ajix@gmail.com', 'React Form');
        $mail->addAddress('testing.ajix@gmail.com'); // Recipient Address('mail', 'name') Name is optional
        $mail->addReplyTo('testing.ajix@gmail.com', 'Information');

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'React Form, From Roy Aji - משימת הכרות';
        $mail->Body = "<p dir='rtl'> שם פרטי:" . $firstName . "<br/>" .
            "שם משפחה " . $lastName . "<br/>" .
            "נייד " . $phone . "<br/>" .
            "מייל " . $userEmail . "<br/>" .
            "רחוב " . $street . "<br/>" .
            "מספר " . $number . "<br/>" .
            "עיר " . $city . "<br/>" .
            "מיקוד " . $postalCode . "<br/>
                <br/>
                <br/>" .
            "utm_source " . $utmSource . "<br/>" .
            "utm_medium " . $utmMedium . "<br/>" .
            "ref " . $ref . "<br/></p>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "It's not here, Sorry.";
}
