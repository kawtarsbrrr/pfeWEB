<?php 
include 'includes/header.php';
include 'includes/database.php';
include 'includes/functions.php';

session_start();


$data_user= check_login($con);

?>

<link rel="stylesheet" href="cart.css">

	
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"method="post">
<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="billing-details">
						
						<h3> <b>Billing Details</b> </h3>
							<div class="row">
								<div class="col-md-6">
									<label>First Name </label>
									<input class="form-control" name="name" placeholder="" value="" type="text"required>
								</div>
                                
								<div class="col-md-6">
									<label>Last Name </label>
									<input class="form-control" name="last"placeholder="" value="" type="text"required>
								</div>
							</div>
                            
                            <br>
                            <div >
                                <label >Address </label>
							<input class="form-control" name="address1"placeholder="" value="" type="text"required>
							
							<input class="form-control" name="address2"placeholder="" value="" type="text">
                            </div>
							
							
                            <br>
							<div class="row">
								<div class="col-md-4">
									<label>Country </label>
									<input class="form-control" name="city"placeholder="" value="" type="text"required>
								</div>
								<div class="col-md-4">
									<label>City</label>
									<input class="form-control" value="" name="" placeholder=" " type="text"required>
								</div>
								<div class="col-md-4">
									<label>Postcode </label>
									<input class="form-control" placeholder="" value="" type="text"required>
								</div>
							</div>
						
                            <br>
							<label>Phone </label>
							<input class="form-control" id="phone" placeholder="" value="" type="text" required>
						
					</div>
				</div>
				
			
			</div>
			
			
            <br>
			<h4> <b>Your order</b> </h4>
			 <table class="table table-bordered extra-padding table-success">
            <?php
        if(!empty($_SESSION['shopping_cart'])):
            $total=0;
            foreach ($_SESSION['shopping_cart'] as $key => $product):
                ?>
                <?php
                $total= $total + ($product['quantity']* $product['price']);
            endforeach;
        endif;
        ?>
    <br>
        <tr>
        <th>Order Total</th>
            <td ><?php echo number_format($total,2); ?></td>
        </tr>
        <tr>
						<th>Shipping and Handling</th>
						<td>
							Free Shipping				
						</td>
					</tr>
			</table>

			
            <br>
			<h4 > <b> Payment Method</b></h4>
			<div>
				<div class="row">
					
						<div class="col-md-4">
							<input name="payment" id="radio1" class="css-checkbox" name=""type="radio"value="cod"><span> Cash on Delivery</span>
						</div>
						<div class="col-md-4">
							<input name="payment" value="cheque"id="radio2" class="css-checkbox" name=""type="radio"><span>Cheque Payment</span>
						</div>
					
				</div>
			<br>
            <br>
				
				
				<div style="text-align: center;">
                		<?php
                   			 if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    			 $name = $_POST["name"];
                        		 $_SESSION["name"]=$name;}
                        ?>
                        <div>   
 								<input type="submit" class="button btn-lg center" value="Pay Now"  name="submitForm">
                        </div>
					<?php 
			if (isset($_POST['submitForm'])){
				echo '<script>window.location = "payment.php" </script>';
			}
			?>	
                
                </div>
				
        
			</div>
		</div>		
</form>		
		
        
        
<?php include 'includes/footer.php';