<?php
date_default_timezone_set("Asia/Kolkata");  // To set indian time zone on live server
$submitted = false;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  // Not to display actual technical error to user

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name   = htmlspecialchars($_POST["name"]);
  $phone  = htmlspecialchars($_POST["phone"]);
  $email  = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $address = htmlspecialchars($_POST["address"]);
  $pin    = htmlspecialchars($_POST["pin"]);
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

    $emailSubject .= $name .' - New website ' . '-' . date("d.m.Y H:i:s");
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
       logError($e->getMessage());
    echo "<script>alert('Registration Mailer Error .'); window.history.back();</script>";
  }
 // ~~~~~~~~~~~~~~~~~~  To Save in Database ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

  require_once 'includes/logger.php';
  include "includes/db_config.php";
try
{
  //  Using the stored procedure call
  $sql = $conn->prepare("CALL usp_websites(?,?,?,?,?,?,?,?,?)");
  $sql->bind_param("sdsssssss", $name, $phone, $email,$address,$pin,$company,$domain,$reference,$combination);
  $sql->execute();
  $submitted = true;
  }
  catch (mysqli_sql_exception  $e) {
    logError("Register Data Saving Error: " . $e->getMessage());
    echo "<script>alert('Register Data Saving Error!'); window.history.back();</script>";
  }
  $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="New website and mobile app development">
  <title>Register</title>
  <?php include 'includes/analytics.php'; ?>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>

<body>
  <?php include 'includes/header_navbar.html'; ?>
  <div class="bodyContainer text-muted fs-6">
    <h1>Registration For New Website</h1>
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
            <div class="col-12  text-center">
              <button type="submit" value="submit" class="btn bg-blue btn-primary submit-now-btn-sec me-2">&nbsp; &nbsp; Submit Now &nbsp; &nbsp; </button>
            </div>
          </form>

        </div>
        <div class="col-md-4">
          <img src="images/register.png" alt="Work Together" class="img-fluid rounded" style="width: 400px; height: auto;">
          <h3>Contact Info</h3>
          <ul>
            <li>
              <div><strong>Address - </strong> A-102, Poonam Star, Near Ayyappa Temple, Virat Nagar, Virar West 401303, Mumbai, Maharashtra, India</div>
            </li>
            <li>
              <div><strong>Phone - </strong> (+91) 95455 19495</div>
            </li>
            <li>
              <div><strong>Email - </strong>
                <a href="mailto:umesh@mantechconsultancy.com">umesh@mantechconsultancy.com</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <!-- ✅ Bootstrap Modal -->
      <?php include 'includes/modal-popup.html'; ?>
      <!-- <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
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
        </div> -->
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
            window.location.href = "frm-register-website.php"; // 🔁 Change to your redirect page
          });
        });
      </script>
    <?php endif; ?>
</body>

</html>