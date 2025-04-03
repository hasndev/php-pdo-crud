<?php
require_once "../db.php";
require_once "check_login.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">

    <!-- Include Sweetalert library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables library -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <!-- Include DataTables styling -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.themify.min.css">


</head>

<body>
    <header>
        <div class="header-container">
            <img src="../images/userlogo.png" alt="Logo" class="logo">
            <p class="username"><?php echo $_SESSION['username'] ?></p>
        </div>
        <button class="sidebar-toggle" onclick="toggleSidebar()">&#9776;</button>
        <button class="dark-mode-toggle" onclick="toggleDarkMode()">&#127769;</button>
        <a href="./logout.php" class="sidebar-toggle">Logout</a>
    </header>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="../images/userlogo.png" alt="User Avatar" class="user-avatar">
            <h3>Dashboard</h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="./dashboard.php">Dashboard</a></li>
            <li><a href="./dishes_show.php">Show dishes</a></li>
            <li><a href="./dishes_add.php">Add dishe</a></li>
            <li><a href="./contact.php">Contact Message</a></li>
        </ul>
    </div>