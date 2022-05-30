<?php

include 'config.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

$errors = array();

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('#[0-9]#', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {

        array_push($errors, "Password should be at least 8 characters in
    length and should include at least one upper case letter, one number, and one special character.");
    } else {
        if ($password != $password2) {
            $message[] = 'confirm password not matched!';
        } else {

            $user_check_query = "SELECT * FROM users WHERE  email='$email'";
            $result = mysqli_query($conn, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            if ($user) {

                if ($user['email'] === $email) {
                    array_push($errors, "email already exists");
                }
            } else {
                $insert_user = mysqli_query($conn, "INSERT INTO `users`(name, email, password)
         VALUES('$name', '$email', '$password')");

                $message[] = 'registered successfully, login now please!';
            }
        }
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
    <title>signup</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/a.css" />
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
        }
    }
    ?>

    <?php if (count($errors) > 0) : ?>
        <div class="error">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>

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
        <!-- Signup section -->
        <section class="why_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>
                        Please <span>Signup</span>
                    </h2>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="full">
                            <form action="" method="POST">
                                <fieldset>
                                    <input type="text" placeholder="Enter your Username" name="name" required />
                                    <input type="email" placeholder="Enter your email address" name="email" required />
                                    <input type="password" placeholder="Enter your password" name="password" required />
                                    <input type="password" placeholder="Enter your password" name="password2" required />
                                    <input type="submit" name="submit" value="signup" />
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end Signup section -->
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