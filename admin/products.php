<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `products`(name, description, category, price, image) VALUES(?,?,?,?,?)");
         $insert_product->execute([$name, $description, $category, $price, $image]);

         $message[] = 'new product added!';
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>
   <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>

body{
   background-color:black;
}
.add-products h3{
    color:white;
    text-align:center;
    font-size:35px;
    margin:20px
    
}
    /* Table Styles */
    .box-container {
        display: flex;
        justify-content: center;
        align-items: center;
        
    }

    .product-list {
   display: flex;
   flex-wrap: wrap;
   gap: 20px;
   
}

.product-item {
   background: #fff;
   border: 1px solid #ddd;
   border-radius: 10px;
   overflow: hidden;
   width: 250px;
   box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.product-image img {
   width: 100%;
   height: auto;
}

.product-details {
   padding: 15px;
   display: flex;
   flex-direction: column;
   gap: 10px;
}

.product-name {
   font-size: 18px;
   font-weight: bold;
}

.product-price,
.product-category,
.product-description {
   font-size: 14px;
   color: #555;
}

.product-actions {
   display: flex;
   justify-content: space-between;
}

.option-btn,
.delete-btn {
   text-decoration: none;
   padding: 5px 10px;
   border-radius: 5px;
   color: #fff;
}

.option-btn {
   background-color: #5cb85c;
}

.delete-btn {
   background-color: #d9534f;
}

.no-products {
   text-align: center;
   font-size: 18px;
   color: #888;
}

   
</style>

</head>
<body style="background-size: cover; background-position: center; background-repeat: no-repeat;">

<?php include '../components/admin_header.php' ?>

<!-- add products section starts  -->

<section class="add-products">

<h3>Add Products</h3>
<br><br>
   <form action="" method="POST" enctype="multipart/form-data">
      
      <input type="text" placeholder="Product Name" required  name="name" maxlength="100" class="box"><br>
      <input type="text"  placeholder="description"  required  name="description" maxlength="100" class="box"> <br>
      <input type="number" min="0" max="9999999999"  placeholder="Product Price"  required name="price" onkeypress="if(this.value.length == 10) return false;" class="box"> <br>
      <select name="category" class="box" required>
         <option value="" disabled selected>category --</option>
         <option value="main dish">main dish</option>
         <option value="fast food">fast food</option>
         <option value="drinks">drinks</option>
         <option value="desserts">desserts</option>
      </select><br>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="add product" name="add_product" class="box">
      
   </form>

   <section>
   <div class="product-list">
      <?php
         $show_products = $conn->prepare("SELECT * FROM `products`");
         $show_products->execute();
         if($show_products->rowCount() > 0){
            while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
      ?>
      <div class="product-item">
         <div class="product-image">
            <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         </div>
         <div class="product-details">
            <h3 class="product-name"><?= $fetch_products['name']; ?></h3>
            <p class="product-price"><?= $fetch_products['price']; ?>$</p>
            <p class="product-category"><?= $fetch_products['category']; ?></p>
            <p class="product-description"><?= $fetch_products['description']; ?></p>
            <div class="product-actions">
               <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Update</a>
               <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
            </div>
         </div>
      </div>
      <?php
            }
         } else {
            echo '<p class="no-products">No products added yet!</p>';
         }
      ?>
   </div>
</section>

<!-- show products section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>