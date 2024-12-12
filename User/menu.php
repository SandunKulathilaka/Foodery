<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menu</title>
   <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">
   <link rel="stylesheet" href="css/menu.css">
</head>
<body>

   <!-- header section starts  -->
   <?php include 'components/user_header.php'; ?>

      
         <div class="card-section"> 
            <h1>Main Menu</h1>    
            <div class="card-container">
            <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
               <div class="prod-card">
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="Product Image" class="card-image">
                  <div class="card-content">
                     <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><span class="card-category"><?= $fetch_products['category']; ?></span></a>    
                     <h2 class="card-title"><?= $fetch_products['name']; ?></h2>
                     <div class="card-details">
                        <span class="card-rating">⭐ 4.5</span>
                        <span class="card-price">$<?= $fetch_products['price']; ?></span>
                     </div>
                     <div class="card-details">
                        <span class="card-rating"><?= $fetch_products['description']; ?></span>
                     </div>
                     <div class="cart">
                        <form id="cartForm" action="" method="post">
                           <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                           <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                           <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                           <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                        
                        <button id="cartIcon" type="submit" class="fas fa-shopping-cart" name="add_to_cart">
                           <span class="card-link">Add to cart</span>
                        </button>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                        </form>
                     </div>
                  </div>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">No products added yet!</p>';
         }
      ?>
            </div>
         </div>
      
   </section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<script>
   function submitForm() {
      document.getElementById("cartIcon").addEventListener("click", function(event) {
      
         var pid = document.querySelector("#cartForm input[name='pid']").value;
         var name = document.querySelector("#cartForm input[name='name']").value;
         var price = document.querySelector("#cartForm input[name='price']").value;
         var image = document.querySelector("#cartForm input[name='image']").value;
         var qty = document.querySelector("#cartForm input[name='qty']").value;

         

         // Prompt the user to confirm form submission
         var confirmSubmit = confirm("Do you want to add this product to your cart?");
         if (confirmSubmit) {
            document.getElementById("cartForm").submit(); // Submits the form
         }
      });
   }
</script>

</body>
</html>