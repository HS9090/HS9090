<?php

@include 'config.php';

if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['p_name'];
    $product_price = $_POST['p_price'];
    $product_image = $_POST['p_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE p_name = '$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'product already added to cart';
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(p_name, p_price, p_image, quantity)
       VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'product added to cart succesfully';
    }
}

?>

<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>product</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
      <link rel="stylesheet" type="text/css" href="css/a.css" />
      <!-- font awesome style -->
      <link href="css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="css/style.css" rel="stylesheet" />
      <link rel="stylesheet" href="css/pro.css" />
      <!-- responsive style -->
      <link href="css/responsive.css" rel="stylesheet" />
      
   </head>
   <body>

           
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>
      <div class="hero_area">
         
         
         <!-- header section strats -->
         <header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="index.html"><img width="250" src="images/logo.png" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                       
                        <li class="nav-item">
                           <a class="nav-link" href="product.php">Products</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <form class="form-inline">
                            <li class="nav-item dropdown">
                               <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="#myModal" aria-expanded="false"><i class="fa fa-shopping-cart"></i>
                                  <span>Cart</span></a>
                                  <ul class="dropdown-menu">
                                     <div class="badge qty">Your Cart empty !!</div>
                                
                                  </ul>
                               </li>
                            </form>
                        </form>
                              </li>
                        <form class="form-inline">
                           <li class="nav-item dropdown">
                           <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="#myModal"><i class="fa fa-user-o"></i> My Account</a>
                           <ul class="dropdown-menu">
                              <li><a href="login.php">Login</a></li>
                              <li><a href="signup.php">Signup</a></li>
                        </li>
                        </form>
                           
                        </ul>
                  </div>
               </nav>
            </div>
         </header>
  
         <!-- end header section -->
         <!-- product show section -->
         <?php

$select_products = mysqli_query($conn, "SELECT * FROM `products`");
if (mysqli_num_rows($select_products) > 0) {
  while ($fetch_product = mysqli_fetch_assoc($select_products)) {
         ?>
         <div class="container">
             <form action="" method="POST" >
                 <input type="hidden" name="p_image" value="<?php echo $fetch_product['p_image']; ?>">
                 <input type="hidden" name="p_name" value="<?php echo $fetch_product['p_name']; ?>">
                 <input type="hidden" name="description" value="<?php echo $fetch_product['description']; ?>">
                 <input type="hidden" name="p_price" value="<?php echo $fetch_product['p_price']; ?>">
             
            <div class="card">
                <div class="container-fliud">
                    <div class="wrapper row">
                        <div class="preview col-md-6">
                            
                            <div class="preview-pic tab-content">
                              <div class="tab-pane active" id="pic-1"><img src=uploaded_img/<?= $fetch_product['p_image']; ?> alt=""></div>
                             
                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                              
                            </ul>
                        </div>
                        <div class="details col-md-6">
                            <h3 class="product-title"><?= $fetch_product['p_name']; ?></h3>
                            
                            <p class="product-description"><?= $fetch_product['description']; ?></p>
                            <h4 class="price">current price: <span><?= $fetch_product['p_price']; ?> OM</span></h4>
                            
                            <div class="action">
                                <input class="add-to-cart btn btn-default" name="add_to_cart" value ="add to cart" type="submit"></input>
                                
                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             </form>
        </div>
        <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>
      <!-- end product show section -->
      <!-- footer start -->
      <footer>
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                   <div class="full">
                      <div class="logo_footer">
                        <a href="#"><img width="210" src="images/logo.png" alt="#" /></a>
                      </div>
                      <div class="information_f">
                        <p><strong>ADDRESS:</strong> Sultanate of Oman, Muscat</p>
                        <p><strong>TELEPHONE:</strong> +968 96969544</p>
                        <p><strong>EMAIL:</strong> Hussainzado@gmail.com</p>
                      </div>
                   </div>
               </div>
               <div class="col-md-8">
                  <div class="row">
                  <div class="col-md-7">
                     <div class="row">
                        <div class="col-md-6">
                     <div class="widget_menu">
                        <h3>Menu</h3>
                        <ul>
                           <li><a href="index.php">Home</a></li>
                           <li><a href="product.php">Products</a></li>
                           <li><a href="contact.php">Contact</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="widget_menu">
                        <h3>Account</h3>
                        <ul>
                           <li><a href="login.php">Login</a></li>
                           <li><a href="signup.php">signup</a></li>
                        </ul>
                     </div>
                  </div>
                     </div>
                  </div>     
                  <div class="col-md-5">
                     <div class="widget_menu">
                        <h3>Newsletter</h3>
                        <div class="information_f">
                          <p>Subscribe by our newsletter and get update protidin.</p>
                        </div>
                        <div class="form_sub">
                           <form>
                              <fieldset>
                                 <div class="field">
                                    <input type="email" placeholder="Enter Your Mail" name="email" />
                                    <input type="submit" value="Subscribe" />
                                 </div>
                              </fieldset>
                           </form>
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- footer end -->
      <div class="cpy_">
         <p>© 2022 All Rights Reserved By <a href="#">Hussain Al-zadjali</a></p>
      </div>
      <!-- jQery -->
      <script src="js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>