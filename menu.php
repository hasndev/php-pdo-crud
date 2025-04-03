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

</head>

<body>
    <div class="header">
        <a href="index.php" class="logo">
            <i class="fa fa-cutlery"></i>
            Mazaya
        </a>
        <div class="right">
            <a href="index.php">Home</a>
            <a class="active" href="#menu">Menu</a>
            <a href="#review">Contact</a>
        </div>
    </div>
    <!--Hero section-->
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
                    $q = "SELECT `name`,`price`,`pic`,`status`,`id` FROM `dishes` ORDER BY id DESC";
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
                                <input type="text" required>
                            </div>
                            <div class="form-group">
                                <label> How do you rate our service?</label>
                                <select>
                                    <option>Good</option>
                                    <option>Moderate</option>
                                    <option>Bad</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Any Notes?</label>
                                <textarea></textarea>
                            </div>
                            <div class="text-center"><button type="submit"> Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer>
        <div style="background:#333; margin:0%; padding:0%; height:15%;">
            <h1 style="text-align:center; font-weight:600; color:white; padding: 10px;">Mazaya</h1>
        </div>
    </footer>
</body>

</html>