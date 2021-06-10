<?php session_start(); include 'db-conn.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = 'e42e7cadc89089254237dd0da7d7c48e1c97518e';
    window.smartsupp || (function(d) {
        var s, c, o = smartsupp = function() {
            o._.push(arguments)
        };
        o._ = [];
        s = d.getElementsByTagName('script')[0];
        c = d.createElement('script');
        c.type = 'text/javascript';
        c.charset = 'utf-8';
        c.async = true;
        c.src = 'https://www.smartsuppchat.com/loader.js?';
        s.parentNode.insertBefore(c, s);
    })(document);
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-sclae=1.0">
    <title>A&A</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?
    family=Poppins:wght@600&family=Reggae+One&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <div class="container">
            <?php include(
                'header.php'
            );?>
            <div class="row">
                <div class="col-2">
                    <h1>Give Your Home<br>A New Look</h1>
                    <p>Stick to the things you really love.<br>An honest room is always up to date</p>
                    <a href="products.php" class="btn">Explore Now &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="assets/image/sonos-beam-smart-tv-sound-bar.jpg">
                </div>
            </div>
        </div>
    </div>

    <!--------- featured categories --------->
    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <img src="assets/image/google-nest-camera-doorbell.jpg">
                </div>
                <div class="col-3">
                    <img src="assets/image/august smart lock .jpg">
                </div>
                <div class="col-3">
                    <img src="assets/image/philips-hue-smart-wireless-motion-sensor-2-pack-white.jpg">
                </div>
            </div>
        </div>

    </div>

    <!----- featured products ----->
    <div class="small-container">
        <h2 class="title">Featured Products</h2>
        <div class="row">
            <?php
                 
                $query = "SELECT * FROM products where show_type='featured' limit 4";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
            ?>

            <div class="col-4">
                <a style="all:unset" href="product.php?id=<?php echo $row['id'];?>">
                    <img src="<?php echo $row['avatar']?>">
                    <h4><?php echo $row['product_name']?></h4>
                    <div class="rating">
                        <?php for($x=0; $x<5; $x++){
                            if($row['rating']>$x){
                                echo '<i class="fa fa-star"></i>';
                            }else{
                                echo '<i class="fa fa-star-o"></i>';
                            }    
                        ?>

                        <?php }?>
                    </div>
                    <p>Aed<?php echo $row['price']?></p>
                </a>
            </div>


            <?php }
                    }else {
                    echo "No product";
                 }
            ?>
        </div>
        <h2 class="title">Latest Products</h2>
        <div class="row">

            <div class="row">
                <?php
                    $query = "SELECT * FROM products WHERE show_type='latest' limit 8 ";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                    ?>

                <div class="col-4">
                    <a style="all:unset" href="product.php?id=<?php echo $row['id'];?>">
                        <img src="<?php echo $row['avatar']?>">
                        <h4><?php echo $row['product_name']?></h4>
                        <div class="rating">
                            <?php for($x=0; $x<5; $x++){
                            if($row['rating']>$x){
                                echo '<i class="fa fa-star"></i>';
                            }else{
                                echo '<i class="fa fa-star-o"></i>';
                            }    
                        ?>

                            <?php }?>
                        </div>
                        <p>Aed<?php echo $row['price']?></p>
                    </a>
                </div>


                <?php }
                     }else {
                     echo "No product";
                  }
             ?>
            </div>
        </div>

    </div>

    </div>
    <!----- Offer ----->
    <div class="offer">
        <div class="small-container">
            <div class="row">

                <?php
                    $query = "SELECT * FROM products WHERE show_type='exclusive' limit 8 ";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                    ?>

                <div class="col-2">
                    <img src="<?php echo $row['avatar']?>" class="offer">
                </div>
                <div class="col-2" style="padding: 20px;">
                    <p>Exclusively Available on A&A Store</p>
                    <h1><?php echo $row['product_name']?></h1>
                    <small><?php echo $row['desc']?></small>
                    <br>
                    <a href="product.php?id=<?php echo $row['id'];?>" class="btn">Buy Now &#8594;</a>
                </div>


                <?php }
                     }else {
                     echo "No Exclusive Product To Display";
                  }
                ?>

            </div>
        </div>
    </div>
    <!----- Testimonial ----->
    <div class="testimonial">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>A&A walks the journey with us, bringing their customer centric approach and sales
                        logic to our creative discussions with our clients, ensuring that what we create,
                        converts!</p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="assets/image/SAdiq.png">
                    <h3>Sadiq Ahmed</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>A&A walks the journey with us, bringing their customer centric approach and sales
                        logic to our creative discussions with our clients, ensuring that what we create,
                        converts!</p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="assets/image/tusky.jpg">
                    <h3>AbdulMalik Muhammad Sanusi</h3>
                </div>
            </div>
        </div>
    </div>


    <!---- footer ---->
    <?php include(
        'footer.php'
    );?>
    <!------js for toggle menu----->
</body>

</html>