<?php
include('db.php');
include('header_loggedin.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$admin_id = $_SESSION['user_id'];

if (isset($_GET['approve'])) {
    $access_id = $_GET['approve'];
    $stmt = $pdo->prepare("UPDATE course_access SET access_status = 'approved' WHERE id = :id");
    $stmt->execute(['id' => $access_id]);
    echo "<script>alert('Access approved.'); window.location.href='admin_dashboard.php';</script>";
}

if (isset($_GET['deny'])) {
    $access_id = $_GET['deny'];
    $stmt = $pdo->prepare("UPDATE course_access SET access_status = 'denied' WHERE id = :id");
    $stmt->execute(['id' => $access_id]);
    echo "<script>alert('Access denied.'); window.location.href='admin_dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:nth-of-type(odd) {
            background-color: #e9ecef;
        }
        .table tbody tr:hover {
            background-color: #dee2e6;
        }
        .btn {
            font-size: 14px;
        }
        .btn-approve {
            background-color: #28a745;
            color: white;
        }
        .btn-deny {
            background-color: #dc3545;
            color: white;
        }
        .btn-approve:hover, .btn-deny:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Course Access Requests</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>User ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Course ID</th>
                        <th>Course Title</th>
                        <th>Request Date</th>
                        <th>Access Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $sql = "SELECT a.id, a.user_id, a.course_id, a.requested_at, a.access_status, c.course_title, u.first_name, u.last_name
                                FROM course_access a
                                JOIN courses c ON a.course_id = c.course_id
                                JOIN users u ON a.user_id = u.id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($requests) {
                            foreach ($requests as $request) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($request['id']) . '</td>';
                                echo '<td>' . htmlspecialchars($request['user_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($request['last_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($request['first_name']) . '</td>';

                                echo '<td>' . htmlspecialchars($request['course_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($request['course_title']) . '</td>';
                                echo '<td>' . htmlspecialchars($request['requested_at']) . '</td>';
                                echo '<td>' . htmlspecialchars($request['access_status']) . '</td>';
                                echo '<td>';
                                if ($request['access_status'] === 'pending') {
                                    echo '<a href="?approve=' . htmlspecialchars($request['id']) . '" class="btn btn-approve btn-sm">Approve</a> ';
                                    echo '<a href="?deny=' . htmlspecialchars($request['id']) . '" class="btn btn-deny btn-sm">Deny</a>';
                                } else {
                                    echo 'N/A';
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="9">No requests available.</td></tr>';
                        }
                    } catch (PDOException $e) {
                        echo '<tr><td colspan="9">Error: ' . $e->getMessage() . '</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php include('footer.php'); ?>


kkkkkkkkkkkkkkk

<?php
// Start session and include necessary files

include('db.php');
include('header.php');

// Check if the user is logged in and has the role of 'admin'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch comments from the database (assuming the table is 'comments')
try {
    $sql = "SELECT * FROM comments";  // Replace with your actual query
    $stmt = $pdo->query($sql);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch all comments
} catch (PDOException $e) {
    die('Error: ' . htmlspecialchars($e->getMessage()));
}

// Ensure comments is set and is an array
if (!isset($comments) || !is_array($comments)) {
    $comments = [];  // Initialize as an empty array to avoid errors
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .dashboard-container {
            margin-top: 30px;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .title-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .title-section h1 {
            color: #007bff;
            font-size: 2.5rem;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            display: inline-block;
        }
        .button-container {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .button-container .btn {
            width: 250px;
            margin-bottom: 15px;
        }
        .admin-comments {
            padding: 20px;
        }
        .admin-comments table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-comments table, .admin-comments th, .admin-comments td {
            border: 1px solid #ddd;
        }
        .admin-comments th, .admin-comments td {
            padding: 10px;
            text-align: left;
        }
        .admin-comments th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<div class="container dashboard-container">
    <div class="title-section">
        <h1>Admin Dashboard</h1>
    </div>

    <div class="button-container">
        <!-- Courses Management -->
        <a href="add_courses.php" class="btn btn-primary">Add Course</a>
        <a href="update_course.php" class="btn btn-warning">Update Course</a>
        <a href="remove_course.php" class="btn btn-danger">Remove Course</a>
        <a href="courses.php" class="btn btn-info">View Courses</a>

        <!-- Users Management -->
        <a href="add_user.php" class="btn btn-primary">Add User</a>
        <a href="edit_user.php" class="btn btn-warning">Update User</a>
        <a href="remove_user.php" class="btn btn-danger">Remove User</a>
        <a href="list_users.php" class="btn btn-info">View Users</a>

        <!-- Staff Management -->
        <a href="add_staff.php" class="btn btn-primary">Add Staff</a>
        <a href="update_staff.php" class="btn btn-warning">Update Staff</a>
        <a href="remove_staff.php" class="btn btn-danger">Remove Staff</a>
        <a href="list_staff.php" class="btn btn-info">View Staff</a>

        <!-- Students Management -->
        <a href="register.php" class="btn btn-primary">Add Student</a>
        <a href="update_student.php" class="btn btn-warning">Update Student</a>
        <a href="remove_student.php" class="btn btn-danger">Remove Student</a>
        <a href="list_students.php" class="btn btn-info">View Students</a>

        <!-- Exams Management -->
        <a href="add_exam.php" class="btn btn-primary">Add Exam</a>
        <a href="update_exam.php" class="btn btn-warning">Update Exam</a>
        <a href="remove_exam.php" class="btn btn-danger">Remove Exam</a>
        <a href="exam_selection.php" class="btn btn-info">View Exams</a>

        <!-- Payment Status -->
        <a href="update_payment.php" class="btn btn-success">Update Payment Status</a>
    </div>

    <div class="admin-comments">
        <h1>Comments Report</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Video ID</th>
                    <th>User Name</th>
                    <th>Comment</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <tr>
                            <td><?= htmlspecialchars($comment['user_id']); ?></td>
                            <td><?= htmlspecialchars($comment['video_id']); ?></td>
                            <td><?= htmlspecialchars($comment['user_name']); ?></td>
                            <td><?= htmlspecialchars($comment['comment_text']); ?></td>
                            <td><?= htmlspecialchars($comment['created_at']); ?></td>
                            <td>
                                <form action="delete-comment.php" method="post" style="display:inline;">
                                   
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No comments found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include('footer.php'); ?>

</body>
</html>

kkkkkkkkkkkk
<?php
// Start the session and include necessary files

include('db.php');
include('header.php'); // Ensure this file exists in the same directory

// Check if the user is logged in and has the role of 'admin'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch course details if 'id' is set in the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    $sql = "SELECT * FROM courses WHERE video_id = :video_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':video_id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        $course = $stmt->fetch();
    } else {
        print_r($stmt->errorInfo());
    }

    // Check if course exists
    if (!$course) {
        die('Course not found');
    }
}

// Fetch users for the dropdown menu
$users_sql = "SELECT * FROM users"; // Adjust table name as needed
$users_stmt = $conn->prepare($users_sql);
$users_stmt->execute();
$users = $users_stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add any custom styles you need here */
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Dashboard</h2>

    <!-- Delete Link for Course -->
    <?php if (isset($course)): ?>
    <div class="card mt-4">
        <div class="card-body">
            <h4>Course Details</h4>
            <p><strong>Course Title:</strong> <?php echo htmlspecialchars($course['course_title']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($course['description']); ?></p>
            <a href="delete.php?id=<?php echo htmlspecialchars($course['video_id']); ?>" onclick="return confirm('Are you sure you want to delete this course?');" class="btn btn-danger">Delete</a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Access User Account Form -->
    <div class="card mt-4">
        <div class="card-body">
            <h4>Access User Account</h4>
            <form method="post" action="admin_dashboard.php">
                <div class="form-group">
                    <label for="access_user_id">Select User to Access</label>
                    <select class="form-control" id="access_user_id" name="access_user_id" required>
                        <option value="">-- Select User --</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= htmlspecialchars($user['id']) ?>">
                                <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?> (ID: <?= htmlspecialchars($user['id']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Access User Account</button>
            </form>
            <?php if (isset($access_error)): ?>
                <p class="text-danger mt-3"><?= htmlspecialchars($access_error) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Admin Access Return Link -->
    <?php if (isset($_SESSION['is_admin_access']) && $_SESSION['is_admin_access'] === true): ?>
    <a href="admin_reset.php" class="btn btn-warning mt-4">Return to Admin Account</a>
    <?php endif; ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php include('footer.php'); ?>



kkkkk
<?php

include('header.php');
include('db.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to Admin Dashboard</h1>
    <a href="add_course.php">Add Course</a>
    <!-- Other admin links and content -->
    <?php
include('db.php');

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare and execute delete query
    $sql = "DELETE FROM courses WHERE video_id = :video_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':video_id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: admin_dashboard.php'); // Redirect back to admin dashboard
        exit();
    } else {
        print_r($stmt->errorInfo());
    }
} else {
    echo 'No ID specified for deletion.';
}
?>
<?php
// Include database connection and admin header
include('db.php');
include('admin-header.php'); // Ensure this file exists in the same directory

// Get the video ID from the URL, fallback to 0 if not present
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Prepare and execute query to fetch course details
$sql = "SELECT * FROM courses WHERE video_id = :video_id"; 
$stmt = $conn->prepare($sql);
$stmt->bindParam(':video_id', $id, PDO::PARAM_INT);
if ($stmt->execute()) {
    $course = $stmt->fetch();
} else {
    print_r($stmt->errorInfo());
}

// Check if course exists
if (!$course) {
    die('Course not found');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content here -->
</head>
<body>

<!-- Admin Dashboard Content -->

<!-- Example Delete Link -->
<a href="delete.php?id=<?php echo htmlspecialchars($course['video_id']); ?>" onclick="return confirm('Are you sure you want to delete this course?');">Delete</a>

<!-- Your other content -->

</body>
</html>

<?php

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

?>

<a href="add_course.php">Add Course</a>
    <div class="adminpanel">
       
        <p>You can manage User and Online Exam from here.......</p>

        
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li class="nav-item">
            <a class="nav-link" href="students_list.php">Students</a>
            <a class="nav-link" href="students.php">Students</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="exams.php">Exams</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="exams_result.php">Exams Result</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_dashboard.php">Users(Students)</a>
        </li>
       
            <li><a href="students.php">Users(Students)</a></li>
            <li><a href="user_dashboard.php">Users(Students)</a></li>
            <li><a href="exams.php">Exam</a></li>
            <li><a href="grades.php">Grade Reports</a></li>
            <li><a href="exam_result.php">Exam Result </a></li>
            <li><a href="exam_report.php">Exam Reports</a></li>
            <li><a href="messages.php">Messages</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
 
</head>
<body>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('footer.php'); ?>
kkkk

<?php
include('header.php');
include('db.php');

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

?>

<!-- Admin Dashboard HTML -->
<div class="container mt-5">
    <h1>Admin Dashboard</h1>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#home">Home</a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link" href="courses.php">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="students_list.php">Students</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="exams.php">Exams</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="messages.php">Messages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="settings.php">Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_dashboard.php">Users</a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link" href="#exam_reports.php">Exam Reports</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="#exam_results.php">Exam Result Reports</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    </ul>

    <!-- Tab content -->
    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="home">
            <h2>Home</h2>
            <!-- Add home content here -->
        </div>
        <div class="tab-pane fade" id="courses">
            <h2>Courses</h2>
            <!-- Add courses management interface here -->
        </div>
        <div class="tab-pane fade" id="users">
            <h2>Users</h2>
            <!-- Add user management interface here -->
        </div>
        <div class="tab-pane fade" id="reports">
            <h2>Reports</h2>
            <!-- Add reports interface here -->
        </div>
        <div class="tab-pane fade" id="messages">
            <h2>Messages</h2>
            <!-- Add messaging interface here -->
        </div>
        <div class="tab-pane fade" id="settings">
            <h2>Settings</h2>
            <!-- Add settings interface here -->
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

