<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $to = "mantechconserv@gmail.com"; //"umesh4softeng@gmail.com";  // Change to your email
//     $subject = "Ganpati Offer";
//     $name = htmlspecialchars($_POST["name"]);
//     $email = htmlspecialchars($_POST["email"]);
//     $message = htmlspecialchars($_POST["message"]);

//     $body = "Name: $name\nEmail: $email\nMessage:\n$message";

//     $headers = "From: $email";

//     if (mail($to, $subject, $body, $headers)) {
//         echo "Message sent successfully!";
//     } else {
//         echo "Failed to send message.";
//     }
// }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// PHPMailer/src/Exception.php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST["name"]);
    // $phone = htmlspecialchars($_POST["phone"]);
     $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    // $address = htmlspecialchars($_POST["address"]);
    // $pin = htmlspecialchars($_POST["pin"]);
    // $company = htmlspecialchars($_POST["company"]);
    // $domain = htmlspecialchars($_POST["domain"]);
    // $reference = htmlspecialchars($_POST["reference"]);
    // $combination = htmlspecialchars($_POST["combination"]);
 
    $emailSubject = "";
    $emailBody = "";

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'umesh4softeng@gmail.com';  // your Gmail
        $mail->Password   = 'apuv ohlf vfxa nmle';              // App password (not Gmail login)
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom($email, $name); // Sender Mail
        $mail->addAddress('mantechconserv@gmail.com', 'MTCS');  // Receiver Mail

        $emailSubject .= $name . '-' . ' Ganpati Bumper Offer' . '-' . date("d.m.Y H:i:s");
        // $emailBody = "You've received a new message from your website:\n\n";
        $emailBody .= "<b>Name:</b> $name<br>";
        // $emailBody .= "<b>Phone:</b> $phone<br>";
        // $emailBody .= "<b>Email:</b> $email<br>";
        // $emailBody .= "<b>Address:</b> $address<br>";
        // $emailBody .= "<b>Pin:</b> $pin<br>";
        // $emailBody .= "<b>Company:</b> $company<br>";
        // $emailBody .= "<b>Domain:</b> $domain<br>";
        // $emailBody .= "<b>Reference:</b> $reference<br>";
        // $emailBody .= "<b>Combination:</b> $combination<br>";
        // Headers
        // $headers = "From: $name <$email>\r\n";
        // $headers .= "Reply-To: $email\r\n";

        // Content
        $mail->isHTML(true);
        //$mail->headers = $headers;
        $mail->Subject = $emailSubject;
        $mail->Body    = $emailBody;

        $mail->send();
        $submitted = true; // Trigger modal
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
