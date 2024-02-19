<?php include 'connect.php'; 

if(isset($_GET['delete'])){
    $pid = $_GET['delete'];
    $delete_query = mysqli_query($con,"delete from `producttable` where id=$pid") or die("Query failed");
    if($delete_query){
        header('location:view_product.php');
    }else{
        echo "Product not deleted";
        header('location:view_product.php');
    }
}
?>

