<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link rel="stylesheet" href="./css/blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include('header.php') ?>
    <div class="container">
        <section class="display_product">
            
                    <?php
                    $retrieve_data = mysqli_query($con, 'select * from `producttable`;');
                    $num = 1;
                    if (mysqli_num_rows($retrieve_data) > 0) {
                        echo " <table>
                        <thead>
                            <th>Sl No</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Action</th>
                        </thead>
                        <tbody>";
                        while ($row = mysqli_fetch_assoc($retrieve_data)) {
                    ?>
                   
                            <tr>
                                <td><?php echo $num ?></td>
                                <td><img src="images/<?php echo $row['product_img'] ?>" alt="<?php echo $row['product_name']?>"></td>
                                <td><?php echo $row['product_name']?></td>
                                <td>$<?php echo $row['product_price'] ?></td>
                                <td>
                                    <a href="delete.php?delete=<?php echo $row['id'] ?>" class="delete_product_btn" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash"></i></a>
                                    <a href="update.php?update=<?php echo $row['id'] ?>" class="update_product_btn" onclick="return confirm('Are you sure you want to update?')"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>

                    <?php
                    $num++;
                        }
                    } else {
                        echo "<div class='empty_text'>No Products Available</div>";
                    }
                    ?>

                </tbody>
            </table>

        </section>
    </div>
</body>

</html>