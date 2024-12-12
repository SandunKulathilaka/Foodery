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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodery</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
     <style>
        .heading-cat{
            text-align: center;
            margin: 0px;
            background-color:  black;
            color: white;
        }
     </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>

    <div class="main-banner">
        <div class="left-section">
            <h1>WE SERVE THE <span>BEST FOOD</span></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos aut iste quod id ad.
                 Corporis, delectus laudantium dolor ratione doloribus tenetur
            </p>
            <button>Order Now</button>
        </div>
        <div class="right-section">
            <div class="images">
            <img src="images/burger-removebg.png" alt="" width="50%" height="auto">
            <img src="images/cofee.png" alt="" width="50%" height="auto">
            </div>
            
        </div>
    </div>
    <div class="heading-cat">
        <h1>Category</h1>
    </div>
    <div class="categorys">
            <div class="card" onclick="redirect()">
                <img src="images/pizza.png" alt="Card Image" class="card-image" width="auto" height="auto">
                <h1 class="card-heading">Pizza</h1>
            </div>
            <div class="card" onclick="redirect()">
                <img src="images/burger.png" alt="Card Image" class="card-image" width="auto" height="auto">
                <h1 class="card-heading">Burger</h1>
            </div>
            <div class="card" onclick="redirect()">
                <img src="images/pasta.png" alt="Card Image" class="card-image" width="auto" height="auto">
                <h1 class="card-heading">Pasta</h1>
            </div>
            <div class="card" onclick="redirect()">
                <img src="images/deserts.png" alt="Card Image" class="card-image" width="auto" height="auto">
                <h1 class="card-heading">Deserts</h1>
            </div>
        </div>
    <div class="latest">
        <div class="pop-heading">
            <h2>Popular Items</h2>   
        </div>
<div class="latest-card">
    <div class="card-container">
    <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 4");
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
                           <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                           <button id="cartIcon" type="submit" class="fas fa-shopping-cart" name="add_to_cart">
                           <span class="card-link">Add to cart</span>
                        </button>
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
</div>
<?php include 'components/footer.php'; ?>
<script>
    function redirect(){
        window.location.href = 'menu.php';
    }
</script>
</body>
</html>