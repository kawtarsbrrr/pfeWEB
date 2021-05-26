<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="index.php" >
            <img src="includes/untitled.png" class="img-responsive" style="height: 40px; margin-right: 0px; padding: 0px;" >
</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li>


        

        <li class="nav-item dropdown" style="float: right; margin-left: 310mm;">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
            Account
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            
            <?php 
            
        if(isset($_SESSION['user_id']))
        { ?> 
        <a class="dropdown-item" href="logout.php">Logout</a>
        <?php } else{?> 
          <a class="dropdown-item"  href="signup.php">Sign up</a>
            <a class="dropdown-item" href="login.php">Log in</a>
            <?php }?>
          </div>
        </li>

        
      </ul>
     
  
    </div>
  </div>
</nav>