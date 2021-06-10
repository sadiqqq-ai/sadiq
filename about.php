<!DOCTYPE html>
<html lang="en">
<?php session_start();?>

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
    <div class="about-section">
        <div class="inner-container">
            <h1>About Us</h1>
            <p class="text">
                Welcome to A&A, your number one source for Smart Home Products. We're dedicated to providing you the
                very best of our products,
                Founded in 2021 by Sadiq and Abdulmalik, A&A has come a long way from its beginnings in Dubai Academic
                City. When Sadiq and Abdulmalik
                first started out, their passion for smart home drove them to start their own business.We hope you enjoy
                our products as much as we enjoy
                offering them to you. If you have any questions or comments, please don't hesitate to contact us.<br>
                <br>
                Sincerely,<br>
                Sadiq & Abdulmalik.
            </p>
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
</body>

</html>