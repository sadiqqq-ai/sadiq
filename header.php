<?php
if(isset($_SESSION['userid'])){
    $username=$_SESSION['username'];
    $email=$_SESSION['email'];
    $id=$_SESSION['userid'];
}else{$username='';$email='';$id='';}

?>
<div class="navbar">
    <div class="logo">
        <a href="index.php"><img src="assets/image/logo_size.jpg" width="125px"></a>
    </div>
    <nav>
        <ul id="MenuItems">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Product</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="account.php">Account
                    <?php if($username!=''){echo" (".$username.")";}?></a></li>
        </ul>
    </nav>
    <a href="cart.php"><img src="assets/image/cart.svg" width="30px" height="30px"></a>
    <img src="assets/image/menu.jpg" class="menu-icon" onclick="menutoggle()">
</div>