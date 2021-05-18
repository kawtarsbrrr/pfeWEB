<?php
    session_start();
    include "includes/header.php";
	?>
    <div class='alert alert-info'>
    Thanks  <?php echo $_SESSION["name"];?> For Placing the order .Click <a href="index.php">Here</a> To Continue Buying
    </div>

    <?php
    include "includes/footer.php";
	?>