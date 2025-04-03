<?php
require_once "../db.php";
require_once "check_login.php";

if (isset($_POST['did'])) {
    $q = "SELECT `name`,`price`,`pic`,`status` FROM `dishes` WHERE id=?";
    $d = getData($con, $q, [$_POST['did']]);
    if (count($d) > 0) {
        $pic = $d[0]['pic'];

        unlink("../images/menu/" . $pic);
        $q_del = "DELETE FROM `dishes` WHERE id=?";
        $d_del = setData($con, $q_del, [$_POST['did']]);
        if ($d_del > 0) {
            $_SESSION['del'] = true;
        }
    } else {
        echo "<script>location.replace('./dishes_show.php');</script>";
    }
} else {
    echo "<script>location.replace('./dishes_show.php');</script>";
}
