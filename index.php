<?php
require_once "./db.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Mazaya Restaurant</title>
    <meta Charset="UTF-8">
    <meta name="description" content="نحن كادر متميز من الشيفات نقدم افضل الوجبات">
    <meta name="keywords" content="منيو شرقي , اسعار مناسبة , منيو غربي">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Damion&family=Pacifico&family=Yellowtail&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Damion&family=Open+Sans&family=Pacifico&family=Yellowtail&display=swap" rel="stylesheet">
    <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--CSS Files-->
    <link href="main.css" rel="stylesheet">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="header">
        <a href="index.php" class="logo">
            <i class="fa fa-cutlery"></i>
            Mazaya
        </a>
        <div class="right">
            <a class="active" href="index.php">Home</a>
            <a href="#menu">Menu</a>
            <a href="#review">Contact</a>
        </div>
    </div>
    <!--Hero section-->
    <section>
        <div class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content">
                            <h5> make your dinner special</h5>
                            <h1> Mazaya restaurant</h1>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic enim, earum incidunt at dicta quam, temporibus placeat nulla qui cum deleniti eligendi alias saepe assumenda distinctio quasi, vero suscipit ratione!</p>
                            <a href="#menu" class="btn"> Our menu</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="images/specials-3.png" alt="Meal" class="animate">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Portfolio-->
    <section>
        <div class="portfolio" id="menu">
            <div class="title">
                <h2>Our <span>Menu</span></h2>
            </div>
            <div class="container">
                <div class="row">
                    <?php
                    $count = 1;
                    $q = "SELECT `name`,`price`,`pic`,`status`,`id` FROM `dishes` ORDER BY id DESC LIMIT 6";
                    $d = getData($con, $q);
                    if (count($d) > 0) {
                        foreach ($d as $item) {
                    ?>
                            <div class="col-lg-4 port-item">
                                <div class="portfolio-img">
                                    <img src="images/menu/<?php echo $item['pic'] ?>">
                                </div>
                                <div class="port-content">
                                    <h5><?php echo $item['name'] ?></h5>
                                    <p><?php echo $item['price'] ?>$</p>
                                </div>
                            </div>
                    <?php
                            $count++;
                        }
                    } else {
                        echo "Not Found any Dishes";
                    }

                    ?>
                </div>
            </div>
            <div class="title text-center">
                <a href="./menu.php" class="btn">Show More</a>
            </div>
        </div>
    </section>
    <!--Review section-->
    <section>
        <div class="review" id="review">
            <div class="title">
                <h2>Share Your <span>Review</span></h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="php-form" role="form" method="" action="">
                            <div class="form-group">
                                <label> Your Name :</label>
                                <input type="text" id="name" required>
                            </div>
                            <div class="form-group">
                                <label> How do you rate our service From 10?</label>
                                <input type="text" id="rate" required>
                                <input type="hidden" id="age" required>
                            </div>
                            <div class="form-group">
                                <label>Any Notes?</label>
                                <textarea id="note"></textarea>
                            </div>
                            <div class="text-center"><button id="btn_cnt" type="button"> Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <div id="success_msg"></div> -->

    <!-- Footer-->
    <footer>
        <div style="background:#333; margin:0%; padding:0%; height:15%;">
            <h1 style="text-align:center; font-weight:600; color:white; padding: 10px;">Mazaya</h1>
        </div>
    </footer>
    <script>
        $(document).on('click', '#btn_cnt', function() {
            var name = $('#name').val();
            var rate = $('#rate').val();
            var note = $('#note').val();
            var age = $('#age').val();


            if (age == '') {
                if (name == '' || rate == '') {
                    Swal.fire({
                        title: 'تم الحذف',
                        text: 'تمت عملية الحذف بنجاح',
                        icon: 'error',
                    })
                } else {
                    $.ajax({
                        url: './cnt.php',
                        method: 'post',
                        data: {
                            Name: name,
                            Rate: rate,
                            Note: note
                        },
                        success: function(res) {
                            $("#success_msg").html(res);
                        },
                        complete: function(res) {
                            Swal.fire({
                                title: 'استمارة التقييم',
                                text: 'تم الارسال بنجاح',
                                icon: 'success',
                            }).then((value) => {
                                location.replace('./index.php');
                            })
                        },
                        error: function(data) {
                            $('#err_msg').html(data);
                        }
                    })
                }

            } else {
                Swal.fire({
                    title: 'استمارة التقييم',
                    text: 'تم الارسال بنجاح',
                    icon: 'success',
                }).then((value) => {
                    location.replace('./index.php');
                })
            }

        })
    </script>
</body>

</html>