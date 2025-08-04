<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Grow with us">
  <title>Careers</title>
  <?php include 'includes/analytics.php'; ?>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>

<body>
  <?php include 'includes/header_navbar.html'; ?>
  <div class="bodyContainer text-muted fs-5">
    <div class="row" style="margin-top: -25px;">
      <div class="col-md-">
        <!-- <div class="ratio ratio-16x9" >
          <iframe src="videos/PeopleSnowSketing.mp4" title="YouTube video" allowfullscreen style="border: none;"></iframe>
        </div> -->
        <div class="ratio ratio-16x9">
          <video autoplay loop muted playsinline style="border: none; width: 100%; height: 100%;">
            <source src="videos/career-video.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
      </div>
    </div>

    <div class="row m-5">
      <h1>Careers</h1>
      <div class="col-md-6">
        <p class="p-5">
          We believe our people are our greatest strength. Whether you're a tech expert, a strategic thinker, or a
          passionate problem-solver, we offer opportunities that let you grow, innovate, and make a real impact.
          As a dual-service leader in manpower and software consultancy, we connect talented individuals with exciting
          projects across a wide range of industries. From startups to global enterprises, our clients trust us to
          provide both technical excellence and top-tier professionals — and we trust our team to make that happen.
        </p>
      </div>
      <div class="col-md-6 container-fluid center-container d-flex justify-content-center align-items-center">
        <img src="images/careers.jpg" alt="Industries" class="img-fluid rounded">
      </div>
    </div>
    <div class="row m-5">
      <div class="col-md-12">
        <h2 class="mb-4">
          Why Work With Us?
        </h2>

        <ul>
          <li><b>Diverse Opportunities:</b></li>
          <p>Work on cutting-edge software projects or take on key roles in top organizations across various industries.
          </p>
          <li><b>Career Development:</b></li>
          <p>Access training, mentorship, and upskilling programs to help you stay ahead in your career.</p>
          <li><b>Supportive Culture:</b></li>
          <p>We foster a collaborative, inclusive, and flexible work environment where your contributions are valued.
          </p>
          <li><b>Growth-Focused:</b></li>
          <p>Whether you’re seeking a long-term role or a dynamic project-based position, we help match your skills and
            ambitions with the right opportunities.</p>
        </ul>

    </div>
      </div>
      <!-- Job Openings -->
      <section class="bg-light py-5">

        <div class="container">
          <h2 class="text-start mb-5">Current Openings</h2>

          <!-- Job Card 1 -->
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Frontend Developer</h5>
              <p class="card-text">
                <strong>Location:</strong> Remote / India<br>
                <strong>Experience:</strong> 2+ years<br>
                <strong>Skills:</strong> HTML, CSS, JavaScript, React or Angular
              </p>
            <a class="btn btn-primary" href="frm-job-application.php" target="_blank">Apply Now</a>
            </div>
          </div>

          <!-- Job Card 2 -->
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Mobile App Developer</h5>
              <p class="card-text">
                <strong>Location:</strong> Remote / Hybrid<br>
                <strong>Experience:</strong> 1–3 years<br>
                <strong>Skills:</strong> Flutter / React Native, API integration, Firebase
              </p>
           <a class="btn btn-primary" href="frm-job-application.php" target="_blank">Apply Now</a>
            </div>
          </div>

          <!-- Job Card 3 -->
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">HR & Recruitment Executive</h5>
              <p class="card-text">
                <strong>Location:</strong> On-site (Mumbai Suburban preferred)<br>
                <strong>Experience:</strong> 1–2 years<br>
                <strong>Skills:</strong> Hiring process, LinkedIn sourcing, ATS tools
              </p>
              
               <a class="btn btn-primary" href="frm-job-application.php" target="_blank">Apply Now</a>
              <!-- <a href="mailto:hr@yourcompany.com?subject=HR Executive Application" class="btn btn-primary">Apply Now</a> -->
            </div>
          </div>

          <!-- No opening message (optional for conditional display) -->
          <!-- <p class="text-center text-muted">Currently no openings available. Please check back soon!</p> -->

        </div>
      </section>

      <!-- Perks Section -->
      <section class="py-4 text-center">
        <div class="container">
          <h2 class="text-start mb-4">Perks & Benefits</h2>
          <div class="row g-4">
            <div class="col-md-3">
              <div class="border p-3 rounded shadow-sm h-100">
                <h6>🏡 Remote Friendly</h6>
                <p class="text-muted">Work from anywhere with flexible hours.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="border p-3 rounded shadow-sm h-100">
                <h6>📚 Learning Budget</h6>
                <p class="text-muted">Access to courses, certifications, and events.</p>
              </div>
            </div>
            <!-- <div class="col-md-3">
          <div class="border p-3 rounded shadow-sm h-100">
            <h6>🎉 Team Activities</h6>
            <p class="text-muted">Virtual games, retreats, and celebrations.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="border p-3 rounded shadow-sm h-100">
            <h6>🩺 Health Support</h6>
            <p class="text-muted">Medical insurance and wellness programs.</p>
          </div>
        </div> -->
          </div>
        </div>
      </section>

    <!-- </div> -->
    <?php include 'includes/footer.html'; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>