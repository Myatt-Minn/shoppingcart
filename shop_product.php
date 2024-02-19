<?php include 'connect.php';
if(isset($_POST['addtoCart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_img = $_POST['product_img'];
    $product_qty = 1;

    $select_smth = mysqli_query($con,"select * from `cart` where name='$product_name'");
    if(mysqli_num_rows($select_smth)>0){
        $display_msg[] = "Product already exist in cart";
    }else{
        $insert_products = mysqli_query($con,"insert into `cart` (name,price,img,quantity) values ('$product_name','$product_price','$product_img','$product_qty')");
        $display_msg[] =  "Product added to the cart";
    }

    //inserting cart data into cart table
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Products</title>
    <link rel="stylesheet" href="./css/blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include('header.php') ?>

 

    <div class="container">
    <?php 
   
   if(isset($display_msg)){
       foreach($display_msg as $dp){
       echo "   <div class='display_message'>
       <span>$dp</span>
       <i class='fas fa-times' onclick='this.parentElement.style.display=`none`'></i>
   </div>";
   }
}
?>
        <section class="products">
            <h1 class="heading"> Lets Shop </h1>
            <div class="product_container">
                <?php
$select_qry=mysqli_query($con,"select * from `producttable`");
if(mysqli_num_rows($select_qry)>0){
  while(  $row = mysqli_fetch_assoc($select_qry)){
    ?>
     <form action="" method="post">
                <div class="edit_form">
                    <img src="images/<?php echo $row['product_img'] ?>" alt="">
                    <h3><?php echo $row['product_name'] ?></h3>
                    <div class="price">Price $<?php echo $row['product_price'] ?></div>
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name'] ?>">
                    <input type="hidden"  name="product_price" value="<?php echo $row['product_price'] ?>">
                    <input type="hidden"  name="product_img" value="<?php echo $row['product_img'] ?>">
                    <input type="submit" class="submit_btn cart_btn" value="Add to Cart" name="addtoCart">
                </div>
                </form>

<?php

  }
}else{
    echo "<div class='empty_text'>No Products Available</div>";
}
                ?>
           
            </div>
        </section>
    </div>
</body>
</html>