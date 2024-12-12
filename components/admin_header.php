<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<style>
    /* Message Styles */
    .message {
        background-color: #f1c40f; /* Yellow background */
        color: #333;
        padding: 10px 20px;
        margin-bottom: 10px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .message span {
        margin-right: 10px;
    }
    /* Header Styles */
    .header {
        background: linear-gradient(to right, #3498db, #2ecc71); /* Gradient background */
        padding: 10px 30px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Box shadow */
        display: flex;
        align-items: center;
    }
    /* Flex Container Styles */
    .flex {
        display: flex;
        align-items: center;
    }
    .flex img{
        margin-right: 30px;
    }
    /* Logo Styles */
    .logo {
        color: white;
        text-decoration: none;
        font-size: 1.5em;
        font-weight: bold;
        margin-right: 20px;
    }
    .logo span {
        color: #f1c40f; /* Yellow color for "Panel" */
    }
    /* Navbar Styles */
    .navbar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100%;
        background: #333;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        width:15%
    }
    .navbar a {
        color: white;
        text-decoration: none;
        margin-bottom: 10px;
        display: block;
        padding: 10px 0;
        font-size: large;
    }
    .navbar a:hover {
        text-decoration: underline;
    }

    .navbar .profile h2{
        color:Yellow;
        text-align:center;
        font-size:20px
    }

    .navbar .profile img{
        margin:80px 20px 0px 70px;
        
    }

    .navbar .profile{
       
       


    }

    .option-btn,
    .delete-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        text-align:center;
    }
    .option-btn {
        background-color: #4caf50;
        color: white;
    }
    .option-btn:hover {
        background-color: #45a049;
    }
    .delete-btn {
        background-color: #f44336;
        color: white;
    }
    .delete-btn:hover {
        background-color: #da190b;
    }

</style>
</head>
<body>

<!-- Left-side navbar -->

<nav class="navbar">
<img src="images/Foodery.png" width="100" height="100" alt="Logo">
<a href="dashboard.php" class="logo">Admin<span>Panel</span></a><br>
    <a href="dashboard.php">Home</a>
    <a href="products.php">Products</a>
    <a href="placed_orders.php">Orders</a>
    <a href="admin_accounts.php">Admins</a>
    <a href="users_accounts.php">Users</a>
    <a href="messages.php">Messages</a>

<br>

      <div class="profile" id="profile-section">
      <img src="images/user-icon.png" width="100" height="100" alt="Logo">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><h2><?= $fetch_profile['name']; ?></h2></p>
         <br>
         <div class="flex-btn">
         <a href="update_profile.php" class="option-btn">Update Profile</a>
            <a href="register_admin.php" class="option-btn">Register</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">Logout</a>
      </div>
   </div>
</header>

<script>
   // Toggle profile section visibility on clicking user icon
   document.getElementById('user-btn').addEventListener('click', function() {
      var profileSection = document.getElementById('profile-section');
      profileSection.style.display = profileSection.style.display === 'none' ? 'block' : 'none';
   });
</script>
</nav>
</body>
</html>
