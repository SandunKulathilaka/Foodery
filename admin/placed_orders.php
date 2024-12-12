<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){

   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Placed Orders</title>
   <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      body{
   background-color:black;
}
.placed-orders {
   width: 90%;
   margin: auto;
}

.placed-orders h1 {
   margin: 30px;
}

.heading {
   text-align: center;
   margin-bottom: 20px;
}

.order-list {
   display: flex;
   flex-direction: column;
   gap: 20px;
}

.order-item {
   display: flex;
   flex-direction: column;
   background: #333;
   color:white;
   border: 1px solid #ddd;
   border-radius: 10px;
   padding: 20px;
   box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.order-details p {
   margin: 5px 0;
   font-size:15px
}

.order-actions {
   display: flex;
   align-items: center;
   justify-content: space-between;
   margin-top: 10px;
}

.update-form {
   display: flex;
   align-items: center;
   gap: 10px;
}

.update-form select,
.update-form input[type="submit"] {
   padding: 5px;
}

.delete-btn {
   padding: 5px 10px;
   background-color: #d9534f;
   color: #fff;
   text-decoration: none;
   border-radius: 5px;
}

.empty {
   text-align: center;
   font-size: 18px;
   color: #888;
}

.update{
   background-color: #4caf50;
}
   
</style>

</head>
<body style="background-size: cover; background-position: center; background-repeat: no-repeat;">

<?php include '../components/admin_header.php' ?>

<!-- placed orders section starts  -->

<section class="placed-orders">

   <h1 class="heading">Placed Orders</h1>

   <div class="order-list">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="order-item">
         <div class="order-details">
            <p><strong>User ID:</strong> <?= $fetch_orders['user_id']; ?></p>
            <p><strong>Placed On:</strong> <?= $fetch_orders['placed_on']; ?></p>
            <p><strong>Name:</strong> <?= $fetch_orders['name']; ?></p>
            <p><strong>Email:</strong> <?= $fetch_orders['email']; ?></p>
            <p><strong>Number:</strong> <?= $fetch_orders['number']; ?></p>
            <p><strong>Address:</strong> <?= $fetch_orders['address']; ?></p>
            <p><strong>Total Products:</strong> <?= $fetch_orders['total_products']; ?></p>
            <p><strong>Total Price:</strong> $<?= $fetch_orders['total_price']; ?>/-</p>
            <p><strong>Payment Method:</strong> <?= $fetch_orders['method']; ?></p>
         </div>
         <div class="order-actions">
            <form action="" method="POST" class="update-form">
               <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
               <select name="payment_status">
                  <option value="<?= $fetch_orders['payment_status']; ?>" selected disabled><?= $fetch_orders['payment_status']; ?></option>
                  <option value="pending">Pending</option>
                  <option value="completed">Completed</option>
               </select>
               <input type="submit" class="update"value="Update" name="update_payment">
            </form>
            <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
         </div>
      </div>
      <?php
            }
         } else {
            echo '<p class="empty">No orders placed yet!</p>';
         }
      ?>
   </div>

</section>

<!-- placed orders section ends -->









<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>