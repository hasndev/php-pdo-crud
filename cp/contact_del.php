<?php
require_once "../db.php";
require_once "check_login.php";

if (isset($_POST['did'])) {
    $q = "SELECT `name` FROM `contact` WHERE id=?";
    $d = getData($con, $q, [$_POST['did']]);
    if (count($d) > 0) {

        $q_del = "DELETE FROM `contact` WHERE id=?";
        $d_del = setData($con, $q_del, [$_POST['did']]);
        if ($d_del > 0) {
            $_SESSION['del'] = true;
        }
    } else {
        echo "<script>location.replace('./contact.php');</script>";
    }
} else {
    echo "<script>location.replace('./contact.php');</script>";
}
