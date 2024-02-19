<?php include 'connect.php';

if (isset($_POST['update_qty_submit'])) {
    $updateid = $_POST['update_id'];
    $updateqty = $_POST['update_qty'];

    $updatequery = mysqli_query($con, "update `cart` set quantity=$updateqty where id=$updateid");
    if ($updatequery) {
        header("Location:cart.php");
    } else {
        echo "Error";
    }
}

if (isset($_GET['remove'])) {
    $removedid = $_GET['remove'];
    $removeeqry = mysqli_query($con, "delete from `cart` where id=$removedid");
    if ($removeeqry) {
        header("Location:cart.php");
    } else {
        echo "Error";
    }
}
if(isset($_GET['delete_all'])){
    $deleteAll = mysqli_query($con,"Delete from `cart`");
    if($deleteAll){
        header("Location:cart.php");}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="./css/blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <section class="shopping_cart">
            <h1 class="heading">My Cart</h1>
            <table>
                <?php
                $select_queryy = mysqli_query($con, "select * from `cart`");
                $numm = 1;
                $grandtotal = 0;
                if (mysqli_num_rows($select_queryy) > 0) {
                    echo "         <thead>
                    <th>S1 No</th>
                    <th>Product Name</th>
                    <th>Product Img</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>";

                    while ($ggrow = mysqli_fetch_assoc($select_queryy)) {
                ?>

                        <tbody>
                            <tr>
                                <td><?php echo $numm ?></td>
                                <td><?php echo $ggrow['name'] ?></td>
                                <td><img src="images/<?php echo $ggrow['img'] ?>" alt=""></td>
                                <td>$<?php echo $ggrow['price'] ?></td>

                                <td>
                                    <form action="" method="post">
                                        <div class="quantity_box">
                                            <input type="hidden" value="<?php echo $ggrow['id'] ?>" name="update_id">
                                            <input type="number" min="1" value="<?php echo $ggrow['quantity'] ?>" name="update_qty">
                                            <input type="submit" class="update_quantity" value="Update" name="update_qty_submit">
                                        </div>
                                    </form>
                                </td>
                                <td><?php echo $subtotal = number_format($ggrow['price'] * $ggrow['quantity']) ?></td>
                                <td><a href="cart.php?remove=<?php echo $ggrow['id'] ?>" onclick="return confirm('Are you sure u want to remove?')"><i class="fas fa-trash"></i>Remove</a></td>
                            </tr>
                    <?php
                        $grandtotal = $grandtotal + ($ggrow['price'] * $ggrow['quantity']);
                        $numm++;
                    }
                } else {
                    echo "<div class='empty_text'>Cart is empty</div>";
                }
                    ?>


                        </tbody>

            </table>
            <?php
            if ($grandtotal > 0) {
                echo "<div class='table_bottom'>
    <a href='shop_product.php' class='bottom_btn'>Continue Shopping</a>
    <h3 class='bottom_btn'>Grand Total: <span>$<?php echo $grandtotal ?></span></h3>
    <a href='checkout.php' class='bottom_btn'>Proceed to checkout</a>
</div>";
        
            ?>
            <a href="cart.php?delete_all" class="delete_all_btn"><i class="fas fa-trash"></i> Delete All</a>
<?php
                }else{
                echo "";                }
                ?>
        </section>
    </div>
</body>

</html>