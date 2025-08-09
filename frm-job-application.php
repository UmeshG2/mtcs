<?php
date_default_timezone_set("Asia/Kolkata");
$submitted = false;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name       = htmlspecialchars($_POST["fullName"]);
    $phone      = htmlspecialchars($_POST["phone"]);
    $email      = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $position   = htmlspecialchars($_POST["position"]);
    $coverLetter = htmlspecialchars($_POST["coverLetter"]);

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

        $emailSubject .= $name . ' - Job candidate ' . '-' . date("d.m.Y H:i:s");
        $emailBody .= "<b>Name:</b> $name<br>";
        $emailBody .= "<b>Phone:</b> $phone<br>";
        $emailBody .= "<b>Email:</b> $email<br>";
        $emailBody .= "<b>position:</b> $position<br>";
        $emailBody .= "<b>coverLetter:</b> $coverLetter<br>";

        $mail->isHTML(true);
        $mail->Subject = $emailSubject;
        $mail->Body    = $emailBody;

        $mail->send();
        $submitted = true; // Trigger modal
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="New website and mobile app development">
    <title>Job Application</title>
    <?php include 'includes/analytics.php'; ?>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>

<body>
    <?php include 'includes/header_navbar.html'; ?>
    <div class="bodyContainer text-muted fs-5">
        <h1> Apply for a position</h1>
        <!-- Application Form -->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <!-- <form action="submit-application.php" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow-sm bg-light"> -->
                        <form action="" method="POST" class="border p-4 rounded shadow-sm bg-light">
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">Position Applying For *</label>
                                <input type="text" class="form-control" id="position" name="position" required>
                            </div>

                            <!-- <div class="mb-3">
                            <label for="resume" class="form-label">Upload Resume (PDF/DOC) *</label>
                            <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                            </div> -->

                            <div class="mb-3">
                                <label for="coverLetter" class="form-label">Cover Letter</label>
                                <textarea class="form-control" id="coverLetter" name="coverLetter" rows="5" placeholder="Tell us about yourself..."></textarea>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="consent" required>
                                <label class="form-check-label" for="consent">I consent to the processing of my data for recruitment purposes.</label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">Submit Application</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </section>
        <!-- ✅ Bootstrap Modal -->
        <?php include 'includes/modal-popup.html'; ?>
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
                    window.location.href = "frm-job-application.php"; // 🔁 Change to your redirect page
                });
            });
        </script>
    <?php endif; ?>
</body>

</html>