<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <?php include "top_navbar.php";?>   
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include "navbar.php";?>
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->

    <?php 
    if(isset($_POST['add_cart'])){
        if(isset($_SESSION['cart'])){
            $mycartItem = array_column($_SESSION['cart'],'p_id');
            if(in_array($_POST['id'],$mycartItem)){
                echo "<script>
                    alert('Product Already Inserted')
                    location.assign('index.php')
                </script>";
            }else{
                $count =  count($_SESSION['cart']); // 2
                $_SESSION['cart'][$count] = array('p_id' => $_POST['id'],'p_name'=>$_POST['p_name'],'p_price'=>$_POST['p_price'],'p_img'=>$_POST['p_img'],'p_qty'=>$_POST['p_qty']);
                // print_r($_SESSION['cart']);
            }
           
        }else{
            $_SESSION['cart'][0] = array('p_id' => $_POST['id'],'p_name'=>$_POST['p_name'],'p_price'=>$_POST['p_price'],'p_img'=>$_POST['p_img'],'p_qty'=>$_POST['p_qty']);

            // print_r($_SESSION['cart']);
        }
    }

    // Remove Cart
    if(isset($_GET['remove'])){
        
        foreach($_SESSION['cart'] as $key => $value){
                if($value['p_id'] == $_GET['remove']){
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);

                    echo "<script>
                        alert('Product Deleted');
                        location.assign('cart.php');
                    </script>";
                }
        }
    }
    if(isset($_POST['checkout'])){
        include "connection.php";
         $u_id = $_SESSION['u_id'];
        $u_name = $_SESSION['name'];
        
        // Send Mail
        $to = $_SESSION['email'];
        $subject = "Order Successfully Delivered";
        $msg = "Thank You For Your Order MR".$u_name;
        $from = "talibmari123@gmail.com";
        
        mail($to,$subject,$msg,$from);
        
        foreach ($_SESSION['cart'] as $key => $value) {
            mysqli_query($con,"INSERT INTO orders(u_id,u_name,p_id,p_name,p_price,p_qty,p_status)VALUES('$u_id','$u_name','".$value['p_id']."','".$value['p_name']."','".$value['p_price']."','".$value['p_qty']."','Pending')");
        }

        unset($_SESSION['cart']);

        echo "<script>
            alert('Order Added Successfully')
            location.assign('index.php');
        </script>";
    }


?>
<form  method="post">
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php 
                        $subtotal = 0;
                            if(isset($_SESSION['cart'])){
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    ?>
                                    
                                   


                            <tr>
                                <td class="align-middle"><img src="AdminPanel/images/<?php echo $value['p_img'] ?>" alt="" style="width: 50px;"></td>
                                <td class="align-middle"><?php echo $value['p_name'] ?></td>
                                
                                <td class="align-middle"><?php echo $value['p_price'] ?></td>
                                <td class="align-middle"><?php echo $value['p_qty'] ?></td>
                                <td class="align-middle">
                                <?php 
                                $totalPrice = $value['p_price'] * $value['p_qty'];
                                $subtotal += $totalPrice;
                                echo $totalPrice;
                                ?></td>
                            
                                <td class="align-middle"><a href="?remove=<?php echo $value['p_id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
                            </tr>
                                    <?php 
                                }
                            }
                        ?>
                        
                        
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <!-- <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>$150</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div> -->
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?php 
                            echo $subtotal; 
                            ?></h5>
                        </div>
                            <?php 

                                if(isset($_SESSION['name'])){
                                    
                                    ?>
                                    <button type="submit" name="checkout" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                                    <?php 
                                }else{
                                    ?>
                                    <a href="login.php" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                                    <?php 
                                }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <!-- Cart End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                    <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>