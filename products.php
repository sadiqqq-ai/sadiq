<?php session_start(); include "db-conn.php";?>
<!DOCTYPE html>
<html lang="en" <head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-sclae=1.0">
<title>All Products - A&A</title>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?
    family=Poppins:wght@600&family=Reggae+One&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<body>

    <div class="container">
        <?php include 'header.php'?>

    </div>

    <div class="small-container">

        <div class="row row-2">
            <h2>All Products</h2>
            <select id='sort'>
                <option value="" <?php if(isset($_GET['sort'])){if($_GET['sort']==''){echo 'selected';}}?>>Default
                    Sorting</option>
                <option value="h" <?php if(isset($_GET['sort'])){if($_GET['sort']=='h'){echo 'selected';}}?>>Sort by
                    price High - Low</option>
                <option value="l" <?php if(isset($_GET['sort'])){if($_GET['sort']=='l'){echo 'selected';}}?>>Sort by
                    price LO - HI</option>
                <option value="rating" <?php if(isset($_GET['sort'])){if($_GET['sort']=='rating'){echo 'selected';}}?>>
                    Sort
                    by rating</option>
            </select>
        </div>

        <div class="row">
            <?php
                if(isset($_GET['sort'])){
                    if($_GET['sort']=='h'){$sort = 'price DESC';}
                    else if($_GET['sort']=='l'){ $sort = 'price ASC';}
                    else if($_GET['sort']=='rating'){ $sort = 'rating DESC';}
                }else { $sort = 'id';}
                $query = "SELECT * FROM products ORDER BY $sort limit 20 ";
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

        <div class="page-btn">
            <span>1</span>
            <span>&#8594;</span>
        </div>
    </div>

    <!---- footer ---->
    <?php include(
        'footer.php'
    );?>
    <!------js for toggle menu----->
    <script>
    var MenuItems = document.getElementById("MenuItems");
    MenuItems.style.maxHeight = "0px";

    function menutoggle() {
        if (MenuItems.style.maxHeight == "0px") {
            MenuItems.style.maxHeight = "200px";
        } else {
            MenuItems.style.maxHeight = "0px";
        }
    }
    $('#sort').on('change', function() {
        var selectVal = $("#sort option:selected").val();
        window.location.href = "products.php?sort=" + selectVal;
    });
    </script>
</body>

</html>