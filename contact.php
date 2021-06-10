<?php 
session_start();
include 'db-conn.php';
if(isset($_POST['contact_us'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);

    $sql = "INSERT INTO contact_us (name, email, phone,message) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo '<script type="text/JavaScript"> 
            alert("Message sent successfully");
        </script>';
    } else {
        echo '<script type="text/JavaScript"> 
            alert("Error while sending message");
            </script>';
    }

   
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
        <?php include(
            'header.php'
        );?>
    </div>

    <!--------contact-section------>

    <div class="contact-section">

        <h1>Contact Us</h1>
        <div class="border"></div>
        <form class="contact-form" method="post">
            <input type="text" class="contact-form-text" placeholder="Name" name='name'>
            <input type="email" class="contact-form-text" placeholder="Email" name='email'>
            <input type="text" class="contact-form-text" placeholder="Phone number" name='phone'>
            <textarea class="contact-form-text" placeholder="Your message" name="message"></textarea>
            <input type="submit" name='contact_us' class="contact-form-btn" placeholder="Send">
        </form>
    </div>
    <br>

    <!---- footer ---->
    <?php include(
        'footer.php'
    );?>
</body>

</html>