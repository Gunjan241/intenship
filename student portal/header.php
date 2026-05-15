<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Student Management Portal</h1>

    <nav>
        <a href="index.php" class="<?= ($currentPage == 'index.php') ? 'active' : ''; ?>">Home</a>

        <a href="students.php" class="<?= ($currentPage == 'students.php') ? 'active' : ''; ?>">Students</a>

        <a href="courses.php" class="<?= ($currentPage == 'courses.php') ? 'active' : ''; ?>">Courses</a>

        <a href="contact.php" class="<?= ($currentPage == 'contact.php') ? 'active' : ''; ?>">Contact</a>
    </nav>
</header>

<div class="container"></div>