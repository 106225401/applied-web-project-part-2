<!-- About Us page -->

<?php
require_once 'settings.php';
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

$members  = [];
$db_error = '';

if (!$conn) {
    $db_error = 'Unable to load member data right now.';
} else {
    mysqli_set_charset($conn, 'utf8mb4');   // so foreign-language quotes display correctly
    $result = mysqli_query($conn, "SELECT * FROM aboutus ORDER BY id");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $members[] = $row;
        }
    } else {
        $db_error = 'Unable to load member data right now.';
    } 

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="About NextGen Devs: Meet our team, learn more about our members, and discover fun facts & quotes about our group">
    <meta name="keywords" content="nextgen devs, about us, digital learning, innovation, research">
    <meta name="author" content="Ye Htet Aung">

    <title>About Us | NextGenDevs</title>
    <link rel="icon" type="image/x-icon" href="images/logo.ico">

    <link rel="stylesheet" href="styles/styles.css?v=<?php echo time(); ?>">

    <!-- Embedded CSS for UI Styling -->
    <style>
        .prog-lang img {
            display: inline;
            vertical-align: middle;
            margin-left: 1px;
        }
    </style>
</head>

<body>
    <?php include 'header.inc';?>

    <main id="main">
        <!-- Intro to our team -->
        <section class="our-slogan" aria-labelledby="about-our-slogan">
            <h1 id="about-our-slogan">Who We Are</h1>
            <!-- slogan of our team -->
            <blockquote>
                <p><a href="apply.php" target="_blank">"Code, Create, Conquer" </a></p>
                <cite>— NextGen Devs</cite>
            </blockquote>
            <!-- introductory paragraph to our team -->
            <p>We are a team working to build a website for a university department seeking support in digital learning and research.</p>
        </section>

        <!-- Group Details -->
        <section class="group-details" aria-labelledby="group-details-section">
            <h2 id="group-details-section">Group Details</h2>
            
            <ul>
                <!-- Group Name -->
                <li>
                    <strong>Group Name: </strong>
                    <ul>
                        <li>NextGen Devs</li>

                        <li>Department: Digital Learning &amp; Research support</li>

                        <li>University: NextGen University</li>
                    </ul>
                </li>
                
                <!-- Class Schedule -->
                <li>
                    <strong>Course Schedule: </strong> 
                    <ul>
                        <li>COS20007</li>

                        <li>Tuesday: <em>Lecture</em>
                            <ul>
                                <li>2:00 - 4:00 p.m.</li>
                                <li>Block A, Level 8, LH4</li>
                            </ul>
                        </li>

                        <li>Wednesday: <em>Lab</em>
                            <ul>
                                <li>8:00 - 10:00 a.m.</li>
                                <li>Block A, Level 3, CSC2</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                
                <!-- Lecturer Details -->
                <li>
                    <strong>Lecturer &amp; Group Supervisor: </strong>
                    <ul>
                        <li>Name: Pawani Rasaratnam</li>
                        <li>Email: <a href="mailto:ptrasaratnam@swin.edu.au">ptrasaratnam@swin.edu.au</a></li>
                    </ul>
                </li>
            </ul>
        </section>

        <!-- Members Contributions & Details -->
        <section class="contribution" aria-labelledby="members-contribution-section">
            <h2 id="members-contribution-section">Our Members &amp; Contributions</h2>
            
            <!-- Intro paragraph -->
            <p>
                Below are a brief profile of each member, their roles &amp; contributions, and a personal quote.
            </p>

            <!-- Rendering data from database for each member by looping -->
            <dl>
                <?php if ($db_error != ''): ?>
                    <p><?= htmlspecialchars($db_error) ?></p>
                <?php elseif (empty($members)): ?>
                    <p>No member contribution found.</p>
                <?php else: ?>
                    <?php foreach($members as $m): ?>
                    <dt>
                        <span class="name"><strong>Member <?=  htmlspecialchars($m['id']) ?>:</strong> <?= htmlspecialchars($m['full_name']) ?> (<?= htmlspecialchars($m['nickname']) ?>)</span>

                        <span class="id"><?= htmlspecialchars($m['student_id']) ?></span>
                    </dt>

                    <dd>
                        <ul>
                            <li class="roles"><strong>Role:</strong> <?= htmlspecialchars($m['role']) ?></li>
                            <li class="indiv-contrib"><strong>Project Part 1 Responsibility: </strong><?= htmlspecialchars($m['project_part1']) ?></li>
                            <li class="share-contrib"><strong>Project Part 2 Responsibility:</strong><?= htmlspecialchars($m['project_part2']) ?></li>
                            <li class="speak-lang"><strong>Languages:</strong> <?= htmlspecialchars($m['languages']) ?></li>
                            <li class="prog-lang"><strong>Favourite Programming Language:</strong> <?= htmlspecialchars($m['fav_programming']) ?> <img src="<?=htmlspecialchars($m['icon_source'])?>" alt="<?=htmlspecialchars($m['icon_source'])?> logo" style="width: auto; height: 20px; display: inline;"></li>
                        </ul>

                        <blockquote>
                            <p class="tran-quote">" <?= htmlspecialchars($m['quote_translated']) ?> "</p>
                            
                            <p class="og-quote">" <?= htmlspecialchars($m['quote_original']) ?> "</p>
                            
                            <cite>— <?= htmlspecialchars($m['nickname']) ?></cite>
                        </blockquote>
                    </dd>
                    <?php endforeach; ?>
                <?php endif; ?>
            </dl>
        </section>

        <!-- Group Photos -->
        <section class="gp-pic" aria-labelledby="photo-heading">
            <h2 id="photo-heading">Our Team Photos</h2>

            <input type="radio" name="gallery" id="img1" checked hidden>
            <input type="radio" name="gallery" id="img2" hidden>
            <input type="radio" name="gallery" id="img3" hidden>
            <p style="text-align: center;">Click to move to next picture</p>

            <div class="gallery">
                <figure class="pic1">
                    <label for="img2"><img src="images/gpic1.jpeg" alt="Our team members selfie at Bingxue - free style picture 1" loading="lazy"></label>
                    <figcaption>1/3 - Meeting at Bingxue; Selfie 1 <p>From top left to right: Afif and Louis.</p> <p>From bottom left to right: Charlotte and Jingyee</p> </figcaption>
                </figure>

                <figure class="pic2">
                    <label for="img3"><img src="images/gpic2.jpeg" alt="Our team members selfie at Bingxue - free style picture 2" loading="lazy"></label>
                    <figcaption>2/3 - Meeting at Bingxue; Selfie 2 <p>From top left to right: Afif and Louis.</p> <p>From bottom left to right: Charlotte and Jingyee</p></figcaption>
                </figure>

                <figure class="pic3">
                    <label for="img1"><img src="images/gpic3.jpeg" alt="Our team members selfie at Bingxue - free style picture 3" loading="lazy"></label>
                    <figcaption>3/3 - Meeting at Bingxue; Selfie 3 <p>From top left to right: Afif and Louis.</p> <p>From bottom left to right: Charlotte and Jingyee</p></figcaption>
                </figure>
            </div>
        </section>

        <!-- Fun Facts Table -->
        <section class="fun-fact" aria-labelledby="funfacts-section">
            <h2 id="funfacts-section">Fun Facts About Our Team</h2>

            <p>Each of our members has a few amusing facts to share.</p>
            <div class="table-container">
                <table>
                    <caption>Table of Fun Facts</caption>

                    <thead>
                        <tr>
                            <th scope="col">Member</th>
                            <th scope="col">Personality</th>
                            <th scope="col">Hobby</th>
                            <th scope="col">Favourite Animal</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Ng Jing Yee</td>
                            <td>Perfectionist with ridiculously low efficiency</td>
                            <td>Veteran Trailblazer & Silver Wolf main (Honkai: Star Rail)</td>
                            <td>A great lover of wolves</td>
                        </tr>

                        <tr>
                            <td>Eaint Wunna Aung</td>
                            <td>Easygoing &amp; friendly</td>
                            <td>Big fan of Arctic Monkeys songs</td>
                            <td>A proud cat mom of an orange cat</td>
                        </tr>

                        <tr>
                            <td>Ye Htet Aung</td>
                            <td>Introverted &amp; friendly</td>
                            <td>Love to read online manga</td>
                            <td>Owns a lovely dog named Yan Lon</td>
                        </tr>

                        <tr>
                            <td>Amirul Afif</td>
                            <td>Goal-oriented &amp; friendly</td>
                            <td>Playing games, sports, business-minded and keen on financial independence, design fashion</td>
                            <td>A proud lover of cats, gecko, guinea pig, cornsnake</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    
    <?php include 'footer.inc';?>
</body>
</html>