<?php include 'components/add_cart.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Foodery</title>
    <link rel="stylesheet" href="styles.css">
    <!-- FontAwesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="css/about.css" rel="stylesheet">
</head>
<body>
<?php include "components/user_header.php"; ?>
    <section id="about-us">
        <div class="overlay"></div>
        <div class="content">
            <div class="text-content">
                <h1>Welcome to Foodery</h1>
                <p>At Foodery, we are passionate about bringing you the finest culinary experiences. Our chefs use the freshest ingredients to create delicious dishes that will tantalize your taste buds. Come and enjoy a memorable dining experience with us.</p>
                <a href="#menu" class="btn">Explore Our Menu</a>
            </div>
            <div class="image-content">
                <img src="images/about-removebg.png" alt="Delicious food" class="about-image">
            </div>
        </div>
    </section>
    <?php include "components/footer.php"; ?>
</body>
</html>
