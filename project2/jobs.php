<?php
require_once "settings.php";
$dbconn =@mysqli_connect($host, $user, $pwd, $sql_db);

if($dbconn){
    $query = "SELECT* FROM jobs ORDER by job_id";
    $result = mysqli_query($dbconn, $query);

    if($result){
        $jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
        $jobs = [];
    }

    mysqli_close($dbconn);
}else{
    $jobs = [];
    echo "<p>Unable to connect to the database </p>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Apply for positions in the Digital Learning and Innovation (DLI) Department at NextGen Devs University.">
        <meta name="keywords" content="university jobs, job application, IT careers, digital learning, innovation, research">
        <meta name="author" content="Charlotte">

        <title>Available Job Positions</title>
        <link rel="icon" type="image/x-icon" href="images/logo.ico">

        <link rel="stylesheet" href="styles/styles.css?v=<?php echo time(); ?>">

        <!-- Embedded CSS for UI Styling -->
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
    <?php include 'header.inc';?>

    <main id="main">
        <h1 class="jobs-heading">Available Job Positions</h1>        
        <div class="short-keys">
            <nav aria-label="Job Position Description Anchor Links">
                <ul>
                    <!-- CHANGES --> 
                    <?php foreach ($jobs as $job): ?>
                        <li><a href="#<?php echo htmlspecialchars($job['anchor_slug']); ?>"><?php echo htmlspecialchars($job['title']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
        
        <!-- a side note about benefits -->
        <aside class="job-aside">
            <h2>Benefits</h2>
            <ul>
                <li>
                    Flexible working hours
                </li>
                <li>
                    Professional development opportunities
                </li>
                <li>
                    University staff discounts
                </li>
                <li>
                    Access to research tools and systems
                </li>
            </ul>
        </aside>

        <div class="available-jobs">
            
            <section id="digital" class="job">   <!-- CHANGES -->
                <?php foreach ($jobs as $job): ?>
            <section id="<?php echo htmlspecialchars($job['anchor_slug']); ?>" class="job">
                <h2><?php echo htmlspecialchars($job['title']); ?></h2>
                <h3>Reference Number: <?php echo htmlspecialchars($job['reference_number']); ?></h3>

                <h4>Short Description</h4>
                <p class="short-description"><?php echo htmlspecialchars($job['short_description']); ?></p>

                <h4>Salary</h4>
                <ul>
                    <!-- CHANGES -->
                    <li>
                        $<?php echo number_format($job['salary_min']); ?> <?php echo htmlspecialchars($job['salary_currency']); ?>
                        – $<?php echo number_format($job['salary_max']); ?> <?php echo htmlspecialchars($job['salary_currency']); ?>
                        <?php echo htmlspecialchars($job['salary_period']); ?>
                    </li>
                </ul>
                <h4>
                    Reporting Line
                </h4>
                <ul>
                    <li><?php echo htmlspecialchars($job['reporting_line']); ?></li>  <!-- CHANGES -->
                </ul>
                <h4>
                    Key Responsibilities
                </h4>
                <ol>
                    <li>
                    <?php foreach (explode('|', $job['key_responsibilities']) as $item): ?>  <!-- CHANGES -->
                        <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                    </li>
                </ol>
                <h4>
                    Essential Requirements
                </h4>
                <ol>
                    <?php foreach (explode('|', $job['essential_requirements']) as $item): ?> <!-- CHANGES -->
                        <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ol>
                <h4>
                    Preferable Requirements
                </h4>
                <ol>  <!-- CHANGES -->
                <?php foreach (explode('|', $job['preferable_requirements']) as $item): ?>
                        <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ol>
                <div class="apply-box">
                    <a href="apply.php?ref=<?php echo urlencode($job['reference_number']); ?>" class="apply-now" style="font-size:large">Apply Now</a>  <!-- CHANGES -->
                </div>
            
            </section>

        <?php endforeach; ?>
        </div>
    </main>

    <?php include 'footer.inc';?>
</body>
</html>