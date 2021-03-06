<!-- PHP start -->
<?php
    session_start();
    $database_name = "MBeauty";
    $con = mysqli_connect("localhost","root","",$database_name);

    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="rzesy.php"</script>';
            }else{
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="rzesy.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product has been Removed...!")</script>';
                    echo '<script>window.location="rzesy.php"</script>';
                }
            }
        }
    }
?>
<!-- PHP end -->

<!doctype html>
<html lang="en">
  <head>
    <title>Kosmetyczne</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/lakiery.css">
    <link rel="stylesheet" href="css/shopping-cart.css">
    <!-- Custom Lakier CSS -->
    <link rel="stylesheet" href="css/lakier-1.css">
    <!-- Link HTML -->
    <link rel="stylesheet" href="index.php">
    <link rel="stylesheet" href="lakiery.php">
    <link rel="stylesheet" href="rzesy.php">
    <link rel="stylesheet" href="shopping-cart.php">
    <!-- Link HTML lakier -->
    <link rel="stylesheet" href="lakier-1.php">
    <link rel="stylesheet" href="rzesy-1.php">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    <!-- Navbar start -->
    <nav class="navbar navbar-expand-lg navbar-light  py-3 fixed-top">
      <div class="container">
        <img src="img/MBeauty-2-1.png" alt="">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="lakiery.php">Lakiery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="rzesy.php">Rz??sy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">O nas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Kontakt</a>
            </li>
            <li class="nav-item">
              <a href="shopping-cart.php"><i class="fas fa-shopping-bag"></i></a>
              <span id="counter">0</span>
            </li>
        </div>
      </div>
    </nav>
    <!-- Navbar end -->

    <!-- Featured section start -->
    <section id="featured" class="my-5 py-5">
        <div class="container mt-5 py-5">
          <h2 class="font-weight-bold">Rz??sy</h2>
          <hr>
          
        </div>
        <?php
            $query = "SELECT * FROM rzesy ORDER BY id ASC ";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    ?>
        <div class="row mx-auto container">
          <div class="product text-center col-lg-3 col-md-4 col-12">
          <img onclick="window.location.href='rzesy-1.php';" src="<?php echo $row['image']; ?>" class="img-fluid mb-3">
            <h5 class="p-name"><?php echo $row["tytul"]; ?></h5>
            <h4 class="p-price"><?php echo $row["cena"]; ?> z??</h4>
            <button class="btn buy-btn">Buy Now</button>
          </div>          
          
        </div>
        
        <?php
                }
            }
        ?>
    </section>
    <!-- Featured section end -->

    <!-- Footer section start -->
    <footer class="mt-5 py-5">
      <div class="row container mx-auto pt-5">
        <div class="footer-one col-lg-3 col-md-6 col-12">
          <img src="img/MBeauty-2-1.png" alt="">
          <p class="pt-3">Fringilla urna porttitor rhoncus dolor purus luctus venenatis lectus magna fringilla diam maecenas ultricies mi eget mauris.</p>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
          <h5 class="pb-2">Featured</h5>
          <ul class="text-uppercase list-unstyled">
            <li><a href="#">men</a></li>
            <li><a href="#">women</a></li>
            <li><a href="#">boys</a></li>
            <li><a href="#">girls</a></li>
            <li><a href="#">new arrivals</a></li>
            <li><a href="#">shoes</a></li>
            <li><a href="#">cloths</a></li>
          </ul>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
          <h5 class="pb-2">Contact Us</h5>
          <div>
            <h6 class="text-uppercase">Address</h6>
            <p>123 STREET NAME, CITY, US</p>
          </div>
          <div>
            <h6 class="text-uppercase">Phone</h6>
            <p>(123) 456-7890</p>
          </div>
          <div>
            <h6 class="text-uppercase">Email</h6>
            <p>MAIL@EXAMPLE.COM</p>
          </div>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-12">
          <h5 class="pb-2">Instagram</h5>
          <div class="row">
            <img class="img-fluid w-25 h-100 m-2" src="img/insta/1.jpg" alt="">
            <img class="img-fluid w-25 h-100 m-2" src="img/insta/2.jpg" alt="">
            <img class="img-fluid w-25 h-100 m-2" src="img/insta/3.jpg" alt="">
            <img class="img-fluid w-25 h-100 m-2" src="img/insta/4.jpg" alt="">
            <img class="img-fluid w-25 h-100 m-2" src="img/insta/5.jpg" alt="">
          </div>
        </div>
      </div>

      <div class="copyright mt-5">
        <div class="row container mx-auto">
          <div class="col-lg-3 col-md-6 col-12 mb-4">
            <img src="img/payment.png" alt="">
          </div>
          <div class="col-lg-4 col-md-6 col-12 text-nowrap mb-2">
            <p>rymo eCommerce &copy; 2021. All Rights Reserved</p>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer section end -->

    <!-- Optional JavaScript -->
    <script src="js/main.js"></script>
    <script src="js/btn-carts.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>