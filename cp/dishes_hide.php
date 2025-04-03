<?php
require_once "../db.php";
require_once "check_login.php";

if (isset($_GET['did'])) {
    $q = "SELECT `name`,`price`,`pic`,`status` FROM `dishes` WHERE id=?";
    $d = getData($con, $q, [$_GET['did']]);
    if (count($d) > 0) {
        $q_edit = "UPDATE `dishes` SET `status`=0 WHERE id=?";
        $d_edit = setData($con, $q_edit, [$_GET['did']]);
        if ($d_edit > 0) {
            echo "<script>location.replace('./dishes_show.php');</script>";
        }
    } else {
        echo "<script>location.replace('./dishes_show.php');</script>";
    }
} else {
    echo "<script>location.replace('./dishes_show.php');</script>";
}
