<?php
require_once "./header.php";
?>
<div class="container">
    <h1>Show Dishes</h1>
    <table id="dishes-table" class="display">
        <thead>
            <tr>
                <th data-sortable="false">ID</th>
                <th data-sortable="true">Image</th>
                <th data-sortable="true">Name</th>
                <th data-sortable="true">Price</th>
                <th data-sortable="true">Status</th>
                <th data-sortable="false">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            $q = "SELECT `name`,`price`,`pic`,`status`,`id` FROM `dishes`";
            $d = getData($con, $q);
            if (count($d) > 0) {
                foreach ($d as $item) {
            ?>
                    <tr>
                        <td><?php echo $count  ?></td>
                        <td><img src="../images/menu/<?php echo $item['pic'] ?>" alt="<?php echo $item['name'] ?>" height="100px" width="100px"></td>
                        <td><?php echo $item['name'] ?></td>
                        <td>$<?php echo $item['price'] ?></td>
                        <td>
                            <?php
                            if ($item['status'] == 1) {
                                echo "Available";
                            } else {
                                echo "Unavailable";
                            }
                            ?>
                        </td>
                        <td>
                            <a onclick="delete_dishes('<?php echo $item['id'] ?>')" class="delete-button">Delete</a>
                            <a href="./dishes_edit.php?did=<?php echo $item['id'] ?>" class="edit-button">Edit</a>
                            <?php
                            if ($item['status'] == 1) {
                                echo "<a href='./dishes_hide.php?did=" . $item['id'] . "' class='edit-hide'>Hide</a>";
                            } else {
                                echo "<a href='./dishes_shows.php?did=" . $item['id'] . "' class='edit-show'>Show</a>";
                            }
                            ?>


                        </td>
                    </tr>
            <?php
                    $count++;
                }
            }else{
                echo "Not Found any Dishes";
            }

            ?>

        </tbody>
    </table>
    <div id="success_msg"></div>
    <div id="err_msg"></div>
</div>
<script src="assets/script.js"></script>
<script>
    function delete_dishes(item_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: './dishes_del.php',
                    method: 'post',
                    data: {
                        did: item_id
                    },
                    success: function(res) {
                        $("#success_msg").html(res);
                    },
                    complete: function(res) {
                        Swal.fire({
                            title: 'تم الحذف',
                            text: 'تمت عملية الحذف بنجاح',
                            icon: 'success',
                        }).then((value) => {
                            location.replace('./dishes_show.php');
                        })
                    },
                    error: function(data) {
                        $('#err_msg').html(data);
                    }

                })
            }
        })
    }


    $(document).ready(function() {
        $('#dishes-table').DataTable({
            "pagingType": "full_numbers",
            "ordering": true,
            "searching": true,
            "columnDefs": [{
                "targets": -1,
                "orderable": false
            }]
        });
    });
</script>
</body>

</html>