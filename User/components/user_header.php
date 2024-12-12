<?php

include 'components/connect.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>

<style>
    body{
        margin: 0px;
        padding: 0px;
    }
    .nav-bar{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 70px;
        background-color: black;
        color: white;
    }
    .logo{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30%;
    }
    .logo > h1{
        margin-right: 20px;
    }
    .headings{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50%;
    }
    .nav-icons{
        display: flex;
        align-items: center;
        justify-content: end;
        width: 20%;
        margin-right: 20px;
    }
    .headings > a{
        text-decoration: none;
        margin: 20px;
        padding: 5px;
        font-size: 20px; 
        color: white;
        font-weight: bold;
    }
</style>

<div class="nav-bar">
    <div class="logo">
        <h1>Foodery</h1>
        <img src="images/logo-removebg.png" alt="" width="60px" height="60px">
    </div>
    <div class="headings">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="menu.php">Menu</a>
        <a href="contact.php">Contact Us</a>
        <a href="orders.php">Orders</a>
        <?php if ($user_id != '') { ?>
                        <a class="nav-link active" aria-current="page" href="profile.php?<?php echo"$user_id"?>">Profile</a>
                    <?php } else { ?>
                        <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                    <?php } ?>
    </div>
    <div class="nav-icons">
    <?php
    $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $count_cart_items->execute([$user_id]);
    $total_cart_items = $count_cart_items->rowCount();
    ?>
    <a href="cart.php" style="color: white;"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
    </div>
</div>