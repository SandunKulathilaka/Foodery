<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'cart item deleted!';
}

if(isset($_POST['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   // header('location:cart.php');
   $message[] = 'deleted all from cart!';
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>
   <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
.title {
   font-size: 2.5rem;
   text-align: center;
   margin: 20px 0;
}

.more-btn>a{
   margin: 10px;
}

/* Header and Navigation */
.heading {
   display: flex;
   align-items: center;
   justify-content: center;
   flex-direction: column;
   background-color: black;
   min-height: 8rem;
   padding: 1rem;
}

.heading h3 {
   font-size: 3rem;
   color: #fff;
   text-transform: capitalize;
}

.heading p {
   font-size: 1.3rem;
   color: #ccc;
}

.heading p a {
   color: #4CAF50;
}

/* Shopping Cart Section */
.products {
   max-width: 100%;
   margin: 0 auto;
   padding: 20px;
   display: center;
   align-items: center;
   justify-content: center;
}

.box-container {
   display: flex;
   gap: 20px;
   align-items: center;
   justify-content: center;
   margin-bottom: 20px;
}

.box {
   background-color: #fff;
   border-radius: 10px;
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
   padding: 15px;
   display: flex;
   flex-direction: column;
   align-items: center;
   transition: transform 0.3s, box-shadow 0.3s;
   width: 250px;
}

.box:hover {
   transform: translateY(-5px);
   box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.box img {
   max-width: 100%;
   border-radius: 10px;
   margin-bottom: 15px;
}

.box .name {
   font-size: 1.2rem;
   font-weight: bold;
   margin-bottom: 10px;
   text-align: center;
}

.box .flex {
   display: flex;
   align-items: center;
   justify-content: space-between;
   width: 100%;
}

.box .price {
   font-size: 1.1rem;
   color: #333;
}

.box .qty {
   width: 50px;
   text-align: center;
}

.box .sub-total {
   margin-top: 15px;
   font-size: 1rem;
   color: #333;
}

.box .fas {
   cursor: pointer;
   margin-left: 10px;
   color: #333;
}

.box .fas:hover {
   color: #4CAF50;
}

/* Cart Total and More Buttons */
.cart-total, .more-btn {
   text-align: center;
   margin-bottom: 20px;
}

.cart-total p {
   font-size: 1.5rem;
   font-weight: bold;
   margin-bottom: 10px;
}

.cart-total .btn, .more-btn .btn, .more-btn .delete-btn {
   padding: 10px 20px;
   background-color: #4CAF50;
   color: #fff;
   border: none;
   border-radius: 5px;
   cursor: pointer;
   transition: background-color 0.3s;
}

.cart-total .btn:hover, .more-btn .btn:hover, .more-btn .delete-btn:hover {
   background-color: #45a049;
}

.cart-total .btn.disabled, .more-btn .delete-btn.disabled {
   background-color: #ccc;
   cursor: not-allowed;
}

/* Responsive Design */
@media (max-width: 768px) {
   .box-container {
      grid-template-columns: 1fr;
   }

   .heading h3 {
      font-size: 2rem;
   }

   .heading p {
      font-size: 1rem;
   }

   .title {
      font-size: 2rem;
   }
}

   </style>

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>shopping cart</h3>
</div>

<!-- shopping cart section starts  -->

<section class="products">

   <div class="box-container">

      <?php
         $grand_total = 0;
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
         <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('delete this item?');"></button>
         <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
         <div class="name"><?= $fetch_cart['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_cart['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
            <button type="submit" class="fas fa-edit" name="update_qty"></button>
         </div>
         <div class="sub-total"> sub total : <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
      </form>
      <?php
               $grand_total += $sub_total;
            }
         }else{
            echo '<p class="empty">your cart is empty</p>';
         }
      ?>

   </div>

   <div class="cart-total">
      <p>Cart Total : <span>$<?= $grand_total; ?></span></p>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

   <div class="more-btn">
      <form action="" method="post">
         <button type="submit" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" name="delete_all" onclick="return confirm('delete all from cart?');">delete all</button>
      </form>
      <a href="menu.php" class="btn">continue shopping</a>
   </div>

</section>

<!-- shopping cart section ends -->










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>