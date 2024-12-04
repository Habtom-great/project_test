
<?php
session_start();
// Redirect to login page if the user is not logged in or not an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT course_title, description, thumb_image, course_videos, course_note FROM courses WHERE course_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$course_id]);
$course = $stmt->fetch(PDO::FETCH_ASSOC);

include('db.php');
$course_id = $_GET['course_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Course Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrQdPLOEPtpwZby2K4xU4qC2p8AAYxBnTXyVrpMRv1jXf3p2e1TXP6fuVRJ9Z7z6x6X3T7QzQ2v5MDV6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        header, footer {
            background: #004080;
            color: white;
            text-align: center;
            padding: 10px 20px;
        }
        .course-container {
            display: flex;
            max-width: 1200px;
            margin: 2rem auto;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .course-menu {
            width: 30%;
            border-right: 1px solid #ddd;
            background: #f4f4f4;
            padding: 1rem;
        }
        .course-menu ul {
            list-style: none;
            padding: 0;
        }
        .course-menu li {
            padding: 0.5rem;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .course-menu li.completed {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .course-menu li.completed i {
            color: green;
        }
        .course-menu li:hover {
            background-color: #eaeaea;
        }
        .video-content {
            width: 70%;
            padding: 1rem;
        }
        .video-player {
            width: 100%;
            height: 400px;
            background-color: #000;
            margin-bottom: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        .btn-navigation {
            padding: 0.5rem 1rem;
            margin: 0 5px;
            border: none;
            color: #fff;
            background-color: #0056d2;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-navigation:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .progress-bar {
            background-color: #ddd;
            height: 10px;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 1rem;
        }
        .progress-bar div {
            background-color: #0056d2;
            height: 100%;
            width: 0;
        }
    </style>
</head>
<body>
    
<img src="<?= htmlspecialchars($course['thumb_image'] ?? 'default_course_image.jpg'); ?>" alt="Course Image" />
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Course Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrQdPLOEPtpwZby2K4xU4qC2p8AAYxBnTXyVrpMRv1jXf3p2e1TXP6fuVRJ9Z7z6x6X3T7QzQ2v5MDV6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header, footer {
            background: #004080;
            color: white;
            padding: 15px 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 50px;
            margin-right: 10px;
        }

        .search-container input {
            padding: 5px;
        }

        .search-container button {
            padding: 5px 10px;
            background-color: #0056d2;
            color: white;
            border: none;
            cursor: pointer;
        }

        nav ul {
            display: flex;
            gap: 15px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        .video-content {
            width: 70%;
            padding: 1rem;
        }

        .video-player iframe {
            width: 100%;
            height: 400px;
            border: none;
        }

        .btn-view-notes {
            display: inline-block;
            padding: 0.5rem 1rem;
            color: #fff;
            background-color: #0056d2;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-view-notes:hover {
            background-color: #0041a6;
        }

        footer {
            text-align: center;
            padding: 15px;
        }

        .social-links a {
            margin: 0 10px;
            color: white;
            text-decoration: none;
        }

        .social-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo-container">
            <img src="assets/logos/1.png-2.png" alt="Company Logo" class="logo">
            <h1>GerarIsaac Training Center</h1>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search...">
            <button type="submit">Search</button>
        </div>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <button id="menuToggle">☰</button>
        </nav>
    </header>

  
<div class="course-container">
    <!-- Course Menu -->
    <div class="course-menu">
        <h3>Course Modules</h3>
        <ul id="moduleList">
            <!-- Modules will be dynamically generated here -->
        </ul>
    </div>

    <!-- Video Content -->
    <div class="video-content">
        <h2 id="moduleTitle">Module 1: Introduction</h2>
        <div class="video-player" id="videoPlayer">
            <!-- Video content here -->
            <iframe id="videoFrame" width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
        </div>
        <p id="moduleNotes">This is the introduction to the course. It covers the basics.</p>
        <div>
            <button id="prevBtn" class="btn-navigation" disabled>Previous</button>
            <button id="nextBtn" class="btn-navigation">Next</button>
           <button id=" ViewNotes" class="btn-navigation">View Notes</button>
        </div>
        <div class="progress-bar">
            <div id="progress"></div>
        </div>
    </div>
</div>
    kkkkkkkkkk
    <!-- Course List -->
<div class="course-list">
    <h5>Course List</h5>
    <div id="course-items">
        <div class="course-item" data-video="video1.mp4" data-notes="Notes for Chapter 1">
            <i class="bi bi-play-circle"></i> Chapter 1: Basics of Accounting
        </div>
        <div class="course-item" data-video="video2.mp4" data-notes="Notes for Chapter 2">
            <i class="bi bi-play-circle"></i> Chapter 2: Accounting Principles
        </div>
        <div class="course-item" data-video="video3.mp4" data-notes="Notes for Chapter 3">
            <i class="bi bi-play-circle"></i> Chapter 3: Accounting Equation
        </div>
    </div>
</div>
<!-- Video Content -->
<div class="video-content">
         
            <button class="btn-navigation">Previous</button>
            <button class="btn-navigation">Next</button>
            <a href="#" class="btn-view-notes">View Notes</a>
        </div>
    </div>
    <script>

    const modules = [
        { title: "Module 1: Introduction", notes: "This is the introduction to the course. It covers the basics.", video: "https://www.youtube.com/embed/dQw4w9WgXcQ" },
        { title: "Module 2: Core Concepts of Basics  Accounting", notes: "This module explores the core concepts in detail.", video: "https://www.youtube.com/embed/3JZ_D3ELwOQ" },
        { title: "Module 3: Accounting Principles", notes: "Advanced topics are covered in this module.", video: "https://www.youtube.com/embed/tgbNymZ7vqY" },
        { title: "Module 4: Accounting Equation", notes: "Real-world applications are demonstrated here.", video: "https://www.youtube.com/embed/aqz-KE-bpKQ" },
        { title: "Module 5: Final Assessment", notes: "This is the final assessment of the course.", video: "https://www.youtube.com/embed/kJQP7kiw5Fk" },
    ];

    let currentIndex = 0;

    const moduleList = document.getElementById('moduleList');
    const moduleTitle = document.getElementById('moduleTitle');
    const moduleNotes = document.getElementById('moduleNotes');
    const videoFrame = document.getElementById('videoFrame');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const ViewNotes = document.getElementById('View Notes');
    const progressBar = document.getElementById('progress');

    // Populate the module list
    modules.forEach((module, index) => {
        const li = document.createElement('li');
        li.innerHTML = `${module.title} <i class="fas fa-check-circle" style="display:none;"></i>`;
        li.addEventListener('click', () => loadModule(index));
        moduleList.appendChild(li);
    });

    function loadModule(index) {
        currentIndex = index;
        const module = modules[currentIndex];
        moduleTitle.textContent = module.title;
        moduleNotes.textContent = module.notes;
        videoFrame.src = module.video;

        // Update progress bar
        progressBar.style.width = ((currentIndex + 1) / modules.length) * 100 + '%';

        // Update navigation buttons
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex === modules.length - 1;

        // Mark completed modules
        markCompletedModules();
    }

    function markCompletedModules() {
        const items = moduleList.querySelectorAll('li');
        items.forEach((item, index) => {
            const icon = item.querySelector('i');
            if (index <= currentIndex) {
                item.classList.add('completed');
                icon.style.display = 'inline';
            } else {
                item.classList.remove('completed');
                icon.style.display = 'none';
            }
        });
    }

    // Event listeners for navigation buttons
    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            loadModule(currentIndex - 1);
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentIndex < modules.length - 1) {
            loadModule(currentIndex + 1);
        }
    });
    function markCompletedModules() {
            const items = moduleList.querySelectorAll('li');
            items.forEach((item, index) => {
                const icon = item.querySelector('i');
                if (index <= currentIndex) {
                    item.classList.add('completed');
                    icon.style.display = 'inline';
                } else {
                    item.classList.remove('completed');
                    icon.style.display = 'none';
                }
            });
        }

        videoPlayer.addEventListener('timeupdate', () => {
            const watchedPercentage = (videoPlayer.currentTime / videoPlayer.duration) * 100;
            if (watchedPercentage >= 75) {
                moduleList.children[currentIndex].classList.add('completed');
            }
        });

        videoPlayer.addEventListener('timeupdate', () => {
            const watchedPercentage = (videoPlayer.currentTime / videoPlayer.duration) * 100;
            if (watchedPercentage >= 75) {
                moduleList.children[currentIndex].classList.add('completed');
            }
        });

        
    // Initial load
    loadModule(0);
</script>

</body>
</html>
kkkkkkkkkkkkk
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View</title>
	<style>
		body {
		    display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			min-height: 100vh;
		}
		video {
			width: 640px;
			height: 360px;
		}
		a {
			text-decoration: none;
			color: #006CFF;
			font-size: 1.5rem;
		}
	</style>
</head>
<body>
	<a href="index.php">UPLOAD</a>

	<div class="alb">
		<?php 
		 include "db_conn.php";
		 $sql = "SELECT * FROM videos ORDER BY id DESC";
		 $res = mysqli_query($conn, $sql);

		 if (mysqli_num_rows($res) > 0) {
		 	while ($video = mysqli_fetch_assoc($res)) { 
		 ?>
		 		
	        <video src="uploads/<?=$video['video_url']?>" 
	        	   controls>
	        	
	        </video>

	    <?php 
	     }
		 }else {
		 	echo "<h1>Empty</h1>";
		 }
		 ?>
	</div>
</body>
</html>