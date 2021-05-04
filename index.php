<?php 
include 'includes/header.php';
include 'includes/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping  </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="cart.css">
</head>

<body>
<div class="container">
<?php
$connect = mysqli_connect('localhost', 'root','','pfe');
$query = 'SELECT * FROM products';
$result = mysqli_query($connect,$query);

if ($result):
    if(mysqli_num_rows($result)>0):
        while($product= mysqli_fetch_assoc($result)):
            //print_r($product);
            ?>
            <div class="col-sm-4 col-md-3">
            <form action="cart.php?action=add&id=<?php echo $product['id'];?>" method="post">
                <div class="products">
                <img src="<?php echo $product['image']; ?>" class="img-responsive">
                <h4 class="text-info"><?php echo $product['name']; ?></h4>
                <h4> <?php echo $product['price']; ?>Dhs</h4>
                <input type="text" name="quantity" class="form-control" value="1">
                <input type="hidden" name="name" value="<?php echo $product['name'];?>">
                <input type="hidden" name="price"  value="<?php echo $product['price'];?>">
                <input type="submit" name="add_to_cart" style="margin-top:5px ;" class="btn btn-info" value="Add to Cart">
                </div>
            
            </form>
            </div>
            <?php
        endwhile;
    endif;
endif; 
?>
</div>