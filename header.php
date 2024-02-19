<header class="header">
        <div class="header_body">
        <a href="index.php" class="logo">MyatMinCentre</a>
        <nav class="navbar">
            <a href="index.php">Add Product</a>
            <a href="view_product.php">View Products</a>
            <a href="shop_product.php">Shopit</a>
        </nav>
        <?php
$select_num = mysqli_query($con,"select * from `cart`");
$numofItems = mysqli_num_rows($select_num);

        ?>
        <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sup><?php echo $numofItems?></sup></span></a>
        <!-- <div id="menu-btn" class="fas fa-bars"></div> -->
        </div>

    </header>