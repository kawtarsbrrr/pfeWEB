<?php 
include 'includes/header.php';
include 'includes/database.php';
include 'includes/functions.php';

session_start();
$_SESSION;

$data_user= check_login($con);


$product_ids = array();

//session_destroy();

//check if Add to Cart has been submitted 
if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){

        //keep track of how many products are in the shopping cart
        $count= count($_SESSION['shopping_cart']);

        //create sequantial array for matching keys to products ids
        $product_ids= array_column($_SESSION['shopping_cart'], 'id');

        if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids)) {
            $_SESSION['shopping_cart'][$count]= array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'name' =>filter_input(INPUT_POST, 'name'),
                'price' =>filter_input(INPUT_POST, 'price'),
                'quantity' =>filter_input(INPUT_POST, 'quantity'),
            ); 
        }
        else {//product already exists=add quantity
            //match array key to id of the product being added to the cart
            for ($i=0; $i< count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                   //add item quantity to the existing product in the array
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }

        }
    }
    else { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted from data, start from 0 and fill it with values
        $_SESSION['shopping_cart'][0]= array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' =>filter_input(INPUT_POST, 'name'),
            'price' =>filter_input(INPUT_POST, 'price'),
            'quantity' =>filter_input(INPUT_POST, 'quantity'),
        );

    }
}

if( filter_input(INPUT_GET, 'action')== 'delete'){
    //loop through all products in the shopping cart array til it matchesq with GET id variable
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if($product['id'] == filter_input(INPUT_GET, 'id')){
        //remove product from the shopping cart when it matches
        unset($_SESSION['shopping_cart'][$key]);
    }
}


//reset session array so they match with $product_ids numeric array
    $_SESSION['shopping_cart']= array_values($_SESSION['shopping_cart']);
}
if( filter_input(INPUT_GET, 'action')== 'clearall'){
   
    unset($_SESSION['shopping_cart']);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" >
    <link rel="stylesheet" href="cart.css">
</head>
<body>
<div id="page-container " class="container">
 
<div style="clear: both;"></div>
<br />
<div >
    <table class="table table-bordered table-striped">
        <tr><th colspan="5"><h3>Order Details</h3></th></tr>
        <tr>
        
            <th width="40%">Product Name</th>
            <th width="10%">Quantity</th>
            <th width="20%">Price</th>
            <th width="15%">Total</th>
            <th width="5%">Action</th>
        </tr>
        <?php
        if(!empty($_SESSION['shopping_cart'])):
            $total=0;

            foreach ($_SESSION['shopping_cart'] as $key => $product):
        ?>
        <tr>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['quantity']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo number_format($product['quantity']* $product['price'], 2); ?></td>
        <td>
            <a href="cart.php?action=delete&id=<?php echo $product['id'];?>">
                <button class="btn btn-danger btn-block" >Remove</button>
            </a>
        </td>
        </tr>
        <?php 
                $total= $total + ($product['quantity']* $product['price']);
            endforeach;
        ?>

        <tr>

            <td colspan="3" align="right"> Total</td>
            <td align="right"><?php echo number_format($total,2); ?></td>
            <td>
                <a href="cart.php?action=clearall">
                    <button class="btn btn-warning btn-block">Clear All</button>
                </a>
            </td>
            
        </tr>

        <tr>
          <!-- Show checkout button only if the shopping cart is not empty-->
          <td colspan="5">
            <?php
            if (isset($_SESSION['shopping_cart'])):
                if(count($_SESSION['shopping_cart']) >0):
            ?>
            <a href="checkout.php" class="button">Checkout</a>
            <?php endif; endif;?>
          </td>  
        </tr>
        <?php
        endif;
        ?>
    </table>

</div>
</div>

</body>
</html>
<?php 
include 'includes/footer.php'; ?> 