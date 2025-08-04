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

  /* --- Using Normal Query  
  $sql = "INSERT INTO contacts(name,contactno,address)  
     VALUES ('$name', '$contactno', '$address')";
  if ($conn->query($sql) === TRUE) {
     */

  /*    // --- Using Parameterised Query  
 // i = integer, d = double, s = string,b = blob (binary data)
  $query = "INSERT INTO contacts (name, phone, email) VALUES (?, ?, ?)";
  $sql = $conn->prepare($query);
  $sql->bind_param("sss", $name, $phone, $email);
*/

  //  Using the stored procedure call
  try{

  $sql = $conn->prepare("CALL usp_contacts(?,?,?,?)");
  $sql->bind_param("sdss", $name, $phone, $email, $message);
  $sql->execute();
  $submitted = true;
  // if ($sql->execute()) {
  //   $submitted = true;
  //   // echo "<script>alert('Message sent successfully!'); 
  //   // echo "<script> window.history.back(); </script>";
  // }
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

  <div class="bodyContainer text-muted fs-6">

    <div class="row align-items-center">
      <div class="col-12 col-md-3 text-md-start mb-md-0 ">
        <h1> Contact Us </h1>
      </div>
      <div class="col-12 col-md-9">
        <img class="img-fluid" src="images/Banner-contact.jpg" alt="Contact Us">
      </div>
    </div>

    <div class="row my-4 py-4">
      <div class="col-md-5 container-fluid center-container d-flex justify-content-center align-items-center">
        <img src="images/contact_me.jpg" alt="Industries" class="img-fluid rounded">
      </div>

      <div class="col-md-7 px-5" style="background-color: rgb(244, 246, 247 );">
        <div class="widget widget-contact-form rounded-5 p-4"">
          <div class=" heading-layout4">
          <h4>Get in touch</h4>
        </div>
        <form class="contact-form-box" method="post" action="">
          <div class="row">

            <!-- Name -->
            <div class="col-12 form-group mb-3">
              <div class="input-group">
                <span class="input-group-text border-end-0 rounded-end-0">
                  <i class="fas fa-user"></i>
                </span>
                <input type="text" placeholder="Name" class="form-control border-start-0 rounded-start-0" name="name" required>
              </div>
            </div>

            <!-- Phone -->
            <div class="col-12 form-group mb-3">
              <div class="input-group">
                <span class="input-group-text border-end-0 rounded-end-0">
                  <i class="fas fa-phone-volume"></i>
                </span>
                <input type="text" placeholder="Phone" class="form-control border-start-0 rounded-start-0" name="phone" required>
              </div>
            </div>

            <!-- Email -->
            <div class="col-12 form-group mb-3">
              <div class="input-group">
                <span class="input-group-text border-end-0 rounded-end-0">
                  <i class="far fa-envelope"></i>
                </span>
                <input type="email" placeholder="E-mail Address" class="form-control border-start-0 rounded-start-0" name="email" required>
              </div>
            </div>

            <!-- Services -->
            <!-- <div class="col-12 form-group mb-3">
              <div class="input-group">
                <span class="input-group-text border-end-0 rounded-end-0">
                  <i class="fas fa-question"></i>
                </span>
                <input type="text" placeholder="Services" class="form-control border-start-0 rounded-start-0" name="services" required>
              </div>
            </div> -->

            <!-- Address -->
            <div class="col-12 form-group mb-3">
              <div class="input-group">
                <span class="input-group-text border-end-0 rounded-end-0">
                  <i class="far fa-comments"></i>
                </span>
                <textarea placeholder="Address" class="form-control border-start-0 rounded-start-0" name="message" rows="2" required></textarea>
              </div>
            </div>

            <!-- Submit -->
            <div class="col-12 form-group text-center">
              <button type="submit" name="submit" class="btn bg-blue btn-primary submit-now-btn-sec me-2">Send Message</button>
            </div>
          </div>
          <div class="form-response"></div>
        </form>

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
        <!--  Show Modal + Redirect on Button Click -->
      </div>
    </div>

    <div class="row my-5 py-4"  style="background-color: rgb(244, 246, 247 );">
      <div class="col-md-5">
        <div class=" px-5 fs-5">
          <strong><i class="bi bi-geo-alt-fill"></i> Address</strong>
          <p>A-102, Poonam Star, Near Ayyappa Temple, Virat Nagar, Virar West - 401303, Mumbai, Maharashtra, India
          </p>
          <strong><i class="bi bi-telephone-fill"></i> Phone</strong>
          <p> (+91) 95455 19495</p>
          <strong><i class="bi bi-whatsapp text-success me-2"></i>WhatsApp</strong>
          <p><a href="https://wa.me/919545519495" target="_blank">(+91) 95455 19495</a></p>
          <strong><i class="bi bi-envelope-fill"></i> Email</strong>
          <p><a href="mailto:umesh@mantechconsultancy.com">umesh@mantechconsultancy.com</a></p>
        </div>
      </div>
      <div class="col-md-7">
                <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7524.261174477107!2d72.80500741833366!3d19.449935785681518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7a9811c98296d%3A0xc99ba7183bec3a68!2sAyappa%20Temple%20Virar%20West!5e0!3m2!1sen!2sin!4v1753689416700!5m2!1sen!2sin"
          width="750" height="350" style="border:0;" allowfullscreen="" loading="lazy" style="margin-left:5px;"></iframe>
      </div>
    </div>
  </div>

  <?php include 'includes/footer.html'; ?>

  <?php if ($submitted): ?>
    <script>
      const myModal = new bootstrap.Modal(document.getElementById('successModal'));
      myModal.show();

      // Redirect after clicking the modal button
      document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("redirectBtn").addEventListener("click", function() {
          window.location.href = "contact.php"; // 🔁 Change to your redirect page
        });
      });
    </script>
  <?php endif; ?>


</body>

</html>