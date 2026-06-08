<?php
/* =====================================================
 *  jobs.php – Available Job Positions Page
 *  NextGen Devs Website – Applied Web Project Part 2
 *  Author: Charlotte (Eaint Wunna Aung) – Leader & Developer
 *  Individual Responsibility: jobs.php
 *  =====================================================
 *
 *  Description:
 *  Displays available job positions with full details
 *  including salary, responsibilities, and requirements.
 *  
 *  Includes: header.inc, nav.inc, footer.inc
 */

// Page-specific meta information
$pageTitle = "Available Job Positions";
$pageDescription = "Apply for positions in the Digital Learning and Innovation (DLI) Department at NextGen Devs University.";
$pageKeywords = "university jobs, job application, IT careers, digital learning, innovation, research";
$pageAuthor = "Jingyee";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <meta name="keywords" content="<?php echo $pageKeywords; ?>">
    <meta name="author" content="<?php echo $pageAuthor; ?>">

    <title><?php echo $pageTitle; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/logo.ico">

    <!-- External Stylesheet – FIX: Correct path to styles/ folder -->
    <link rel="stylesheet" href="styles/styles.css">

    <!-- Embedded CSS for page-specific styling -->
    <style>
        ::selection {
            background-color: #4a90e1;
            color: white;
        }

        ol li::marker {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php include 'header.inc'; ?>

    <main id="jobs-main">
        <!-- Page Title Heading -->
        <h1 class="jobs-heading">Available Job Positions</h1>

        <!-- Anchor Navigation for Jobs -->
        <div class="short-keys">
            <nav aria-label="Job Position Description Anchor Links">
                <ul>
                    <li><a href="#digital">Digital Learning</a></li>
                    <li><a href="#admin">LMS Admin</a></li>
                    <li><a href="#research">Research</a></li>
                </ul>
            </nav>
        </div>

        <!-- Benefits Sidebar -->
        <aside class="job-aside">
            <h2>Benefits</h2>
            <ul>
                <li>Flexible working hours</li>
                <li>Professional development opportunities</li>
                <li>University staff discounts</li>
                <li>Access to research tools and systems</li>
            </ul>
        </aside>

        <!-- Job Listings Container -->
        <div class="available-jobs">

            <!-- ============================================== -->
            <!-- JOB 1: Digital Learning Support Officer        -->
            <!-- ============================================== -->
            <section id="digital" class="job">
                <h2>Digital Learning Support Officer</h2>
                
                <h3 class="ref-no">Reference Number: DLR01</h3>

                <h4>Short Description</h4>
                <p class="short-description">
                    Provide technical and user support for digital learning platforms,
                    helping staff and students deliver and access online education effectively.
                </p>

                <h4>Salary</h4>
                <ul>
                    <li>$5,000 AUD – $6,250 AUD per month</li>
                </ul>

                <h4>Reporting Line</h4>
                <ul>
                    <li>Reports to the Digital Learning Manager</li>
                </ul>

                <h4>Key Responsibilities</h4>
                <ol>
                    <li>Support academic staff in using the LMS</li>
                    <li>Troubleshoot technical issues</li>
                    <li>Assist with setting up online classes and materials</li>
                    <li>Provide training to users</li>
                    <li>Monitor system performance</li>
                </ol>

                <h4>Essential Requirements</h4>
                <ol>
                    <li>Diploma/Degree in IT, Computer Science, or related field</li>
                    <li>Basic knowledge of web technologies</li>
                    <li>Strong problem-solving skills</li>
                    <li>Good communication skills</li>
                </ol>

                <h4>Preferable Requirements</h4>
                <ol>
                    <li>Experience with LMS platforms (Moodle, Blackboard)</li>
                    <li>Prior IT support experience</li>
                    <li>Familiarity with online tools (Zoom, Teams)</li>
                </ol>

                <div class="apply-box">
                    <a href="apply.php" class="apply-now" style="font-size:large">Apply Now</a>
                </div>
            </section>

            <!-- ============================================== -->
            <!-- JOB 2: LMS Administrator                        -->
            <!-- ============================================== -->
            <section id="admin" class="job">
                <h2>Learning Management System (LMS) Administrator</h2>
                
                <h3 class="ref-no">Reference Number: LMS02</h3>

                <h4>Short Description</h4>
                <p class="short-description">
                    Manage and maintain the university's Learning Management System
                    to ensure reliable and efficient operation.
                </p>

                <h4>Salary</h4>
                <ul>
                    <li>$5,800 AUD – $7,500 AUD per month</li>
                </ul>

                <h4>Reporting Line</h4>
                <ul>
                    <li>Reports to the Head of IT Services</li>
                </ul>

                <h4>Key Responsibilities</h4>
                <ol>
                    <li>Maintain and update LMS platform</li>
                    <li>Manage user accounts and permissions</li>
                    <li>Ensure system security and backups</li>
                    <li>Troubleshoot system issues</li>
                    <li>Work with academic staff on system improvements</li>
                </ol>

                <h4>Essential Requirements</h4>
                <ol>
                    <li>Degree in IT or related field</li>
                    <li>Knowledge of system administration</li>
                    <li>Understanding of web systems</li>
                    <li>Strong analytical skills</li>
                </ol>

                <h4>Preferable Requirements</h4>
                <ol>
                    <li>Experience managing LMS platforms</li>
                    <li>Knowledge of databases and servers</li>
                    <li>Experience in higher education IT systems</li>
                </ol>

                <div class="apply-box">
                    <a href="apply.php" class="apply-now" style="font-size:large">Apply Now</a>
                </div>
            </section>

            <!-- ============================================== -->
            <!-- JOB 3: Research Technology Assistant            -->
            <!-- ============================================== -->
            <section id="research" class="job">
                <h2>Research Technology Assistant</h2>
                
                <h3 class="ref-no">Reference Number: RES03</h3>

                <h4>Short Description</h4>
                <p class="short-description">
                    Support researchers by managing software, systems,
                    and data tools used in academic research.
                </p>

                <h4>Salary</h4>
                <ul>
                    <li>$6,200 AUD – $7,900 AUD per month</li>
                </ul>

                <h4>Reporting Line</h4>
                <ul>
                    <li>Reports to the Research Systems Coordinator</li>
                </ul>

                <h4>Key Responsibilities</h4>
                <ol>
                    <li>Provide support for research software</li>
                    <li>Assist with data handling and storage</li>
                    <li>Troubleshoot system issues</li>
                    <li>Help set up research tools</li>
                    <li>Maintain documentation</li>
                </ol>

                <h4>Essential Requirements</h4>
                <ol>
                    <li>Degree in IT, Computer Science, or related field</li>
                    <li>Understanding of databases/data handling</li>
                    <li>Attention to detail</li>
                    <li>Ability to work independently and in a team</li>
                </ol>

                <h4>Preferable Requirements</h4>
                <ol>
                    <li>Experience with data tools (Excel, Python)</li>
                    <li>Knowledge of research systems</li>
                    <li>Experience in academic environments</li>
                </ol>

                <div class="apply-box">
                    <a href="apply.php" class="apply-now" style="font-size:large">Apply Now</a>
                </div>
            </section>

        </div><!-- End .available-jobs -->
    </main>

    <?php include 'footer.inc'; ?>
</body>
</html>