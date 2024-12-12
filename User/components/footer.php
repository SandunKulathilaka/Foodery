<style>
  #footer {
    background-color: #222;
    color: #fff;
    padding: 40px 0;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.col-md-3 {
    flex: 1;
    max-width: 25%;
    box-sizing: border-box;
    padding: 15px;
}

.logo-footer {
    width: 150px;
    margin-bottom: 20px;
}

.footer-about {
    font-size: 14px;
    line-height: 1.6;
}

.useful-link, .social-links, .address {
    margin-bottom: 20px;
}

h2 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #fff;
}

.img-fluid {
    width: 50px;
    margin-bottom: 10px;
}

.use-links ul, .social-icons ul, .address-links ul {
    list-style: none;
    padding: 0;
}

.use-links li, .social-icons li, .address-links li {
    margin-bottom: 10px;
}

.use-links a, .social-icons a, .address-links a {
    text-decoration: none;
    color: #fff;
    font-size: 14px;
}

.use-links a:hover, .social-icons a:hover, .address-links a:hover {
    color: #4CAF50;
}

.use-links i, .social-icons i, .address-links i {
    margin-right: 10px;
}

.address1 {
    display: flex;
    align-items: center;
}

@media (max-width: 768px) {
    .col-md-3 {
        max-width: 50%;
    }
}

@media (max-width: 576px) {
    .col-md-3 {
        max-width: 100%;
    }
}
</style>

<footer id="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <a href="index.html"><img src="images/logo-removebg.png" alt="" class="img-fluid logo-footer"></a>
                      <div class="footer-about">
                          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,  </p>
                      </div>

          </div>
          <div class="col-md-3">
            <div class="useful-link">
              <h2>Useful Links</h2>
              <img src="./assets/images/about/home_line.png" alt="" class="img-fluid">
              <div class="use-links">
                <li><a href="index.php"><i class="fa-solid fa-angles-right"></i> Home</a></li>
                <li><a href="about.php"><i class="fa-solid fa-angles-right"></i> About Us</a></li>
                <li><a href="../admin/dashboard.php"><i class="fa-solid fa-angles-right"></i> Admin Dashboard</a></li>
                <li><a href="contact.php"><i class="fa-solid fa-angles-right"></i> Contact</a></li>
              </div>
            </div>

          </div>
                    <div class="col-md-3">
                        <div class="social-links">
              <h2>Follow Us</h2>
              <img src="./assets/images/about/home_line.png" alt="">
              <div class="social-icons">
                <li><a href=""><i class="fa-brands fa-facebook-f"></i> Facebook</a></li>
                <li><a href=""><i class="fa-brands fa-instagram"></i> Instagram</a></li>
                <li><a href=""><i class="fa-brands fa-linkedin-in"></i> Linkedin</a></li>
              </div>
            </div>
                    

                    </div>
          <div class="col-md-3">
            <div class="address">
              <h2>Address</h2>
              <img src="" alt="" class="img-fluid">
              <div class="address-links">
                <li class="address1"><i class="fa-solid fa-location-dot"></i> Colombo Sri Lanka</li>
                   <li><a href=""><i class="fa-solid fa-phone"></i> +94 772152084</a></li>
                   <li><a href=""><i class="fa-solid fa-envelope"></i> mail@1234567.com</a></li>
              </div>
            </div>
          </div>
                  
        </div>
      </div>

    </footer>