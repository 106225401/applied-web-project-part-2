<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="NextGen Devs - Digital Learning and Innovation (DLI) Department. Building future-ready digital solutions for education and research.">
    <meta name="keywords" content="nextgen devs, home page, digital learning, innovation, research">
    <meta name="author" content="Afif - NextGen Devs">
    
    <title>NextGen Devs | Home - Digital Learning & Innovation</title>
    <link rel="icon" type="image/x-icon" href="images/logo.ico">

    <link rel="stylesheet" href="styles/styles.css?v=<?php echo time(); ?>">

    <!-- embedded CSS -->
    <style>
        .logo-img p {
            font-size: 0.8rem;
            margin-top: 0.75rem;
            font-style: italic;
        }
    </style>
</head>
<body>
    <?php include 'header.inc';?>

    <main id="main" class="content-wrapper">       
        <!-- Group Details: logo, name, slogan, description, image -->
        <section aria-label="Company introduction">
            <div class="intro-box">
                <div class="group-info">
                    <div class="group-badge">✨ NextGen Innovators</div>

                    <h1>NextGen Devs</h1>

                    <div class="dept-name">📘 Digital Learning &amp; Innovation Department</div>
                    
                    <div class="btn-group">
                        <a href="jobs.php" class="job-btn">Join our team</a>
                        <a href="about.php" class="aboutus-btn">Learn more</a>
                    </div>
                </div>

                <div class="logo-img">
                    <!-- Image from images folder - Logo.png -->
                    <img src="images/Logo.png" 
                        alt="NextGen Devs Company Logo - Purple brand symbol">

                    <p>NGD | Driving digital innovation</p>
                </div>
            </div>
        </section>

        <!-- Intro to our team -->
        <!-- <section class="our-slogan" aria-labelledby="about-our-slogan">
            <blockquote>
                <p>"Code, Create, Conquer"</p>
                <cite>— NextGen Devs</cite>
            </blockquote>
        </section> -->

        <section class="slogan-box" aria-labelledby="slogan-heading">
            <h2 id="slogan-heading" class="sr-only">Our Slogan</h2>
            <p class="slogan-text">"Code, Create, Conquer"</p>
            <cite class="slogan-cite">— NextGen Devs</cite>
        </section>
                
        <!-- Core Values / Insights Section -->
        <div class="insights">
            <div class="card">
                <h3>🎓 Digital Learning & Research</h3>
                <p>Formerly DLR (Digital Learning and Research) Department, we pioneer interactive modules, AI-driven tutoring, and inclusive EdTech research.</p>
            </div>

            <div class="card">
                <h3>⚡ Innovation Lab</h3>
                <p>Explore prototypes, XR labs, and collaborative projects that reshape how knowledge is built and shared across global classrooms.</p>
            </div>

            <div class="card">
                <h3>🤝 Industry Connect</h3>
                <p>We partner with leading tech companies and academic institutions to deliver real-world impact and career-ready pathways.</p>
            </div>
        </div>
        
        <!-- inline CSS demonstration: additional style block as per requirement (clear inline usage) -->
        <div style="margin-top: 2rem; text-align: center; font-size: 0.9rem; background: #eae5ff; padding: 1rem; border-radius: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <span style="font-weight: bold; color: #2d1b69;">📢 NextGen Devs — Home of the Digital Learning and Innovation (DLI) Department</span> 
            — building tomorrow's intelligent learning ecosystems.
        </div>
    </main>

    <?php include 'footer.inc';?>
</body>
</html>