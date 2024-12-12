<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>

body{
   background-color:black;
}
 .box-container {
      display: grid;
      grid-template-columns: repeat(2, 1fr); /* 2 columns */
      grid-template-rows: repeat(4, 1fr); /* 4 rows */
      gap: .5rem; /* Gap between grid items */
      justify-content:space-around; 
      margin:40px;
      
   }

.box {
   background: #333;
   border-radius: 30px;
   padding: 20px;
   width: 600px;
   height: 80px;
   text-align: center;
   display:flex;
   align-items:center;
   justify-content:space-between;
   margin:20px;
   
}
.box h3 {
   margin: 20px;
   font-size: 2.7rem;
}

.box p {
   padding:2rem;
   border-radius: .5rem;
   color: white;
   border-radius: .5rem;
   font-size: 1.8rem;
   margin:2rem;
}

.box a.btn {
   display: block;
   background-color: black;
   color: #fff;
   text-decoration: none;
   text-align:center;
   font-size:15px;
   padding-top:8px;
   border-radius: 2rem;
   transition: background-color 0.3s;
   width:200px;
   height: 40px;
   margin-top:7px;
}
.dashboard h1{
   color: white;
   margin:30px;
   
}





.dashboard .box-container .box h3 span{
   font-size: 2rem;
}




   </style>

</head>
<body style="background-size: cover; background-position: center; background-repeat: no-repeat;">

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">Admin Panel Dashboard</h1>
   <br><br><br>


   <div class="box-container">

   <div class="box">
      <h3>Profile</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update_profile.php" class="btn">update profile</a>
   </div>

   <div class="box">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         }
      ?>
      <h3><span>$</span><?= $total_pendings; ?><span>/-</span></h3>
      <p>total pendings</p>
      <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <div class="box">
      <?php
         $total_completes = 0;
         $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completes->execute(['completed']);
         while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
            $total_completes += $fetch_completes['total_price'];
         }
      ?>
      <h3><span>$</span><?= $total_completes; ?><span>/-</span></h3>
      <p>total completes</p>
      <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $numbers_of_orders = $select_orders->rowCount();
      ?>
      <h3><?= $numbers_of_orders; ?></h3>
      <p>total orders</p>
      <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $numbers_of_products = $select_products->rowCount();
      ?>
      <h3><?= $numbers_of_products; ?></h3>
      <p>products added</p>
      <a href="products.php" class="btn">see products</a>
   </div>

   <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h3><?= $numbers_of_users; ?></h3>
      <p>users accounts</p>
      <a href="users_accounts.php" class="btn">see users</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
      <p>admins</p>
      <a href="admin_accounts.php" class="btn">see admins</a>
   </div>

   <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $numbers_of_messages = $select_messages->rowCount();
      ?>
      <h3><?= $numbers_of_messages; ?></h3>
      <p>new messages</p>
      <a href="messages.php" class="btn">see messages</a>
   </div>

   </div>

</section>

<!-- admin dashboard section ends -->









<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>