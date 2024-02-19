<?php include 'connect.php';
if(isset($_POST['update_product'])){
    $proid = $_POST['update_product_id'];
    $proname = $_POST['update_product_name'];
    $proprice = $_POST['update_product_price'];
    $proimg = $_FILES['update_product_img']['name'];
    $proimg_temp = $_FILES['update_product_img']['tmp_name'];
    $proimg_folder = 'images/'.$proimg;
    $update_query = mysqli_query($con,"update `producttable` set product_name='$proname',product_price='$proprice',product_img='$proimg' where id=$proid");
    if($update_query){
        move_uploaded_file($proimg_temp,$proimg_folder);
        header('location: view_product.php');
    }else{
        $display_msg= "Something went wrong, cannot be updated";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Products</title>
    <link rel="stylesheet" href="./css/blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include('header.php'); ?>
    <?php 
            if(isset($display_msg)){
                echo "     <div class='display_message'>
                <span>$display_msg</span>
                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`'></i>
            </div>";
            }
        ?>
    <section class="edit_container">
        <?php

        if (isset($_GET['update'])) {
            $id = $_GET['update'];

            $select_query = mysqli_query($con, "Select * from `producttable` where id=$id");

            if (mysqli_num_rows($select_query) > 0) {
                $roww = mysqli_fetch_assoc($select_query);
        ?>
                <form action="" method="post" enctype="multipart/form-data" class="update_product product_container_box">
                    <img src="images/<?php echo $roww['product_img'] ?>" alt="">
                    <input type="hidden" value="<?php echo $roww['id'] ?>" name="update_product_id">
                    <input type="text" class="input_fields fields" required value="<?php echo $roww['product_name'] ?>" name="update_product_name">
                    <input type="number" class="input_fields fields" required value="<?php echo $roww['product_price'] ?>" name="update_product_price">
                    <input type="file" class="input_fields fields" required accept="image/png, image/jpg, image/jpeg" name="update_product_img">
                    <div class="btns">
                        <input type="submit" class="edit_btn" value="Update Product" name="update_product">
                        <input type="reset" id="close-edit" value="Cancel" class="cancel_btn">
                    </div>
                </form>
        <?php

            } else {
            }
        }
        ?>

    </section>
</body>

</html>