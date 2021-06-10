<?php session_start(); include('db-conn.php');

if(isset($_POST['remove'])){
    if(isset($_SESSION['userid'])){
        $userid=$_SESSION['userid'];
        $cartid=$_POST['remove'];
             
        $sql = "DELETE FROM cart WHERE id='$cartid'";

        if ($conn->query($sql) === TRUE) {
            echo  '<script type="text/JavaScript"> 
                alert("Cart Updated Successfully! ");
            </script>';
        } else {
            echo  '<script type="text/JavaScript"> 
                alert("Error While Updating Cart ");
            </script>';
        }
    }else{
        echo '<script type="text/JavaScript"> 
            alert("Please login to add item to cart ");
        </script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en" <head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-sclae=1.0">
<title>Cart - A&A</title>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?
    family=Poppins:wght@600&family=Reggae+One&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="cart.css">
</head>

<body>

    <div class="container">
        <?php include 'header.php'?>

    </div>

    <div class="shopping-cart">

        <div class="column-labels">
            <label class="product-image">Image</label>
            <label class="product-details">Product</label>
            <label class="product-price">Price</label>
            <label class="product-quantity">Quantity</label>
            <label class="product-removal">Remove</label>
            <label class="product-line-price">Total</label>
        </div>

        <?php
            if(isset($_SESSION['userid'])){
                $userid = $_SESSION['userid'];
                $query = "SELECT *,cart.quantity as cQuantity,cart.id as cid FROM cart INNER JOIN products ON cart.productid=products.id where userid='$userid'" ;
                $result = mysqli_query($conn, $query);
                $total = 0;
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        $total=$total+((preg_replace('/[^\d.]/', '',$row['price']))*$row['cQuantity']);
        ?>
        <div class="product">
            <div class="product-image">
                <img src="<?php echo $row['avatar']?>">
            </div>
            <div class="product-details">
                <div class="product-title"><b><?php echo $row['product_name']?></b>
                </div>
                <p class="product-description"><?php echo $row['desc']?></p>
            </div>
            <div class="product-price"><?php echo $row['price'];?></div>
            <div class="product-quantity">
                <?php echo $row['cQuantity']?>
            </div>
            <div class="product-removal">
                <form method="POST">
                    <button name='remove' value="<?php echo $row['cid']?>" class="remove-product">
                        Remove
                    </button>
                </form>
            </div>
            <div class="product-line-price"><?php echo (preg_replace('/[^\d.]/', '',$row['price'])*$row['cQuantity']);?>
            </div>
        </div>
        <?php }}
            
            else{
                echo '<div style="width:100%; text-align:center"> No item found in cart </div>';}
        ?>


        <div class="totals">
            <div class="totals-item">
                <label>Subtotal</label>
                <div class="totals-value" id="cart-subtotal"><?php echo $total?></div>
            </div>
            <div class="totals-item">
                <label>Tax (5%)</label>
                <div class="totals-value" id="cart-tax"><?php echo ($total*0.05);?></div>
            </div>
            <div class="totals-item">
                <label>Shipping</label>
                <div class="totals-value" id="cart-shipping">10</div>
            </div>
            <div class="totals-item totals-item-total">
                <label>Grand Total</label>
                <div class="totals-value" id="cart-total"><?php echo $total+($total*0.05)+10;?></div>
            </div>
        </div>

        <a href="checkout.php" class="checkout">Checkout</a>

    </div>
    <?php }else{
        echo '<div style="width:100%; padding:100px; text-align:center"> User not logged in</div>';
    }?>
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
    </script>
</body>

</html>