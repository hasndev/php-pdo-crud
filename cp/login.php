<?php
session_start();
require_once "../db.php";
?>


<!DOCTYPE html>
<html>

<head>
    <title>Login Page - Mazaya Restaurant</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        body {
            background: #f1f1f1;
            font-family: Arial, sans-serif;
        }

        .login-box {
            width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px #ccc;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="password"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            margin-bottom: 20px;
        }

        form input[type="submit"] {
            background: rgb(26, 184, 26);
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            transition: all 0.3s;
        }

        form input[type="submit"]:hover {
            background: #3e8e41;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h1>Login</h1>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter Username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</body>

</html>


<?php
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $err = '';
    if ($username == '') $err = "الرجاء ادخال اسم المستخدم";
    if ($password == '') $err = "الرجاء ادخال كلمة المرور";

    if ($err == '') {
        $q = "SELECT `username`, `fullname`,`pasword` FROM usres WHERE `username`=?";
        $d = getData($con, $q, [$username]);
        if (count($d) > 0) {
            $pass = $d[0]['pasword'];
            if ($pass == $password) {
                $_SESSION['username'] = $d[0]['username'];
                $_SESSION['del'] = false;
                header("Location: ./dashboard.php");
                die;
            } else {
                echo "<script>swal('تسجيل دخول', 'خطا في معلومات الدخول، الرجاء اعادة المحاولة', 'error');</script>";
            }
        } else {
            echo "<script>swal('تسجيل دخول', 'خطا في معلومات الدخول، الرجاء اعادة المحاولة', 'error');</script>";
        }
    } else {
        echo "<script>swal('تسجيل دخول', 'خطا في معلومات الدخول، الرجاء اعادة المحاولة', 'error');</script>";
    }
}




?>