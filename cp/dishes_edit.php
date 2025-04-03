<?php
require_once "./header.php";
$q = "SELECT `name`,`price`,`pic`,`status` FROM `dishes` WHERE id=?";
$d = getData($con, $q, [$_GET['did']]);
if (count($d) > 0) {
    $name = $d[0]['name'];
    $price = $d[0]['price'];
    $old_pic = $d[0]['pic'];
}


?>
<div class="container">
    <h1>Eidt Dishe</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="name">Dishe's Name</label>
        <input type="text" id="name" name="name" value="<?php echo $name ?>" required>

        <label for="price">Price</label>
        <input type="text" id="price" name="price" value="<?php echo $price ?>" required>

        <label for="pic">Old Pic</label>
        <img src="../images/menu/<?php echo $old_pic ?>" alt="<?php echo $name; ?>" height="100px" width="100px"><br>
        <label for="pic">New Pic</label>
        <input type="file" id="pic" name="pic">
        <hr>

        <button type="submit" name="edit">Eidt</button>
    </form>
</div>
<script src="assets/script.js"></script>
</body>

</html>


<?php
if (isset($_POST['edit'])) {

    $dishe_name = $_POST['name'];
    $price = $_POST['price'];
    $err = "";

    //
    $valid_file_extensions = array(".jpg", ".jpeg", ".png");
    if (isset($_FILES['pic']['name']) && $_FILES['pic']['name'] != '') {
        $pic_size = $_FILES['pic']['size'];
        if ($pic_size >= 5000000) $err = "حجم الصورة كبير جداً, يرجى رفع صورة اخرى";

        $file_extension = strrchr($_FILES["pic"]["name"], ".");
        if (in_array($file_extension, $valid_file_extensions) !== false) {
            $pic = $_FILES["pic"]["name"];
        } else {
            $err = "الامتداد غير مقبول (" . $_FILES["pic"]["name"] . ")";
        }
    } else {
        $destination = $old_pic;
    }

    if ($err == '') {


        if ($_FILES['pic']['name'] != '') {
            $destination = uniqid() . ".jpg";
            move_uploaded_file($_FILES["pic"]["tmp_name"], '../images/menu/' . $destination);
        }

        $q = "UPDATE `dishes` SET `name`=?, `price`=?, `pic`=? WHERE `id`=?";
        $d = setData($con, $q, [$dishe_name, $price, $destination, $_GET['did']]);
        if ($d > 0) {
            echo "<script> 
            Swal.fire({
                title: 'تعديل طبق',
                text: 'تمت عملية التعديل بنجاح',
                icon: 'success',
            }).then((value) => {
                location.replace('./dishes_show.php');
            })
            </script>";
        } else {
            echo "<script>swal('تعديل طبق', 'حدث خطا في التعدديل, اعد المحاولة رجاءا', 'error');</script>";
        }
    } else {
        echo "<script>swal('تعديل طبق', '" . $err . "', 'error');</script>";
    }
}


?>