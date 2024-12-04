<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="container">
    <section id="home" class="welcome-text">
        Welcome to <span>Gerar Isaac Training Center</span>
    </section>

    <!-- Carousel Section -->
    <section id="carousel" class="carousel-section">
        <?php include 'carousel.php'; ?>
    </section>
</div>

<?php include 'footer.php'; ?>
kkkkkkkk
<?php
include('header.php');
include('db.php');
?>

<div id="home" class="container mt-5">
    <div id="collegeCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#collegeCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#collegeCarousel" data-slide-to="1"></li>
            <li data-target="#collegeCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/about.jpg" class="d-block w-100" alt="College 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>About Gerar Isaac Training Center</h5>
                    <p>Welcome to Gerar Isaac Training Center</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images_courses/photo_first round-final exam.jpg" class="d-block w-100" alt="College 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>1st Round Final Exam</h5>
                    <p>“Education is the key to unlock a golden door of freedom.” — George Washington Carver</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images_courses/2nd round graduating students peach tree exam ..jpg" class="d-block w-100" alt="College 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>2nd Round Graduating Students Peach Tree Exam</h5>
                    <p>Welcome to Gerar Isaac College.</p>
                </div>
            </div>
            <!-- Additional carousel items can be added here -->
        </div>
        <a class="carousel-control-prev" href="#collegeCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#collegeCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="jumbotron text-center mt-5">
        <h1>Welcome to Gerar Isaac College Online Courses</h1>
        <p>Your one-stop solution for learning accounting online.</p>
        <a href="login_register.php" class="btn btn-primary">Login/Register</a>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h1>About Us</h1>
            <p>We offer comprehensive online accounting courses designed to help you master the principles and practices of accounting. Our courses are taught by experienced professionals and are tailored to meet the needs of students at all levels.</p>
        </div>
        <div class="col-md-6">
            <img src="assets/images/Geography_of_Israel.jpg" class="img-fluid" alt="College Image">
            <img src="assets/images/about.jpg" class="img-fluid mt-3" alt="College Image">
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2>Our Courses</h2>
            <a href="courses.php" class="btn btn-success">View Courses</a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <h2>Testimonials</h2>
            <blockquote class="blockquote">
                <p class="mb-0">"The courses are well-structured and the tutors are very knowledgeable. I have learned so much in a short period of time."</p>
                <footer class="blockquote-footer">Jane Doe</footer>
            </blockquote>
            <blockquote class="blockquote">
                <p class="mb-0">"Excellent platform for anyone looking to enhance their accounting skills. Highly recommended!"</p>
                <footer class="blockquote-footer">John Smith</footer>
            </blockquote>
        </div>
        <div class="col-md-6">
            <h2>Our Tutors</h2>
            <p><strong>Tutor 1:</strong> Expert in Financial Accounting with over 10 years of experience.</p>
            <p><strong>Tutor 2:</strong> Specialist in Management Accounting and Cost Accounting.</p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2>Attach Files and Videos</h2>
            <form action="upload_content.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="course_id">Course</label>
                    <select name="course_id" id="course_id" class="form-control" required>
                        <option value="">Select Course</option>
                        <?php
                        // Fetch courses from the database
                        $sql = "SELECT id, title FROM courses";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['title']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">Attach File</label>
                    <input type="file" class="form-control-file" id="file" name="file" required>
                </div>
                <div class="form-group">
                    <label for="video">Attach Video URL</label>
                    <input type="url" class="form-control" id="video" name="video">
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>

<section class="testimonials mt-5">
    <h2 class="text-center mb-4">Testimonials</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="testimonial">
                <img src="images/photo_2024-07-02_17-28-20.jpg" class="img-fluid rounded-circle mb-3" alt="Testimonial 1">
                <p>"The Online Accounting Course has significantly improved my understanding of accounting principles."</p>
                <div class="name">Betelihem<br>2nd Round Graduate in Accounting</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial">
                <img src="images/photo_Tsegay.jpg" class="img-fluid rounded-circle mb-3" alt="Testimonial 2">
                <p>"The course content is detailed and the instructors are very knowledgeable."</p>
                <div class="name">Tsegay<br>2nd Round Graduate in Accounting</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial">
                <img src="images/photo_2024-07-02_17-29-04.jpg" class="img-fluid rounded-circle mb-3" alt="Testimonial 3">
                <p>"I highly recommend this course to anyone looking to enhance their accounting skills."</p>
                <div class="name">Amanuel<br>2nd Round Graduate in Accounting</div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include('footer.php'); ?>

kkkkkkkkkkkkk
<?php include('header.php'); ?>

<div id="home" class="container mt-5">
    <!-- Carousel -->
    <div id="collegeCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#collegeCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#collegeCarousel" data-slide-to="1"></li>
            <li data-target="#collegeCarousel" data-slide-to="2"></li>
            <!-- Add more indicators if more images -->
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/about.jpg" class="d-block w-100" alt="College Image 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Welcome to Gerar Isaac Training Center</h5>
                    <p>Learn from the best in a state-of-the-art environment.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images_courses/photo_first_round-final_exam.jpg" class="d-block w-100" alt="College Image 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Final Exam for 1st Round Students</h5>
                    <p>"Education is the key to unlock the golden door of freedom." — George Washington Carver</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images_courses/2nd_round_graduating_students_peach_tree_exam.jpg" class="d-block w-100" alt="College Image 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>2nd Round Graduating Students' Peach Tree Exam</h5>
                    <p>Empowering future accountants.</p>
                </div>
            </div>
            <!-- Add more carousel items as needed -->
        </div>
        <a class="carousel-control-prev" href="#collegeCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#collegeCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Welcome Section -->
    <div class="jumbotron text-center mt-5">
        <h1>Welcome to Gerar Isaac College Online Courses</h1>
        <p>Your one-stop solution for mastering accounting online.</p>
        <a href="login_register.php" class="btn btn-primary">Login/Register</a>
    </div>

    <!-- About Us Section -->
    <div class="row">
        <div class="col-md-6">
            <h2>About Us</h2>
            <p>We offer comprehensive online accounting courses designed to help you master the principles and practices of accounting. Our courses are taught by experienced professionals and tailored to meet the needs of students at all levels.</p>
        </div>
        <div class="col-md-6">
            <img src="assets/images/Geography_of_Israel.jpg" class="img-fluid mb-3" alt="About Image">
            <img src="assets/images/about.jpg" class="img-fluid" alt="College Image">
        </div>
    </div>

    <hr>

    <!-- Courses Section -->
    <div class="text-center my-5">
        <h2>Our Courses</h2>
        <a href="courses.php" class="btn btn-success">View Courses</a>
    </div>

    <hr>

    <!-- Testimonials Section -->
    <section class="testimonials mt-5">
        <h2 class="text-center mb-4">Testimonials</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="testimonial text-center">
                    <img src="images/photo_2024-07-02_17-28-20.jpg" class="img-fluid rounded-circle mb-3" alt="Testimonial 1">
                    <p>"The Online Accounting Course has significantly improved my understanding of accounting principles."</p>
                    <div class="name">Betelihem<br>2nd Round Graduate in Accounting</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial text-center">
                    <img src="images/photo_Tsegay.jpg" class="img-fluid rounded-circle mb-3" alt="Testimonial 2">
                    <p>"The course content is detailed, and the instructors are very knowledgeable."</p>
                    <div class="name">Tsegay<br>2nd Round Graduate in Accounting</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial text-center">
                    <img src="images/photo_2024-07-02_17-29-04.jpg" class="img-fluid rounded-circle mb-3" alt="Testimonial 3">
                    <p>"I highly recommend this course to anyone looking to enhance their accounting skills."</p>
                    <div class="name">Amanuel<br>2nd Round Graduate in Accounting</div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include('footer.php'); ?>


kkkkkkkkkkkkkk
<?php
include('db.php');


// Fetch user details if logged in

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Isaac College</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Link to your custom CSS -->
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Gerar Isaac College -Welcome to your new Classroom</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="courses.php">Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact Us</a>
        </li>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
          
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
        <?php endif; ?>
      </ul>
     
    </div>
  </div>
</nav>

<style>
.user-info {
    display: flex;
    align-items: center;
    color: #00d1b2; /* Unique color for user info */
    margin-left: auto;
}

.user-info .user-image {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    margin-right: 10px;
}
</style>
</body>
</html>






<div class="jumbotron text">
    <h1>Welcome to Gerar Isaac College Online courses</h1>
    <p>Your one-stop solution for learning accounting online.</p>
    
    <a href="login_register.php" class="btn btn-primary">Login/Register</a>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>About Us</h1>
            <h5><p>We offer comprehensive online accounting courses designed 
                to help you master the principles and practices of accounting. 
                Our courses are taught by experienced 
                professionals and are 
                tailored to meet the needs of students at all levels.</p></h5>
        </div>
        <div class="col-md-6"><img src="assets/images/Geography_of_Israel.jpg" class="img-fluid" alt="College Image">
            <img src="assets/images/about.jpg" class="img-fluid" alt="College Image">
            
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <h2>Our Courses</h2>
            <a href="courses.php" class="btn btn-success">View Courses</a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <h2>Testimonials</h2>
            <blockquote class="blockquote">
                <p class="mb-0">"The courses are well-structured and the tutors are very knowledgeable. I have learned so much in a short period of time."</p>
                <footer class="blockquote-footer">Jane Doe</footer>
            </blockquote>
            <blockquote class="blockquote">
                <p class="mb-0">"Excellent platform for anyone looking to enhance their accounting skills. Highly recommended!"</p>
                <footer class="blockquote-footer">John Smith</footer>
            </blockquote>
        </div>
        <div class="col-md-6">
            <h2>Our Tutors</h2>
            <p><strong>Tutor 1:</strong> Expert in Financial Accounting with over 10 years of experience.</p>
            <p><strong>Tutor 2:</strong> Specialist in Management Accounting and Cost Accounting.</p>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <h2>Attach Files and Videos</h2>
            <form action="upload_content.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="course_id">Course</label>
                    <select name="course_id" id="course_id" class="form-control" required>
                        <option value="">Select Course</option>
                        <?php
                        // Fetch courses from the database
                        $sql = "SELECT id, title FROM courses";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['title']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">Attach File</label>
                    <input type="file" class="form-control-file" id="file" name="file" required>
                </div>
                <div class="form-group">
                    <label for="video">Attach Video URL</label>
                    <input type="url" class="form-control" id="video" name="video">
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
kkkkkkkkkkkkk


