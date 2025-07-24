<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// ~~~~~~~~~~~~~~~~~~~ For Mail ~~~~~~~~~~~~~~~~~~~
$submitted = false;   // For model popup
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

    $emailSubject .= $name . '-' . ' Ganpati Bumper Offer' . '-' . date("d.m.Y H:i:s");
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
    echo "Mailer Error: {$mail->ErrorInfo}";
  }

  // ~~~~~~~~~~~~~~~~~~  To Save in Database ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

  // include "db_config.php";
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
  $sql = $conn->prepare("CALL usp_contacts(?,?,?,?)");
  $sql->bind_param("sdss", $name, $phone, $email, $message);

  if ($sql->execute()) {
     $submitted = true;
    // echo "<script>alert('Message sent successfully!'); 
    // echo "<script> window.history.back(); </script>";
  } else {
    echo "<script>alert('Error saving message.'); window.history.back();</script>";
  }
  $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Contact Us</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <?php include 'includes/header_navbar.html'; ?>

  <div class="bodyContainer text-muted fs-5">
    <h2>Contact Us</h2>
    <div class="row">
      <div class="col-sm-6">
        <img src="images/Contact-us.png" alt="Office" class="img-fluid contact-img w-100">
      </div>
      <div class="col-md-6">
        <div class="d-flex align-items-center vh-100 fs-4">
          <!-- <h4>Manpower Technologies And Consultancy Services</h4> -->
          <p>
            <strong>Address:</strong><br>
            123 Business Park, Sector 5,<br>
            Navi Mumbai, Maharashtra 400705, India
            <br />
            <strong>Phone:</strong> +91 95455 19495<br>
            <strong>Email:</strong> umesh@mantechconsultancy.com
          </p>

        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center align-items-center">
      <div class="widget widget-contact-form rounded-5 p-4" style="background-color: rgb(244, 246, 247 ); width: 75%;">
        <div class="heading-layout4">
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
            <div class="col-12 form-group">
              <button type="submit" name="submit" class="btn bg-blue btn-primary submit-now-btn-sec me-2">Send Message</button>
            </div>
          </div>
          <div class="form-response"></div>
        </form>

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