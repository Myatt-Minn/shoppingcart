<?php 
include "connect.php";

    if(isset($_POST['add_product'])){
        $pname = $_POST['product_name'];
        $pprice = $_POST['product_price'];
        $pimg = $_FILES['product_img']['name'];
        $pimgTemp = $_FILES['product_img']['tmp_name'];
        $pimgFolder = 'images/'.$pimg;
        $insert_data = mysqli_query($con,"insert into `producttable` (product_name,product_price,product_img) values ('$pname','$pprice','$pimg')") or die("Insert data query failed");
        if($insert_data){
            move_uploaded_file($pimgTemp,$pimgFolder);
          
            $display_msg = "You have successfully added a product";
        }else{
            $display_msg = "Have some error while adding product";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="./css/blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
   
<?php
    include('header.php');
   
?>


    <div class="container">
        <!-- message display -->
        <?php 
            if(isset($display_msg)){
                echo "     <div class='display_message'>
                <span>$display_msg</span>
                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`'></i>
            </div>";
            }
        ?>
   
        <section>
            <h3 class="heading">Add Product</h3>
            <form action="" class="add_product" method="post" enctype="multipart/form-data">
                <input type="text" name="product_name" placeholder="Enter your product name" class="input_fields" required >
                <input type="number" name="product_price" placeholder="Enter your product price" class="input_fields" required >
                <input type="file" name="product_img" class="input_fields" required accept="image/png, image/jpg, image/jpeg">
                <input type="checkbox" name="rememberMe" id="rememberMe"> <label for="rememberMe">Remember me</label>
                <input type="submit" name="add_product" class="submit_btn" value="Add Product">
            </form>
        </section>
    </div>
    <script src="js/main.js"></script>
</body>
</html>