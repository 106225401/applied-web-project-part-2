<!--Job Application Page-->

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Apply for positions in the Digital Learning and Innovation (DLI) Department at NextGen Devs University.">
        <meta name="keywords" content="university jobs, job application, IT careers, digital learning, innovation, research">
        <meta name="author" content="Jingyee">

        <!-- Tab bar: title and icon -->
        <title>Job Application</title>
        <link rel="icon" type="image/x-icon" href="images/logo.ico">

        <!-- Link to external CSS -->
        <link rel="stylesheet" href="styles.css">

        <!-- Embedded CSS styling -->
        <style>
            /* Global Text Selection Style */
            ::selection {
                background: var(--purple-inkk);
                color: white;
            }

            /* Job Help Link Interaction */
            #job-help a {
                font-weight: bold;
                font-size: 0.8rem;
                color: inherit;
                text-decoration: none;
            }

            #job-help a:hover {
                color: var(--purple-blue);
                text-decoration: underline;
            }

            /* Job Help List Item Sizing */
            #job-help ul li { font-size: 0.75rem; }
        </style>
    </head>

    <body>
        <!-- Skip link for keyboard users -->
        <a href="#main" class="skip-link">Skip to main content</a>

        <header>
            <!-- Top bar logo -->
            <a href="index.html" class="logo">
                <img src="images/logo.png" alt="NextGen Devs logo" loading="eager">
                <span>NextGen Devs</span>
            </a>

            <!-- Common navigation menu -->
            <nav aria-label="Main navigation">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="jobs.html">Jobs</a></li>
                    <li><a href="apply.html">Apply</a></li>
                    <li><a href="about.html">About Us</a></li>
                </ul>
            </nav>
        </header>

        <main id="main">
            <!-- Form heading: page title and call-to-action -->
            <section class="apply-heading">
                <h1 id="apply-title">Job Application Form</h1>
                <a href="#application-form" class="cta-btn">Apply Now</a>
            </section>

            <nav class="short-keys" aria-label="Job application form sections">
                <ul>
                    <li><a href="#job">Job</a></li>
                    <li><a href="#applicant-details">Details</a></li>
                    <li><a href="#skills">Skills</a></li>
                </ul>
            </nav>

            <form id="application-form" aria-labelledby="apply-title"
                action="https://mercury.swin.edu.au/it000000/formtest.php" method="post">

                <!-- Position selection section -->
                <section id="job" class="form-section" aria-labelledby="job-title">
                    <h2 id="job-title">Position to Apply For</h2>

                    <label for="jobref">Job Reference Number:</label>
                    <input type="text" id="jobref" name="jobref"
                        pattern="^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]{5}$"
                        aria-describedby="job-help"
                        required>
                    <span class="error-text">Please enter a valid job reference number (refer to the available positions).</span>

                    <div id="job-help" style="color: var(--purple-gray);">
                        <a href="jobs.html">Available positions:</a>
                        <ul>
                            <li>DLR01 - Digital Learning Support Officer</li>
                            <li>LMS02 - Learning Management System (LMS) Administrator</li>
                            <li>RES03 - Research Technology Assistant</li>
                        </ul>
                    </div>
                </section>

                <!-- Applicant details section -->
                <section id="applicant-details" class="form-section" aria-labelledby="details-title">
                    <h2 id="details-title">Applicant Details</h2>

                    <fieldset>
                        <legend>Personal Information</legend>

                        <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="fname"
                            autocomplete="given-name"
                            pattern="[A-Za-z ]{1,20}" maxlength="20"
                            title="Format: max 20 alpha characters"
                            required>
                        <span class="error-text">Please enter up to 20 letters only (no numbers or symbols).</span>

                        <label for="lname">Last Name:</label>
                        <input type="text" id="lname" name="lname"
                            autocomplete="family-name"
                            pattern="[A-Za-z ]{1,20}" maxlength="20"
                            title="Format: max 20 alpha characters"
                            required>
                        <span class="error-text">Please enter up to 20 letters only (no numbers or symbols).</span>

                        <label for="dob">Date of Birth:</label>
                        <input type="text" id="dob" name="dob"
                            autocomplete="bday"
                            placeholder="dd/mm/yyyy"
                            pattern="(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/[0-9]{4}"
                            title="Format: dd/mm/yyyy"
                            required>
                        <span class="error-text">Please enter your date of birth in DD/MM/YYYY format.</span>

                        <fieldset>
                            <legend>Gender</legend>

                            <div>
                                <input type="radio" id="male" name="gender" value="male" required>
                                <label for="male">Male</label>
                            </div>

                            <div>
                                <input type="radio" id="female" name="gender" value="female">
                                <label for="female">Female</label>
                            </div>

                            <div>
                                <input type="radio" id="prefer-not-to-say" name="gender" value="prefer-not-to-say">
                                <label for="prefer-not-to-say">Prefer not to say</label>
                            </div>

                            <span class="error-text">Please select a gender option.</span>
                        </fieldset>
                    </fieldset>

                    <fieldset>
                        <legend>Address & Contact</legend>

                        <label for="street">Street Address</label>
                        <input type="text" id="street" name="street"
                            autocomplete="address-line1"
                            maxlength="40"
                            title="Format: max 40 characters"
                            required>
                        <span class="error-text">Please enter up to 40 characters only.</span>

                        <label for="suburb">Suburb/Town</label>
                        <input type="text" id="suburb" name="suburb"
                            autocomplete="address-level2"
                            maxlength="40"
                            title="Format: max 40 characters"
                            required>
                        <span class="error-text">Please enter up to 40 characters only.</span>

                        <label for="state">State</label>
                        <select id="state" name="state"
                            autocomplete="address-level1"
                            title="Select State"
                            required>
                            <option value="">-- Please Select --</option>
                            <option value="VIC">VIC</option>
                            <option value="NSW">NSW</option>
                            <option value="QLD">QLD</option>
                            <option value="NT">NT</option>
                            <option value="WA">WA</option>
                            <option value="SA">SA</option>
                            <option value="TAS">TAS</option>
                            <option value="ACT">ACT</option>
                        </select>
                        <span class="error-text">Please select your state.</span>

                        <label for="postcode">Postcode</label>
                        <input type="text" id="postcode" name="postcode"
                            autocomplete="postal-code"
                            pattern="[0-9]{4}"
                            title="Format: exactly 4 digits"
                            required>
                        <span class="error-text">Please enter exactly 4 digits.</span>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"
                            autocomplete="email"                            
                            title="Format: valid email"
                            required>
                        <span class="error-text">Please enter a valid email address.</span>

                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone"
                            autocomplete="tel"
                            pattern="[0-9]{8,12}"
                            title="Format: 8-12 digits"
                            required>
                        <span class="error-text">Please enter a valid phone number with 8–12 digits.</span>
                    </fieldset>
                </section>

                <!-- Skills selection section -->
                <section id="skills" class="form-section" aria-labelledby="skills-title">
                    <h2 id="skills-title">Professional Skills</h2>

                    <fieldset>
                        <legend>Skills</legend>

                        <div class="skill-item">
                            <input type="checkbox" id="excel" name="skill[]" value="excel">
                            <label for="excel">Excel</label>
                        </div>

                        <div class="skill-item">
                            <input type="checkbox" id="mysql" name="skill[]" value="mysql">
                            <label for="mysql">MySQL</label>
                        </div>

                        <div class="skill-item">
                            <input type="checkbox" id="python" name="skill[]" value="python">
                            <label for="python">Python</label>
                        </div>

                        <div class="skill-item">
                            <input type="checkbox" id="java" name="skill[]" value="java">
                            <label for="java">Java</label>
                        </div>

                        <div class="skill-item">
                            <input type="checkbox" id="spss" name="skill[]" value="spss">
                            <label for="spss">SPSS</label>
                        </div>

                        <div class="skill-item">
                            <input type="checkbox" id="other" name="skill[]" value="other" required>
                            <label for="other">Other skills…</label>
                        </div>

                        <span class="error-text">Please select at least one skill.</span>

                        <label for="others">Other Skills</label>
                        <textarea id="others" name="others"
                            placeholder="Write your other skills here..."
                            rows="5" cols="50"></textarea>
                    </fieldset>
                </section>

                <!-- Form submission and reset buttons -->
                <div class="two-btn">
                    <button type="submit">Apply</button>
                    <button type="reset">Reset Form</button>
                </div>
            </form>
        </main>

        <footer>
            <!-- Project links section -->
            <section class="footer-section"  aria-labelledby="project-links-title">
                <h3 id="project-links-title">Project Links</h3>
                <ul>
                    <li>
                        <a href="https://github.com/106225401/applied-web-project-part-1" target="_blank" rel="noopener">
                            GitHub Repository (Source Code)
                            <span class="sr-only">(opens in new window)</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://student-team-cos10026.atlassian.net/jira/software/projects/AWPP1/boards/4" target="_blank" rel="noopener">
                            Jira (Project Management)
                            <span class="sr-only">(opens in new window)</span>
                        </a>
                    </li>
                </ul>
            </section>

            <!-- Navigation menu section -->
            <section class="footer-section" aria-labelledby="quick-links-title">
                <h3 id="quick-links-title">Quick Links</h3>
                <nav aria-label="Footer navigation">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="jobs.html">Jobs</a></li>
                        <li><a href="apply.html">Apply</a></li>
                        <li><a href="about.html">About Us</a></li>
                    </ul>
                </nav>
            </section>

            <!-- Email contact section -->
            <section class="footer-section" aria-labelledby="contact-us-title">
                <h3 id="contact-us-title">Contact Us</h3>
                <p>Email: <a href="mailto:info@nextgen.com" >info@nextgen.com</a></p>
            </section>

            <!-- Copyright-->
            <small class="copyright">Copyright &copy; 2026 NextGen Devs. All rights reserved.</small>
        </footer>
    </body>
</html>