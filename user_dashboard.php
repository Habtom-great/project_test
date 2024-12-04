<?php
include('db.php');
include('header_loggedin.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle course access request
if (isset($_GET['request_access'])) {
    $course_id = $_GET['request_access'];
    $stmt = $pdo->prepare("INSERT INTO course_access (user_id, course_id) VALUES (:user_id, :course_id) ON DUPLICATE KEY UPDATE access_status = 'pending'");
    $stmt->execute(['user_id' => $user_id, 'course_id' => $course_id]);
    echo "<script>alert('Your request for access has been submitted.');</script>";
}

// Pagination setup
$limit = 10; // Number of courses per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get courses with pagination
$sql = "SELECT SQL_CALC_FOUND_ROWS c.course_id, c.course_title, c.total_weeks, IF(a.access_status IS NOT NULL, a.access_status, 'not requested') as access_status
        FROM courses c
        LEFT JOIN course_access a ON a.course_id = c.course_id AND a.user_id = :user_id
        LIMIT :offset, :limit";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total number of courses
$totalCoursesStmt = $pdo->query("SELECT FOUND_ROWS()");
$totalCourses = $totalCoursesStmt->fetchColumn();
$totalPages = ceil($totalCourses / $limit);

// Fetch user information
$userStmt = $pdo->prepare("SELECT last_name, middle_name, first_name, profile_image FROM users WHERE id = :user_id");
$userStmt->execute(['user_id' => $user_id]);
$userInfo = $userStmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 1px auto;
            padding: 2px;
           
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-info img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .profile-info p {
            font-size: 1.2rem;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #007bff;
            color: white;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .pagination {
            text-align: center;
            margin: 20px 0;
        }

        .pagination a {
            padding: 10px 15px;
            margin: 0 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .pagination a.active {
            background-color: #0056b3;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

        .course-info {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .alert {
            color: #d9534f;
            text-align: center;
            margin: 20px 0;
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
        }

        .action-btn.request {
            background-color: #f0ad4e;
        }

        .action-btn.approved {
            background-color: #5cb85c;
        }

        .action-btn.denied {
            background-color: #d9534f;
        }

        .action-btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-info">
            <h1>Welcome, <?= htmlspecialchars($userInfo['last_name']) . ', ' . htmlspecialchars($userInfo['middle_name']) . ' ' . htmlspecialchars($userInfo['first_name']) ?>!</h1>
            <img src="<?= htmlspecialchars($userInfo['profile_image']) ?>" alt="Profile Image" />
            <p>Your role: <?= htmlspecialchars($_SESSION['role']) ?></p>
            <a href="logout.php" class="action-btn" style="background-color: #d9534f;">Logout</a>
        </div>

        <h2>Available Courses</h2>
        <div class="course-info">
            Total Courses: <?php echo $totalCourses; ?>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Title</th>
                        <th>Weeks to Complete</th>
                        <th>Access Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($courses) {
                        foreach ($courses as $course) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($course['course_id']) . '</td>';
                            echo '<td>' . htmlspecialchars($course['course_title']) . '</td>';
                            echo '<td>' . htmlspecialchars($course['total_weeks']) . '</td>';
                            echo '<td>' . htmlspecialchars($course['access_status']) . '</td>';
                            echo '<td>';
                            if ($course['access_status'] === 'not requested') {
                                echo '<a href="?request_access=' . htmlspecialchars($course['course_id']) . '" class="action-btn request">Request Access</a>';
                            } elseif ($course['access_status'] === 'pending') {
                                echo 'Access Pending';
                            } elseif ($course['access_status'] === 'approved') {
                                echo '<a href="courses.php?id=' . htmlspecialchars($course['course_id']) . '" class="action-btn approved">Access Course</a>';
                            } elseif ($course['access_status'] === 'denied') {
                                echo 'Access Denied';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No courses available.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php echo ($i === $page) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php include('footer.php'); ?>

