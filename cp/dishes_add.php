<?php
require_once "./header.php";
?>
<div class="container">
    <h1>Add Dishe</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="name">Dishe's Name</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Price</label>
        <input type="text" id="price" name="price" required>

        <label for="pic">Pic</label>
        <input type="file" id="pic" name="pic" required>
        <hr>

        <button type="submit" name="add">Add</button>
    </form>
</div>
<script src="assets/script.js"></script>
</body>

</html>


<?php
if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $err = "";

    $pic = $_FILES['pic']['name'];
    $pic_size = $_FILES['pic']['size'];
    if ($pic_size >= 5000000) $err = "حجم الصورة كبير جداً, يرجى رفع صورة اخرى";

    //
    $valid_file_extensions = array(".jpg", ".jpeg", ".png");
    if (isset($_FILES['pic']['name'])) {
        $file_extension = strrchr($_FILES["pic"]["name"], ".");
        if (in_array($file_extension, $valid_file_extensions) !== false) {
            $err = "";
        } else {
            $err = "الامتداد غير مقبول (" . $_FILES["pic"]["name"] . ")";
        }
    } else {
        $err = "الصورة غير موجودة";
    }

    if ($err == '') {
        $destination = uniqid() . ".jpg";
        move_uploaded_file($_FILES["pic"]["tmp_name"], '../images/menu/' . $destination);
        $q = "INSERT INTO `dishes` (`name`,`price`,`pic`,`status`) VALUES (?,?,?,1);";
        $d = setData($con, $q, [$name, $price, $destination]);
        if ($d > 0) {
            echo "<script> 
            Swal.fire({
                title: 'اضافة طبق',
                text: 'تمت الاضافة بنجاح',
                icon: 'success',
            }).then((value) => {
                location.replace('./dishes_show.php');
            })
             </script>";
        } else {
            echo "<script>swal('اضافة طبق', 'حدث خطا في الاضافة، اعد المحاولة رجاءا', 'error');</script>";
        }
    } else {
        echo "<script>swal('اضافة طبق', '" . $err . "', 'error');</script>";
    }
}


?>