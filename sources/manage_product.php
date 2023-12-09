<?php
    session_start();
    $admin_ses = $_SESSION['sadmin'];
    if(!isset($admin_ses)){
        header('location:login.php');
    };
    include "include/connect.php";
    #$conn = mysqli_connect("localhost", "nbp1", "passMySQL", "fruit_shop");

    include "include/check.php";


    if(isset($_GET['remove'])){
        $remove_id = $_GET['remove'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE id_item = '$remove_id'") or die('query failed');
        mysqli_query($conn, "DELETE FROM `fruits_table` WHERE id = '$remove_id'") or die('query failed');
        header('location:manage_product.php');
    }
    if (isset($_POST['add'])) {
        $product_name = test_input($conn, $_POST["name"]);
        $product_price = test_input($conn, $_POST["price"]);
        $file_img = test_input($conn, $_FILES["add_image"]["name"]);
        //chuyen ảnh vào folder img
        $folder = "./img/" . $file_img;
        if($_FILES['add_image']['name']!=""){
            check_upload_image('add_image');
            if (move_uploaded_file($_FILES['add_image']['tmp_name'], $folder)){
               mysqli_query($conn, "INSERT INTO fruits_table (name, price, image) VALUES ('$product_name', '$product_price', '$file_img' )");
               echo '<script>
                alert("Success!");
                window.location.href="manage_product.php";
                </script>';;
            }else{
                echo '<script> 
                alert("Failed!");
                window.location.href="manage_product.php";
                </script>';
            }
         }       
    }
?>
<?php include 'include/header.php'; ?>
<body>
<?php include 'include/navbar_admin.php'; ?>


</body>
</html>
