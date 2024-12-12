<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';

   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us - Foodery</title>
   <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- Bootstrap CSS link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/contact.css">
</head>
<body>

<!-- Header section starts -->
<?php include 'components/user_header.php'; ?>
<!-- Header section ends -->

<!-- Contact section starts -->
<section class="contact">
   <div class="container">
      <div class="headings text-center mb-5">
         <h1>Contact Us</h1>
      </div>
      <div class="row justify-content-center">
         <div class="col-md-8">
            <form action="" method="post">
               <div class="form-group mb-4">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" name="name" maxlength="50" class="form-control form-control-lg" placeholder="Enter your name" required>
               </div>
               <div class="form-group mb-4">
                  <label for="number" class="form-label">Number</label>
                  <input type="number" name="number" min="0" max="9999999999" class="form-control form-control-lg" placeholder="Enter your number" required maxlength="10">
               </div>
               <div class="form-group mb-4">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" maxlength="50" class="form-control form-control-lg" placeholder="Enter your email" required>
               </div>
               <div class="form-group mb-4">
                  <label for="msg" class="form-label">Message</label>
                  <textarea name="msg" class="form-control form-control-lg" required placeholder="Enter your message" maxlength="300" cols="30" rows="10"></textarea>
               </div>
               <div class="form-group text-center">
                  <button type="submit" name="send" class="btn btn-warning btn-lg">Send Message</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</section>
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>