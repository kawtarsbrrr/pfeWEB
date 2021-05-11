<?php
  // connect to database
  include 'includes/database.php';

  // include objects
  include_once "cart.php";
  include_once "includes/database.php";
  

 

  // initialize objects


  // set page title
  $page_title="Checkout";

  

  // $cart_count variable is initialized in navigation.php
  if($cart_count>0){

      $cart_item->user_id=1;
      $stmt=$cart_item->read();

      $total=0;
      $item_count=0;

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);

          $total= $total + ($product['quantity']* $product['price']);

          echo "<div class='cart-row'>";
              echo "<div class='col-md-8'>";

                  echo "<div class='product-name m-b-10px'><h4>{$name}</h4></div>";
                  echo $product['quantity']>1 ? "<div>{$product['quantity']} items</div>" : "<div>{$product['quantity']} item</div>";

              echo "</div>";

              echo "<div class='col-md-4'>";
                  echo "<h4>&#36;" . number_format($product['price'], 2, '.', ',') . "</h4>";
              echo "</div>";
          echo "</div>";

          $item_count += $quantity;
          $ttotal+=$total;
      }

      echo "<div class='col-md-12 text-align-center'>";
          echo "<div class='cart-row'>";
              if($item_count>1){
                  echo "<h4 class='m-b-10px'>Total ({$item_count} items)</h4>";
              }else{
                  echo "<h4 class='m-b-10px'>Total ({$item_count} item)</h4>";
              }
              echo "<h4>&#36;" . number_format($ttotal, 2, '.', ',') . "</h4>";

              echo "<a href='place_order.php' class='btn btn-lg btn-success m-b-10px'>";
                  echo "<span class='glyphicon glyphicon-shopping-cart'></span> Place Order";
              echo "</a>";
          echo "</div>";
      echo "</div>";

  }else{
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-danger'>";
            echo "No products found in your cart!";
        echo "</div>";
    echo "</div>";
  }