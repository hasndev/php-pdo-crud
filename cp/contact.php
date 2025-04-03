<?php
require_once "./header.php";
?>
<div class="container">
    <h1>Show Dishes</h1>
    <table id="dishes-table" class="display">
        <thead>
            <tr>
                <th data-sortable="false">ID</th>
                <th data-sortable="true">Name</th>
                <th data-sortable="true">Rate</th>
                <th data-sortable="true">Note</th>
                <th data-sortable="false">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            $q = "SELECT `name`,`rate`,`note`,`id` FROM `contact`";
            $d = getData($con, $q);
            if (count($d) > 0) {
                foreach ($d as $item) {
            ?>
                    <tr>
                        <td><?php echo $count  ?></td>
                        <td><?php echo $item['name'] ?></td>
                        <td><?php echo $item['rate'] ?></td>
                        <td><?php echo $item['note'] ?></td>
                        <td>
                            <a onclick="delete_dishes('<?php echo $item['id'] ?>')" class="delete-button">Delete</a>

                        </td>
                    </tr>
            <?php
                    $count++;
                }
            } else {
                echo "Not Found any Contact Message";
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
                    url: './contact_del.php',
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
                            location.replace('./contact.php');
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