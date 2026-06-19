<?php
session_start();

if (!isset($_SESSION['manager_logged_in']) || $_SESSION['manager_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'settings.php';

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$action_message = "";
$action_type    = "";  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = trim($_POST['action'] ?? '');

    // Delete all EOIs by job reference
    if ($action == 'delete_by_jobref') {
        $jobref = trim(stripslashes(htmlspecialchars($_POST['del_jobref'] ?? '')));
        if (empty($jobref)) {
            $action_message = "Please enter a job reference to delete.";
            $action_type    = "error";
        } else {
            $stmt = $conn->prepare("DELETE FROM eoi WHERE jobref = ?");
            $stmt->bind_param("s", $jobref);
            $stmt->execute();
            $rows = mysqli_stmt_affected_rows($stmt);
            $stmt->close();
            $action_message = "$rows EOI record(s) for job reference '" . htmlspecialchars($jobref) . "' deleted.";
            $action_type    = "success";
        }
    }

    // Change EOI status
    elseif ($action == 'change_status') {
        $eoi_number = intval($_POST['eoi_number'] ?? 0);
        $new_status = trim($_POST['new_status'] ?? '');
        $allowed_statuses = ['New', 'Current', 'Final'];

        if ($eoi_number <= 0 || !in_array($new_status, $allowed_statuses)) {
            $action_message = "Invalid EOI number or status.";
            $action_type    = "error";
        } else {
            $stmt = $conn->prepare("UPDATE eoi SET status = ? WHERE EOInumber = ?");
            $stmt->bind_param("si", $new_status, $eoi_number);
            $stmt->execute();
            $rows = mysqli_stmt_affected_rows($stmt);
            $stmt->close();
            if ($rows > 0) {
                $action_message = "EOI $eoi_number status updated to '$new_status'.";
                $action_type    = "success";
            } else {
                $action_message = "EOI $eoi_number not found.";
                $action_type    = "error";
            }
        }
    }
}

// Filtering
$filter_jobref    = trim(stripslashes($_GET['filter_jobref']    ?? ''));
$filter_firstname = trim(stripslashes($_GET['filter_firstname'] ?? ''));
$filter_lastname  = trim(stripslashes($_GET['filter_lastname']  ?? ''));
$sort_field       = $_GET['sort_field'] ?? 'EOInumber';
$sort_dir         = ($_GET['sort_dir'] ?? 'ASC') == 'DESC' ? 'DESC' : 'ASC';

// Whitelist sortable columns to prevent SQL injection
$allowed_sort = [
    'EOInumber','jobref','fname','lname',
    'dob','gender','email','status', 'street', 'suburb', 'state', 'postcode'
];

if (!in_array($sort_field, $allowed_sort)) {
    $sort_field = 'EOInumber';
}

// WHERE clauses
$where_parts  = [];
$bind_types   = '';
$bind_values  = [];

if ($filter_jobref !== '') {
    $where_parts[] = "jobref = ?";
    $bind_types   .= 's';
    $bind_values[] = $filter_jobref;
}
if ($filter_firstname !== '') {
    $where_parts[] = "fname LIKE ?";
    $bind_types   .= 's';
    $bind_values[] = '%' . $filter_firstname . '%';
}
if ($filter_lastname !== '') {
    $where_parts[] = "lname LIKE ?";
    $bind_types   .= 's';
    $bind_values[] = '%' . $filter_lastname . '%';
}

if (count($where_parts) > 0) {
    $where_sql = "WHERE " . implode(" AND ", $where_parts);
} else {
    $where_sql = "";
}
$sql = "SELECT * FROM eoi $where_sql ORDER BY `$sort_field` $sort_dir";

$eois = [];
if (count($bind_values) > 0) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($bind_types, ...$bind_values);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $eois[] = $row;
    }
    $stmt->close();
} else {
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $eois[] = $row;
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage EOIs | NextGenDevs</title>
    <link rel="icon" type="image/x-icon" href="images/logo.ico">
    <link rel="stylesheet" href="styles/styles.css?v=<?= filemtime('styles/styles.css') ?>">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--purple-inkk);
        }
    </style>
</head>

<body>
<!-- header navigation -->
<header>
    <a href="index.php" class="logo">
        <img src="images/logo.png" alt="NextGen Devs logo" loading="eager">
        <span>NextGen Devs</span>
    </a>

    <nav aria-label="Main navigation">
        <ul class="nav-content">
            <li><span>Welcome, <?= htmlspecialchars($_SESSION['manager_username']) ?></span></li>
            <li><a href="logout.php?logout=1" class="btn-logout">Sign out</a></li>
        </ul>
    </nav>
</header>

<!-- Main content -->
<main class="page-wrapper">

    <section class="page-header">
        <h1>EOI Manager Dashboard</h1>
        <p>View, filter, and manage all Expressions of Interest.</p>
    </section>

    <!-- Alert message from POST actions -->
    <?php if (!empty($action_message)): ?>
    <div class="alert alert-<?= $action_type == 'success' ? 'success' : 'error' ?>">
        <?= htmlspecialchars($action_message) ?>
    </div>
    <?php endif; ?>

    <!-- Action panels  -->
    <div class="panels-grid">
        <!-- Filter / search -->
        <div class="panel">
            <div class="panel-title">
                <span class="panel-title-dot"></span>
                Filter &amp; Sort EOIs
            </div>
            <form method="GET" action="manage.php" novalidate>
                <div class="filter-row">
                    <div class="filter-group" aria-labelledby="filter-jobref">
                        <label for="filter-jobref">Job Reference</label>
                        <select id="filter-jobref" name="filter-jobref">
                            <option value="" disabled selected hidden>-- Please Select --</option>
                            <option value="dlr01">DLR01</option>
                            <option value="lms02">LMS02</option>
                            <option value="res03">RES03</option>
                        </select>
                    </div>

                    <div class="filter-group" aria-labelledby="filter-firstname">
                        <label for="filter-firstname">First Name</label>
                        <input type="text" id="filter-firstname" name="filter-firstname"
                               placeholder="Search..."
                               value="<?= htmlspecialchars($filter_firstname) ?>">
                    </div>

                    <div class="filter-group" aria-labelledby="filter-lastname">
                        <label for="filter-lastname">Last Name</label>
                        <input type="text" id="filter-lastname" name="filter-lastname"
                               placeholder="Search..."
                               value="<?= htmlspecialchars($filter_lastname) ?>">
                    </div>

                    <div class="filter-group" aria-labelledby="sort-field">
                        <label for="sort-field">Sort By</label>
                        <select id="sort-field" name="sort-field">
                            <?php
                            $sort_options = [
                                'EOInumber' => 'EOI Number',
                                'jobref' => 'Job Reference',
                                'fname' => 'First Name',
                                'lname' => 'Last Name',
                                'gender' => 'Gender',
                                'street' => 'Street',
                                'suburb' => 'Suburb',
                                'state' => 'State',
                                'postcode' => 'Postcode',
                                'email' => 'Email',
                                'status' => 'Status',
                            ];
                            foreach ($sort_options as $val => $label):
                                $sel = $sort_field == $val ? 'selected' : '';
                            ?>
                            <option value="<?= $val ?>" <?= $sel ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="filter-group" aria-labelledby="sort-dir">
                        <label for="sort-dir">Order</label>
                        <select id="sort-dir" name="sort-dir">
                            <option value="ASC"  <?= $sort_dir == 'ASC'  ? 'selected' : '' ?>>Ascending</option>
                            <option value="DESC" <?= $sort_dir == 'DESC' ? 'selected' : '' ?>>Descending</option>
                        </select>
                    </div>

                    <div class="filter-group filter-action">
                        <label for="apply-btn" class="label-spacer">x</label>
                        <div class="btn-row">
                            <button type="submit" class="btn btn-primary" id="apply-btn">Apply</button>
                            <a href="manage.php" class="btn btn-outline">Reset</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Delete by job reference -->
        <div class="panel">
            <div class="panel-title">
                <span class="panel-title-dot"></span>
                Delete EOIs by Job Reference
            </div>
            <form method="POST" action="manage.php" novalidate
                  onsubmit="return confirm('Delete ALL EOIs for this job reference? This cannot be undone.');">
                <input type="hidden" name="action" value="delete-by-jobref">
                <div class="filter-row">
                    <div class="filter-group" aria-labelledby="del-jobref">
                        <label for="del-jobref">Job Reference</label>
                        <select id="del-jobref" name="del-jobref">
                            <option value="" disabled selected hidden>-- Please Select --</option>
                            <option value="dlr01">DLR01</option>
                            <option value="lms02">LMS02</option>
                            <option value="res03">RES03</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="del-btn" class="label-spacer">x</label>
                        <button type="submit" class="btn btn-danger" id="del-btn">Delete All</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Change EOI status -->
        <div class="panel">
            <div class="panel-title">
                <span class="panel-title-dot"></span>
                Change EOI Status
            </div>
            <form method="POST" action="manage.php" novalidate>
                <input type="hidden" id="hidden" name="action" value="change-status">
                <div class="filter-row">
                    <div class="filter-group" aria-labelledby="eoi-number">
                        <label for="eoi-number">EOI Number</label>
                        <input type="number" id="eoi-number" name="eoi-number" placeholder="e.g. 12" min="1">
                    </div>
                    <div class="filter-group" aria-labelledby="new-status">
                        <label for="new-status">New Status</label>
                        <select id="new-status" name="new-status">
                            <option value="New">New</option>
                            <option value="Current">Current</option>
                            <option value="Final">Final</option>
                        </select>
                    </div>
                    <div class="filter-group" style="flex:0 0 auto;">
                        <label for="update-btn" class="label-spacer">x</label>
                        <button type="submit" class="btn btn-amber" id="update-btn">Update</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <!-- ─── Results table ─── -->
    <div class="results-header">
        <span class="results-count">
            <h2>EOI Table: </h2>
            Showing <strong><?= count($eois) ?></strong> record<?= count($eois) !== 1 ? 's' : '' ?>
            <?php if ($filter_jobref || $filter_firstname || $filter_lastname): ?>
                (filtered)
            <?php endif; ?>
        </span>
    </div>

    <div class="table-wrapper">
        <table class="eoi-table">
            <caption></caption>
            <thead>
                <tr>
                    <th>EOI #</th>
                    <th>Job Ref</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Street</th>
                    <th>Suburb</th>
                    <th>State</th>
                    <th>Postcode</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Skill</th>
                    <th>Others</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($eois)): ?>
                <tr>
                    <td colspan="12">
                        <div class="empty-state">
                            <p>📭</p>
                            <p>No EOI records found<?= ($filter_jobref || $filter_firstname || $filter_lastname) ? ' matching your filters' : '' ?>.</p>
                        </div>
                    </td>
                </tr>

            <?php else: ?>
                <?php foreach ($eois as $eoi): ?>
                <?php
                    $status = $eoi['status'] ?? 'New';
                    $badge_class = match($status) {
                        'Current' => 'badge-current',
                        'Final'   => 'badge-final',
                        default   => 'badge-new',
                    };
                ?>
                <tr>
                    <td><?= htmlspecialchars($eoi['EOInumber']) ?></td>
                    <td><?= htmlspecialchars($eoi['jobref']) ?></td>
                    <td><?= htmlspecialchars($eoi['fname']) ?></td>
                    <td><?= htmlspecialchars($eoi['lname']) ?></td>
                    <td><?= htmlspecialchars($eoi['dob'] ?? '') ?></td>
                    <td><?= htmlspecialchars($eoi['gender'] ?? '') ?></td>
                    <td><?= htmlspecialchars($eoi['street'] ?? '') ?></td>
                    <td><?= htmlspecialchars($eoi['suburb'] ?? '') ?></td>
                    <td><?= htmlspecialchars($eoi['state'] ?? '') ?></td>
                    <td><?= htmlspecialchars($eoi['postcode'] ?? '') ?></td>
                    <td><?= htmlspecialchars($eoi['phone'] ?? '') ?></td>
                    <td><?= htmlspecialchars($eoi['email']) ?></td>
                    <td><?= htmlspecialchars($eoi['skill']) ?></td>
                    <td><?= htmlspecialchars($eoi['others']) ?></td>
                    <td><span class="badge <?= $badge_class ?>"><?= htmlspecialchars($status) ?></span></td>
                    <td>
                        <!-- Inline quick-change status form per row -->
                        <form method="POST" action="manage.php" class="status-form" novalidate>
                            <input type="hidden" name="action"     value="change_status">
                            <input type="hidden" name="eoi_number" value="<?= intval($eoi['EOInumber']) ?>">
                            <select name="new_status">
                                <option value="New"     <?= $status == 'New'     ? 'selected' : '' ?>>New</option>
                                <option value="Current" <?= $status == 'Current' ? 'selected' : '' ?>>Current</option>
                                <option value="Final"   <?= $status == 'Final'   ? 'selected' : '' ?>>Final</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include 'footer.inc';?>

</body>
</html>