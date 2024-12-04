CREATE DATABASE IF NOT EXISTS accounting_course;

USE accounting_course;

-- Users table
CREATE TABLE IF NOT EXISTS users_ (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    email VARCHAR(100) NOT NULL UNIQUE,
    profile_picture VARCHAR(255),
    is_admin BOOLEAN DEFAULT FALSE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user', 'tutor') NOT NULL,
    address TEXT,
    phone VARCHAR(20),
    education_level VARCHAR(50),
    age INT,
    sex ENUM('male', 'female', 'other'),
    nationality VARCHAR(50),
    country_residence VARCHAR(50),
    picture_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Courses table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    instructor_id INT,
    FOREIGN KEY (instructor_id) REFERENCES users(id)
);

-- Course enrollments table
CREATE TABLE IF NOT EXISTS course_enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    student_id INT,
    FOREIGN KEY (course_id) REFERENCES courses(id),
    FOREIGN KEY (student_id) REFERENCES users(id)
);

-- Content table
CREATE TABLE IF NOT EXISTS content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    title VARCHAR(255),
    content_type ENUM('video', 'notes') NOT NULL,
    content_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(id)
);
CREATE TABLE course_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    content TEXT,
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Grades table
CREATE TABLE IF NOT EXISTS grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    course_id INT,
    grade DECIMAL(5, 2),
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Exam attempts table
CREATE TABLE IF NOT EXISTS exam_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    course_id INT,
    attempted_at DATETIME,
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Testimonials table
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    testimonial TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
