<?php
require_once "./db.php";



if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){

    $name = $_POST['Name'];
    $rate = $_POST['Rate'];
    $note = $_POST['Note'];


    $q = "INSERT INTO `contact` (`name`,`rate`,`note`) VALUES (?,?,?)";
    $d = setData($con,$q,[$name,$rate,$note]);
    if($d >0){
        echo"
        Swal.fire({
            title: 'استمارة التقييم',
            text: 'تم الارسال بنجاح',
            icon: 'success',
        }).then((value) => {
            location.replace('./index.php');
        })
        ";
    }
}
