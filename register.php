<?php
$submitted = false;
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

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = htmlspecialchars($_POST["name"]);
  $phone = htmlspecialchars($_POST["phone"]);
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $address = htmlspecialchars($_POST["address"]);
  $pin = htmlspecialchars($_POST["pin"]);
  $company = htmlspecialchars($_POST["company"]);
  $domain = htmlspecialchars($_POST["domain"]);
  $reference = htmlspecialchars($_POST["reference"]);
  $combination = htmlspecialchars($_POST["combination"]);

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
    $emailBody .= "<b>Name:</b> $name<br>";
    $emailBody .= "<b>Phone:</b> $phone<br>";
    $emailBody .= "<b>Email:</b> $email<br>";
    $emailBody .= "<b>Address:</b> $address<br>";
    $emailBody .= "<b>Pin:</b> $pin<br>";
    $emailBody .= "<b>Company:</b> $company<br>";
    $emailBody .= "<b>Domain:</b> $domain<br>";
    $emailBody .= "<b>Reference:</b> $reference<br>";
    $emailBody .= "<b>Combination:</b> $combination<br>";
    // Headers
    
    // $headers = "From: $name <$email>\r\n";
     $headers = "From: 'Umesh G' <'umesh@mantechconsultancy.com'>\r\n";
     $headers .= "Reply-To: 'umesh4.netdeveloper@gmail.com'\r\n";
    // Content

    $mail->isHTML(true);
    //$mail->headers = $headers;
    $mail->Subject = $emailSubject;
    $mail->Body    = $emailBody;

    $mail->send();
    // if (mail($email, $emailSubject, $emailBody, $headers)) 
    $submitted = true; // Trigger modal
    // echo 'Message has been sent';
  } catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home - Company</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>

</head>

<body>
  <?php include 'includes/header_navbar.html'; ?>
  <div class="bodyContainer text-muted fs-5">
    <h2>Registration Form</h2>
<div class="container rounded-5 p-4" style="background-color: rgb(244, 246, 247 );">
    <p class="registration-form-p pb-2">Fill the below form, which will make it easy to maintain the ownership of your website or Contact us, if you have any query.</p>

    <div class="row">
      <div class="col-md-8">
        <form class="row gy-3" action="" method="post">

          <div class="col-12">
            <input type="text" class="form-control border registration-input" name="name" placeholder="Full Name" required="">
          </div>

          <div class="col-12">
            <input type="text" class="form-control border registration-input" name="phone" placeholder="Contact Number" required="">
          </div>

          <div class="col-12">
            <input type="email" class="form-control border registration-input" name="email" placeholder="E-mail ID" required="">
          </div>

          <div class="col-12">
            <input type="text" class="form-control border registration-input" name="address" placeholder="Full Address" required="">
          </div>

          <div class="col-12">
            <input type="text" class="form-control border registration-input" name="pin" placeholder="Zip Code / Pin Code" required="">
          </div>

          <div class="col-12">
            <input type="text" class="form-control border registration-input" name="company" placeholder="Your Company Name" required="">
          </div>

          <div class="col-12">
            <input type="text" class="form-control border registration-input" name="domain" placeholder="Your Domain Name" required="">
          </div>

          <div class="col-12">
            <input type="text" class="form-control border registration-input" name="reference" placeholder="Refrence Website" required="">
          </div>

          <div class="col-12">
            <input type="text" class="form-control border registration-input" name="combination" placeholder="Website Colour Combination" required="">
          </div>

          <div class="form-group mt-4">

            <div class="captcha-box ">
              <input type="checkbox" id="robot" required>
              <label for="robot" class="captcha-text">I'm not a robot</label>
              <div class="captcha-logo">
                <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" alt="reCAPTCHA">
                <!-- <div class="captcha-powered">reCAPTCHA</div>   -->
              </div>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" value="submit" class="btn bg-blue btn-primary submit-now-btn-sec me-2">&nbsp; &nbsp; Submit Now &nbsp; &nbsp; </button>
          </div>

        </form>

      </div>
      <div class="col-md-4">
         <img src="images/register.png" alt="Work Together" class="img-fluid rounded" style="width: 600px; height: auto;">
                <h3>Contact Info</h3>
         <ul class="footer-contact-details-ul contact-us-footer-details">
          <li class="contact-details-li contact-us-pg-details-li">
            <div class=""><i class="fa fa-map-marker-alt"></i> </div>
            <div class=""> A-102, Poonam Star. CHS,
              Near Vidya Vihar English School, Aghashi Road,
              Virat Nagar, Virar West</div>
          </li>

          <li class="contact-details-li contact-us-pg-details-li">
            <div class=""><i class="bi bi-telephone"></i></div>
            <div class=""><a class="contact-details-a contact-us-pg-details-a" href="tel:+919455519495">(+91) 9455519495</a></div>
          </li>

          <li class="contact-details-li contact-us-pg-details-li">
            <div class=""><i class="bi bi-envelope-open"></i></div>
            <div class=""><a class="contact-details-a contact-us-pg-details-a" href="mailto:umesh@mantechconsultancy.com">umesh@mantechconsultancy.com</a></div>
          </li>

        </ul>
      </div>
    </div>
        <!-- ✅ Bootstrap Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Submission Successful</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                Your form has been submitted successfully!
              </div>
              <div class="modal-footer">
                <button id="redirectBtn" class="btn btn-success">OK</button>
              </div>
            </div>
          </div>
        </div>
        <!-- ✅ Show Modal + Redirect on Button Click -->
  </div>

    <?php include 'includes/footer.html'; ?>

    <?php if ($submitted): ?>
      <script>
        const myModal = new bootstrap.Modal(document.getElementById('successModal'));
        myModal.show();

        // Redirect after clicking the modal button
        document.addEventListener("DOMContentLoaded", function() {
          document.getElementById("redirectBtn").addEventListener("click", function() {
            window.location.href = "register.php"; // 🔁 Change to your redirect page
          });
        });
      </script>
    <?php endif; ?>
</body>

</html>