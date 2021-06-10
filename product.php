<?php session_start();
include ('db-conn.php');
if(isset($_POST['addCart'])){
    if(isset($_SESSION['userid'])){
        $userid=$_SESSION['userid'];
        $productid = mysqli_real_escape_string($conn,$_POST['productid']);
        $quantity = mysqli_real_escape_string($conn,$_POST['quantity']);

        $sql = "SELECT id FROM cart where productid='$productid' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sql = "UPDATE cart SET quantity = '$quantity' where productid='$productid' ";
            $conn->query($sql);
            echo '<script type="text/JavaScript"> 
                alert("Cart updated successfully");
            </script>';  
        } else {
            $sql = "INSERT INTO cart (userid, productid, quantity)
            VALUES ('$userid', '$productid', '$quantity')";
        
            if ($conn->query($sql) === TRUE) {
                echo '<script type="text/JavaScript"> 
                    alert("Product added to cart successfully");
                </script>';
            } else {
                echo '<script type="text/JavaScript"> 
                    alert("Error while adding item to cart");
                </script>';
            }
        }
    }else{
        echo '<script type="text/JavaScript"> 
            alert("Please login to add item to cart ");
        </script>';
    }
   
};
?>
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
    <title>All Products - A&A</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?
    family=Poppins:wght@600&family=Reggae+One&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container">
        <?php include 'header.php';?>
    </div>

    <!----- single product details ----->

    <div class="small-container single-product">
        <?php
        include 'db-conn.php';
            if(isset($_GET['id'])){
                $pid=$_GET['id'];
            }else{$pid='0';}
         $query = "SELECT * FROM products WHERE `id`='$pid'";
         $result = mysqli_query($conn,$query) ;
         $rows = mysqli_num_rows($result);
         
         if ($rows == 1) {
             $product = $result->fetch_assoc();
        ?>
        <div class="row">
            <div class="col-2">
                <img src="<?php echo $product['avatar'];?>" width="100%" id="ProductImg">

                <div class="small-img-row">
                    <div class="small-img-col">
                        <img src="<?php echo $product['avatar'];?>" width="100%" class="small-img">
                    </div>
                    <?php $alt_images = explode(',', $product['alt_avatar']);
                        foreach ($alt_images as $image) {?>
                    <div class="small-img-col">
                        <img src="<?php echo $image?>" width="100%" class="small-img">
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-2">
                <p><?php echo $product['category'];?></p>
                <h1><?php echo $product['product_name'];?></h1>
                <h4>Aed<?php echo $product['price'];?></h4>

                <form method="POST">
                    <input type="number" name='quantity' value="1">
                    <input type="text" hidden name='productid' value="<?php echo $product['id'];?>">
                    <button name='addCart' style="max-width: 300px; padding:10px;" class="btn">Add To Cart</button>
                </form>

                <h3><?php echo $product['product_name'];?> Details <i class="fa fa-ident"></i></h3>
                <br>
                <p><?php echo $product['desc'];?></p>

                <h4>About this item <i class-"fa fa-ident"></i></h4>
                <br>
                <p><?php echo preg_replace('/[^\.]+\.+([^\.]+\.+)?\s?/', '<p>$0</p>', $product['about']);?></p>
            </div>
        </div>
        <?php }else{echo 'product not found';}?>
    </div>

    <!----- title ---->
    <div class="small-container">
        <div class="row row-2">
            <h2>Related Products</h2>
            <p>View More</p>
        </div>

    </div>


    <!-----products---->
    <div class="small-container">

        <div class="row">
            <?php
                 
                $query = "SELECT * FROM products where id!='$pid' limit 3";
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

    <!---- footer ---->
    <?php include 'footer.php';?>
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
    </script>

    <!------- js for product gallery ----->
    <script>
    var ProductImg = document.getElementById("ProductImg");
    var SmallImg = document.getElementsByClassName("small-img");

    SmallImg[0].onclick = function() {
        ProductImg.src = SmallImg[0].src;
    }
    SmallImg[1].onclick = function() {
        ProductImg.src = SmallImg[1].src;
    }
    SmallImg[2].onclick = function() {
        ProductImg.src = SmallImg[2].src;
    }
    SmallImg[3].onclick = function() {
        ProductImg.src = SmallImg[3].src;
    }
    </script>
</body>

</html>
