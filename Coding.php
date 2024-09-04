<?php 
if(isset($_GET['Delete_id'])){
    include "connection.php";
    $Delete_id = $_GET['Delete_id'];
    mysqli_query($con,"DELETE FROM user WHERE ID='$Delete_id'");

    echo "Data Deleted Successfully";
}


if(isset($_POST['register'])){
    include "connection.php";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $retypePassword = $_POST['retypePassword'];
    $role = 2;

    $FetchEmail = mysqli_query($con,"SELECT * FROM register WHERE email = '$email'");
    if($IsEmailExist = mysqli_num_rows($FetchEmail) > 0){
            echo "<script>
            alert('Email Already Exists');
            location.assign('register.php')
    </script>";
    }else{
        if($password == $retypePassword){
        
            $insert  = mysqli_query($con,"INSERT INTO register (name,email,password,role)VALUES('$name','$email','$password','$role')");
    
             echo "<script>
                    alert('Account Created Successfully');
                    location.assign('register.php')
            </script>";
    
        }else{
            echo "<script>
                    alert('Password And RetypePassword Must Match');
                    location.assign('register.php')
            </script>";
        }
    }

    
}


if(isset($_POST['login'])){
    include "connection.php";
    $email = $_POST['email'];
    $password = $_POST['password'];

    $FetchData = mysqli_query($con,"SELECT * FROM register WHERE email = '$email' AND password = '$password'");

    if($isDataExist = mysqli_num_rows($FetchData) > 0){
        
        while($data = mysqli_fetch_assoc($FetchData)){
            if($data['role'] == 1){
                session_start();

                $_SESSION['name'] = $data['name'];

                // header('location:AdminPanel\index.php');
                echo "<script>
                    location.assign('AdminPanel/validatePage.php?index');
                </script>";

            }else{
                session_start();
                $_SESSION['u_id'] = $data['id'];
                $_SESSION['name'] = $data['name'];
                $_SESSION['email'] = $data['email'];

                 header('location:index.php');
            }
        }
    }else{
        echo "<script>
                alert('Email Or Password Not Correct');
                location.assign('index.php')
        </script>";
    }
}
// Add Category Backed 
if(isset($_POST['add_category'])){
    include "connection.php";
    $c_img = $_FILES['c_img']['name'];
    $c_size = $_FILES['c_img']['size'];
    $tmp_name = $_FILES['c_img']['tmp_name'];


    $c_extestion = pathinfo($c_img,PATHINFO_EXTENSION);
    $destination = "AdminPanel/images/".$c_img;

    if($c_size <= 5000000){
        if($c_extestion == "jpg" OR $c_extestion == "png"){
            //
            if(move_uploaded_file($tmp_name,$destination)){
                $c_name = $_POST['category'];
                $insert = mysqli_query($con,"INSERT INTO category(c_name,c_img)VALUES('$c_name','$c_img')");

                echo "<script>
                alert('Category Uploaded Successfully');
                location.assign('AdminPanel/validatePage.php?category')
            </script>";
            }else{
                echo "<script>
                alert('File Not Uploaded');
                location.assign('AdminPanel/validatePage.php?category')
            </script>";
            }
            
        }else{
            echo "<script>
            alert('File Must Be JPG OR PNG');
            location.assign('AdminPanel/validatePage.php?category')
         </script>";
        }
    }else{
        echo "<script>
                alert('File Must Be Less Then 5 MB');
                location.assign('AdminPanel/validatePage.php?category')
        </script>";
    }

}

// Add Product Code

if(isset($_POST['add_product'])){
    include "connection.php";
    $p_img = $_FILES['p_img']['name'];
    $p_size = $_FILES['p_img']['size'];
    $tmp_name = $_FILES['p_img']['tmp_name'];

    $p_extestion = pathinfo($p_img,PATHINFO_EXTENSION);
    $destination = "AdminPanel/images/".$p_img;

    if($p_size <= 5000000){
        if($p_extestion == "jpg" OR $p_extestion == "jpeg" OR $p_extestion == "png"){
            //
            if(move_uploaded_file($tmp_name,$destination)){
                $p_name = $_POST['p_name'];
                $p_qty = $_POST['p_qty'];
                $p_price = $_POST['p_price'];
                $p_desc = $_POST['p_desc'];
                $p_category = $_POST['p_category'];
                

                $insertProduct = mysqli_query($con,"INSERT INTO product(p_name,p_qty,p_price,p_desc,p_category,p_img)VALUES('$p_name','$p_qty','$p_price','$p_desc','$p_category','$p_img')");
                
               
                echo "<script>
                alert('Product Added Successfully');
                location.assign('AdminPanel/validatePage.php?product')
            </script>";
            }else{
                echo "<script>
                alert('File Not Uploaded');
                location.assign('AdminPanel/validatePage.php?product')
            </script>";
            }
            
        }else{
            echo "<script>
            alert('File Must Be JPG OR PNG');
            location.assign('AdminPanel/validatePage.php?product')
         </script>";
        }
    }else{
        echo "<script>
                alert('File Must Be Less Then 5 MB');
                location.assign('AdminPanel/validatePage.php?product')
        </script>";
    }
}

// Ajax Code

if(isset($_POST['email'])){
    include "connection.php";
    $email = $_POST['email'];

    $fetch = mysqli_query($con,"SELECT * FROM register WHERE email = '$email'");

    if($isDataExist = mysqli_num_rows($fetch) > 0){
        echo "<div class='alert alert-danger d-block' role='alert'>
        Email Already Exists
        </div>";
    }
}
?>