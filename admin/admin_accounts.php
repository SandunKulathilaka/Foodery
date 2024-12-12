<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admins Accounts</title>
   <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">

   <!-- font awesome cdn link  -->
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
           body{
   background-color:black;
}
.accounts h1{
   margin:30px
}
    /* Table Styles */
    .accounts {
   width: 70%;
   margin: auto;
}

.heading {
   text-align: center;
   margin-bottom: 20px;
}

.account-list {
   display: flex;
   flex-direction: column;
   gap: 20px;
}

.account-item {
   display: flex;
   justify-content: space-between;
   align-items: center;
   background: #333;
   color:white;
   border: 1px solid #ddd;
   border-radius: 10px;
   padding: 20px;
   box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.account-details p {
   margin: 5px 0;
   font-size:15px;
}

.account-actions {
   display: flex;
   flex-direction: column;
   gap: 10px;
}

.action-btn {
   text-decoration: none;
   padding: 5px 10px;
   border-radius: 5px;
   color: #fff;
   text-align: center;
}

.delete-btn {
   background-color: #d9534f;
}

.update-btn {
   background-color: #5cb85c;
}

.empty {
   text-align: center;
   font-size: 18px;
   color: #888;
}
</style>
</head>
<body style="background-size: cover; background-position: center; background-repeat: no-repeat;">

<?php include '../components/admin_header.php' ?>

<!-- admins accounts section starts  -->

<section class="accounts">

   <h1 class="heading">Admin Accounts</h1>

   <div class="account-list">
      <?php
         $select_account = $conn->prepare("SELECT * FROM `admin`");
         $select_account->execute();
         if($select_account->rowCount() > 0){
            while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
      ?>
      <div class="account-item">
         <div class="account-details">
            <p><strong>Admin ID:</strong> <?= $fetch_accounts['id']; ?></p>
            <p><strong>Username:</strong> <?= $fetch_accounts['name']; ?></p>
         </div>
         <div class="account-actions">
            <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Delete this account?');">Delete</a>
            <?php
               if($fetch_accounts['id'] == $admin_id){
                  echo '<a href="update_profile.php" class="action-btn update-btn">Update</a>';
               }
            ?>
         </div>
      </div>
      <?php
            }
         } else {
            echo '<p class="empty">No accounts available</p>';
         }
      ?>
   </div>

</section>


<!-- admins accounts section ends -->




















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>