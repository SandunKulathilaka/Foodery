<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
   $item_count = 0;
}else{
   $user_id = '';
   header('location:index.php');
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      if($address == ''){
         $message[] = 'please add your address!';
      }else{
         
         $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
         $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);

         $message[] = 'order placed successfully!';
      }
      
   }else{
      $message[] = 'your cart is empty';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
   .checkout{
   display: flex;
   flex-direction: row;
   align-items: center;
   justify-content: space-around;
   height: 600px;

   }
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

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
        }
        .user-info, .user-info2 {
            margin-bottom: 20px;
        }
        .user-info h3, .user-info2 h3 {
            margin-bottom: 10px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        .user-info p, .user-info2 p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
            display: flex;
            align-items: center;
        }
        .user-info p i, .user-info2 p i {
            margin-right: 10px;
            color: #4CAF50;
        }
        .user-info .btn, .user-info2 .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease;
            text-decoration: none;
            margin-top: 10px;
        }
        .user-info .btn:hover, .user-info2 .btn:hover {
            background-color: #45a049;
        }
        .box {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Checkout</h3>
</div>

<section class="checkout">

<div class="cart-items">
      <h3>Cart Items</h3>
      <table class="table">
      <thead>
    <tr>
      <th scope="col">Item No</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Qty</th>
      <th scope="col">Total</th>
      <th scope="col">Grand Total</th>
    </tr>
  </thead>
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
               $total = ($fetch_cart['price'] * $fetch_cart['quantity']);
               $item_count++;
      ?>
      
  
  <tbody>
    <tr>
   
      <th scope="row"><?= $item_count ?></th>
      <td><?= $fetch_cart['name']; ?></td>
      <td>$<?= $fetch_cart['price']; ?></td>
      <td><?= $fetch_cart['quantity']; ?></td>
      <td>$<?= $total ?></td>
      <td></td>
    </tr>
    <?php
            }
         }else{
            echo '<p class="empty">your cart is empty!</p>';
         }
      ?>
    <tr>
      <th scope="row"></th>
      <td colspan="4">Grand Total = </td>
      <td>$<?= $grand_total ?></td>
    </tr>
  </tbody>
</table>
</div>

<form action="" method="post">
        <input type="hidden" name="total_products" value="<?= $total_products; ?>">
        <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
        <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
        <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
        <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
        <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

        <div class="user-info">
            <?php  
                $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_user->execute([$user_id]);
                $fetch_profile = $select_user->fetch(PDO::FETCH_ASSOC);
            ?>
            <h3>your info</h3>
            <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?></span></p>
            <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
            <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
            <a href="update_profile.php" class="btn">update info</a>
        </div>

        <div class="user-info2">
            <h3>delivery address</h3>
            <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'please enter your address';}else{echo $fetch_profile['address'];} ?></span></p>
            <a href="update_address.php" class="btn">update address</a>
            <select name="method" class="box" required>
                <option value="" disabled selected>select payment method --</option>
                <option value="cash on delivery">cash on delivery</option>
                <option value="credit card">credit card</option>
                <option value="paytm">paytm</option>
                <option value="paypal">paypal</option>
            </select>
            <input type="submit" value="place order" onclick="submitForm()" class="btn <?php if($fetch_profile['address'] == ''){echo 'disabled';} ?>" name="submit">
        </div>
    </form>
</section>


<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
   function submitForm(){
      
   }
</script>
</body>
</html>