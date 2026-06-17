<!--Job Application Page-->

<?php
<<<<<<< HEAD
    // Start session to retrieve validation errors and previously submitted form data
    session_start();

    // Retrieve validation errors and previously entered form values
    $errors = $_SESSION["errors"] ?? [];
    $user_input = $_SESSION["form_data"] ?? [];

    // Clear session data after retrieving so it doesn't persist on refresh
    unset($_SESSION["errors"]);
    unset($_SESSION["form_data"]);

    // Function to retain selected values after form submission failure (select, radio, checkbox)
=======
    session_start();

    $errors = $_SESSION["errors"] ?? [];
    $user_input = $_SESSION["form_data"] ?? [];

    unset($_SESSION["errors"]);
    unset($_SESSION["form_data"]);

>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
    function check_form_state($type, $field, $value, $user_input)
    {
        if (!isset($user_input[$field])) {
            return '';
        }

<<<<<<< HEAD
        // Dropdown selection
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
        if ($type === 'select' && $user_input[$field] === $value) {
            return 'selected';
        }

<<<<<<< HEAD
        // Radio button selection
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
        if ($type === 'radio' && $user_input[$field] === $value) {
            return 'checked';
        }

<<<<<<< HEAD
        // Checkbox selections (array-based input)
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
        if ($type === 'checkbox' && in_array($value, $user_input[$field])) {
            return 'checked';
        }
    }

<<<<<<< HEAD
    // Function to display validation error messages for each field
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
    function display_error($field, $errors)
    {
        echo "<span class='error-msg'>" . ($errors[$field] ?? '') . "</span>";
    }
?>

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
<<<<<<< HEAD
<<<<<<< HEAD
        <link rel="stylesheet" href="styles/styles.css?v=<?= filemtime('styles/styles.css') ?>">
=======
        <link rel="stylesheet" href="styles/styles.css?v=<?php echo time(); ?>">
>>>>>>> d75c5e4 (Added login.php & logout.php & manage.php & admin.php to create all necessary files for the instructions given at part 6 & 7)
=======
        <link rel="stylesheet" href="styles/styles.css">
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)

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
        <?php include 'header.inc';?>

        <main id="main">
            <!-- Form heading: page title and call-to-action -->
            <section class="apply-heading">
                <h1 id="apply-title">Job Application Form</h1>
                <a href="#application-form" class="cta-btn">Apply Now</a>
            </section>

            <nav class="short-keys" aria-label="Job application form sections">
                <ul>
                    <li><a href="#job">Job</a></li>
                    <li><a href="#applicant-details">Applicant Details</a></li>
                    <li><a href="#skills">Skills</a></li>
                </ul>
            </nav>

            <form id="application-form" aria-labelledby="apply-title"
                action="process_eoi.php" method="post" novalidate>

                <!-- Position selection section -->
                <section id="job" class="form-section" aria-labelledby="job-title">
                    <h2 id="job-title">Position to Apply For</h2>

                    <label for="jobref">Job Reference Number:</label>
                    <select id="jobref" name="jobref"
                        aria-describedby="job-help">
                        <option value="">-- Please Select --</option>
                        <option value="dlr01" <?php echo check_form_state('select', 'jobref', 'dlr01', $user_input); ?>>DLR01</option>
                        <option value="lms02" <?php echo check_form_state('select', 'jobref', 'lms02', $user_input); ?>>LMS02</option>
                        <option value="res03" <?php echo check_form_state('select', 'jobref', 'res03', $user_input); ?>>RES03</option>
                    </select>
                    <?php display_error('jobref', $errors); ?>

                    <div id="job-help" style="color: var(--purple-gray);">
                        <a href="jobs.php">Available positions:</a>
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
                            value="<?php echo $user_input['fname'] ?? ''; ?>"
                            autocomplete="given-name"
                            title="Format: max 20 alpha characters">
                        <?php display_error('fname', $errors); ?>

                        <label for="lname">Last Name:</label>
                        <input type="text" id="lname" name="lname"
                            value="<?php echo $user_input['lname'] ?? ''; ?>"
                            autocomplete="family-name"
                            title="Format: max 20 alpha characters">
                        <?php display_error('lname', $errors); ?>

                        <label for="dob">Date of Birth:</label>
                        <input type="text" id="dob" name="dob"
                            value="<?php echo $user_input['dob'] ?? ''; ?>"
                            autocomplete="bday"
                            placeholder="dd/mm/yyyy"
                            title="Format: dd/mm/yyyy">
                        <?php display_error('dob', $errors); ?>

                        <fieldset>
                            <legend>Gender</legend>

                            <div>
                                <input type="radio" id="male" name="gender" value="male"
                                    <?php echo check_form_state('radio', 'gender', 'male', $user_input); ?>>
<<<<<<< HEAD
                                <label for="male">Male</label>
=======
                                <label for="gender-male">Male</label>
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
                            </div>

                            <div>
                                <input type="radio" id="female" name="gender" value="female"
                                    <?php echo check_form_state('radio', 'gender', 'female', $user_input); ?>>
                                <label for="female">Female</label>
                            </div>

                            <div>
                                <input type="radio" id="prefer-not-to-say" name="gender" value="prefer-not-to-say"
                                    <?php echo check_form_state('radio', 'gender', 'prefer-not-to-say', $user_input); ?>>
                                <label for="prefer-not-to-say">Prefer not to say</label>
                            </div>

                            <?php display_error('gender', $errors); ?>
                        </fieldset>
                    </fieldset>

                    <fieldset>
                        <legend>Address & Contact</legend>

                        <label for="street">Street Address</label>
                        <input type="text" id="street" name="street"
                            value="<?php echo $user_input['street'] ?? ''; ?>"
                            autocomplete="address-line1"
                            title="Format: max 40 characters">
                        <?php display_error('street', $errors); ?>

                        <label for="suburb">Suburb/Town</label>
                        <input type="text" id="suburb" name="suburb"
                            value="<?php echo $user_input['suburb'] ?? ''; ?>"
                            autocomplete="address-level2"
                            title="Format: max 40 characters">
                        <?php display_error('suburb', $errors); ?>

                        <label for="state">State</label>
                        <select id="state" name="state"
                            autocomplete="address-level1"
                            title="Select State">
                            <option value="">-- Please Select --</option>
                            <option value="VIC" <?php echo check_form_state('select', 'state', 'VIC', $user_input); ?>>VIC</option>
                            <option value="NSW" <?php echo check_form_state('select', 'state', 'NSW', $user_input); ?>>NSW</option>
                            <option value="QLD" <?php echo check_form_state('select', 'state', 'QLD', $user_input); ?>>QLD</option>
                            <option value="NT" <?php echo check_form_state('select', 'state', 'NT', $user_input); ?>>NT</option>
                            <option value="WA" <?php echo check_form_state('select', 'state', 'WA', $user_input); ?>>WA</option>
                            <option value="SA" <?php echo check_form_state('select', 'state', 'SA', $user_input); ?>>SA</option>
                            <option value="TAS" <?php echo check_form_state('select', 'state', 'TAS', $user_input); ?>>TAS</option>
                            <option value="ACT" <?php echo check_form_state('select', 'state', 'ACT', $user_input); ?>>ACT</option>
                        </select>
                        <?php display_error('state', $errors); ?>

                        <label for="postcode">Postcode</label>
                        <input type="text" id="postcode" name="postcode"
                            value="<?php echo $user_input['postcode'] ?? ''; ?>"
                            autocomplete="postal-code"
                            title="Format: exactly 4 digits">
                        <?php display_error('postcode', $errors); ?>

                        <label for="email">Email</label>
                        <input type="text" id="email" name="email"
                            value="<?php echo $user_input['email'] ?? ''; ?>"
                            autocomplete="email"                            
                            title="Format: valid email">
                        <?php display_error('email', $errors); ?>

                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone"
                            value="<?php echo $user_input['phone'] ?? ''; ?>"
                            autocomplete="tel"
                            title="Format: 8-12 digits">
                        <?php display_error('phone', $errors); ?>
                    </fieldset>
                </section>

                <!-- Skills selection section -->
                <section id="skills" class="form-section" aria-labelledby="skills-title">
                    <h2 id="skills-title">Professional Skills</h2>

                    <fieldset>
                        <legend>Skills</legend>

                        <div class="skill-item">
                            <input type="checkbox" id="excel" name="skill[]" value="excel"
                                <?php echo check_form_state('checkbox', 'skill', 'excel', $user_input); ?>>
                            <label for="excel">Excel</label>
                        </div>

                        <div class="skill-item">
                            <input type="checkbox" id="mysql" name="skill[]" value="mysql"
                                <?php echo check_form_state('checkbox', 'skill', 'mysql', $user_input); ?>>
                            <label for="mysql">MySQL</label>
                        </div>

                        <div class="skill-item">
                            <input type="checkbox" id="python" name="skill[]" value="python"
                                <?php echo check_form_state('checkbox', 'skill', 'python', $user_input); ?>>
                            <label for="python">Python</label>
                        </div>

                        <div class="skill-item">
                            <input type="checkbox" id="java" name="skill[]" value="java"
                                <?php echo check_form_state('checkbox', 'skill', 'java', $user_input); ?>>
                            <label for="java">Java</label>
                        </div>

                        <div class="skill-item">
                            <input type="checkbox" id="spss" name="skill[]" value="spss"
                                <?php echo check_form_state('checkbox', 'skill', 'spss', $user_input); ?>>
                            <label for="spss">SPSS</label>
                        </div>

                        <div class="skill-item">
                            <input type="checkbox" id="other" name="skill[]" value="other"
                                <?php echo check_form_state('checkbox', 'skill', 'other', $user_input); ?>>
                            <label for="other">Other skills…</label>
                        </div>

                        <?php display_error('skill', $errors); ?>

                        <label for="others">Other Skills</label>
                        <textarea id="others" name="others"
                            placeholder="Write your other skills here..."
                            rows="5" cols="50"
                            ><?php echo $user_input['others'] ?? ''; ?></textarea>
                    </fieldset>
                </section>

                <!-- Form submission and reset buttons -->
                <div class="two-btn">
                    <button type="submit">Apply</button>
<<<<<<< HEAD
                    <!-- Reset form by reloading page without session data -->
=======
>>>>>>> a0f5845 (Added the modified php files for manage.php and process_eoi.php and apply.php and styles.css)
                    <a href="apply.php">Reset Form</a>
                </div>
            </form>
        </main>

        <?php include 'footer.inc';?>
    </body>
</html>