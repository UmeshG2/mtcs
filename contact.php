<?php
date_default_timezone_set("Asia/Kolkata");
$submitted = false;  
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// ~~~~~~~~~~~~~~~~~~~ For Mail ~~~~~~~~~~~~~~~~~~~
 // For model popup
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name    = $_POST['name'];
  $phone   = $_POST['phone'];
  $email    = $_POST['email'];
  $message = $_POST['message'];

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

    $emailSubject .= $name . ' - contact with you ' . ' - ' . date("d.m.Y H:i:s");
    $emailBody .= "<b>Name:</b> $name<br>";
    $emailBody .= "<b>Phone:</b> $phone<br>";
    $emailBody .= "<b>Email:</b> $email<br>";
    $emailBody .= "<b>Message:</b> $message<br>";
    // Content

    $mail->isHTML(true);
    $mail->Subject = $emailSubject;
    $mail->Body    = $emailBody;

    $mail->send();
    // $submitted = true; // Trigger modal
    // echo 'Message has been sent';
  } catch (Exception $e) {
    logError($e->getMessage());
    echo "<script>alert('Contact Mailer Error .'); window.history.back();</script>";
  }

  // ~~~~~~~~~~~~~~~~~~  To Save in Database ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

  require_once 'includes/logger.php';
  include "includes/db_config.php";
  //  Using the stored procedure call
  try{

  $sql = $conn->prepare("CALL usp_contacts(?,?,?,?)");
  $sql->bind_param("sdss", $name, $phone, $email, $message);
  $sql->execute();
  $submitted = true;
  // echo "<script>alert('Message sent successfully!');
  }
  catch (mysqli_sql_exception  $e) {
    logError(" Contact Data Saving Error: " . $e->getMessage());
    echo "<script>alert('Contact Data Saving Error !'); window.history.back();</script>";
  }
  $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Manpower and technologies consultancy services">
  <title>Contact Us</title>
  <?php include 'includes/analytics.php'; ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
  <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <?php include 'includes/header_navbar.html'; ?>

  <div class="container bodyContainer text-muted fs-6">

    <!-- Banner Section -->
    <div class="row align-items-center my-3">
      <div class="col-12 col-md-3 text-center text-md-start mb-3 mb-md-0">
        <h1>Contact Us</h1>
      </div>
      <div class="col-12 col-md-9 d-flex justify-content-center align-items-center">
        <img class="img-fluid" src="images/Banner-contact.jpg" alt="Contact Us">
      </div>
    </div>

    <!-- Contact Form + Image -->
    <div class="row my-4 py-4">
      <div class="col-12 col-md-5 d-flex justify-content-center align-items-center mb-4 mb-md-0">
        <img src="images/contact_me.jpg" alt="Industries" class="img-fluid rounded">
      </div>

      <div class="col-12 col-md-7 px-4 py-3 bg-light rounded-4">
        <div class="widget widget-contact-form p-3">
          <div class="heading-layout4 mb-3">
            <h4>Get in touch</h4>
          </div>

          <form class="contact-form-box" method="post" action="">
            <div class="row g-3">

              <!-- Name -->
              <div class="col-12">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                  <input type="text" placeholder="Name" class="form-control" name="name" required>
                </div>
              </div>

              <!-- Phone -->
              <div class="col-12">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                  <input type="text" placeholder="Phone" class="form-control" name="phone" required>
                </div>
              </div>

              <!-- Email -->
              <div class="col-12">
                <div class="input-group">
                  <span class="input-group-text"><i class="far fa-envelope"></i></span>
                  <input type="email" placeholder="E-mail Address" class="form-control" name="email" required>
                </div>
              </div>

              <!-- Address -->
              <div class="col-12">
                <div class="input-group">
                  <span class="input-group-text"><i class="far fa-comments"></i></span>
                  <textarea placeholder="Address" class="form-control" name="message" rows="2" required></textarea>
                </div>
              </div>

              <!-- Submit -->
              <div class="col-12 text-center">
                <button type="submit" name="submit" class="btn btn-primary px-4">Send Message</button>
              </div>

            </div>
            <div class="form-response mt-3"></div>
          </form>

          <?php include 'includes/modal-popup.html'; ?>
        </div>
      </div>
    </div>

    <!-- Address + Map Section -->
    <div class="row my-5 py-4 bg-light rounded-4">
      <div class="col-12 col-md-5 px-4 mb-4 mb-md-0">
        <div class="fs-5">
          <strong><i class="bi bi-geo-alt-fill"></i> Address</strong>
          <p>A-102, Poonam Star, Near Ayyappa Temple, Virat Nagar, Virar West - 401303, Mumbai, Maharashtra, India</p>
          <strong><i class="bi bi-telephone-fill"></i> Phone</strong>
          <p>(+91) 95455 19495</p>
          <strong><i class="bi bi-whatsapp text-success me-2"></i>WhatsApp</strong>
          <p><a href="https://wa.me/919545519495" target="_blank">(+91) 95455 19495</a></p>
          <strong><i class="bi bi-envelope-fill"></i> Email</strong>
          <p><a href="mailto:umesh@mantechconsultancy.com">umesh@mantechconsultancy.com</a></p>
        </div>
      </div>

      <div class="col-12 col-md-7 px-4">
        <div class="ratio ratio-16x9">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7524.261174477107!2d72.80500741833366!3d19.449935785681518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7a9811c98296d%3A0xc99ba7183bec3a68!2sAyappa%20Temple%20Virar%20West!5e0!3m2!1sen!2sin!4v1753689416700!5m2!1sen!2sin"
            style="border:0;" allowfullscreen="" loading="lazy">
          </iframe>
        </div>
      </div>
    </div>

  </div>

  <?php include 'includes/footer.html'; ?>

  <?php if ($submitted): ?>
    <script>
      const myModal = new bootstrap.Modal(document.getElementById('successModal'));
      myModal.show();

      document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("redirectBtn").addEventListener("click", function() {
          window.location.href = "contact.php";
        });
      });
    </script>
  <?php endif; ?>
</body>


</html>