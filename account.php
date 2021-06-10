<?php
session_start();
include 'db-conn.php';

if(isset($_POST['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['userid']);
    header('location:index.php');
}

if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $sql = "SELECT id FROM users where email='$email' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<script type="text/JavaScript"> 
            alert("User with email already exists");
        </script>';   
    } else {
        $sql = "INSERT INTO users (username, email, password)
        VALUES ('$username', '$email', '$password')";
    
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/JavaScript"> 
                alert("Account Created successfully");
            </script>';
        } else {
            echo '<script type="text/JavaScript"> 
                alert("Error While creating user");
             </script>';
        }
    }
   
};

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $query = "SELECT * FROM users WHERE `email`='$email' and `password` = '$password'";
    $result = mysqli_query($conn,$query) ;
	$rows = mysqli_num_rows($result);
    
    if ($rows == 1) {
        // output data of each row
        $row = $result->fetch_assoc();
        $_SESSION['username']=$row['username'];
        $_SESSION['email']=$row['email'];
        $_SESSION['userid']=$row['id'];
        header("Location: index.php");
        
    } else {
        echo '<script type="text/JavaScript"> 
            alert("Invalid Credentials Entered");
        </script>'; 
    }

};
?>
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
</head>

<body>

    <div class="container">
        <?php include 'header.php';?>
    </div>
    <!------ account-page----->
    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="assets/image/chamberlain-smart-garage-door-opener.jpg" width="100%">
                </div>
                <div class="col-2">

                    <div class="form-container">
                        <?php
                        if(isset($_SESSION['userid'])){?>
                        <div class="form-btn">
                            Logged In as :
                            <?php echo $_SESSION['username'];?><br>
                            Email :
                            <?php echo $_SESSION['email'];?>
                            <form style="all:unset" method="POST">
                                <button type="submit" name="logout" class="btn">Logout</button>
                            </form>
                        </div>
                        <?php }else{?>
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Register</span>
                            <hr id="Indicator">
                        </div>
                        <form id="LoginForm" method="POST">
                            <input type="text" placeholder="Email" name="email">
                            <input type="password" placeholder="Password" name="password">
                            <button type="submit" name="login" class="btn">Login</button>
                            <a href="">Forgot password</a>
                        </form>
                        <form id="RegForm" method="POST">
                            <input type="text" placeholder="Username" name="username">
                            <input type="email" placeholder="Email" name="email">
                            <input type="password" placeholder="Password" name="password">
                            <button type="submit" name='register' class="btn">Register</button>
                        </form>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
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
    </script>


    <!-------------js for toggle Form-------->

    <script>
    var LoginForm = document.getElementById("LoginForm")
    var RegForm = document.getElementById("RegForm")
    var Indicator = document.getElementById("Indicator")

    function register() {

        RegForm.style.transform = "translateX(0px)";
        LoginForm.style.transform = "translateX(0px)";
        Indicator.style.transform = "translateX(100px)";
    }

    function login() {
        RegForm.style.transform = "translateX(300px)";
        LoginForm.style.transform = "translateX(300px)";
        Indicator.style.transform = "translateX(0px)";
    }
    </script>

</body>

</html>