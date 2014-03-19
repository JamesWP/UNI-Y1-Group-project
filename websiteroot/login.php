<?php include '../application/app.php'; ?>
<?php pageInit(); 

connectDB();
  
  if(isset($_POST['user'])&&isset($_POST['password'])){
    $user = strtolower($_POST['user']);
    $password = $_POST['password'];
    doLogin($user, $password);
  }
  disconnectDB();

  if(isset($_GET['logout'])){
    session_destroy();
    session_start();
    $loggedout = true;
  }

  $message = $_SESSION['message'];
  unset($_SESSION['message']);
  unset($_SESSION['loggedout']);
?>

<?php pageHead(); ?>


    <form role="form">
      <div class="col-md-4 col-md-offset-4">
      <?php if(isset($loggedout)): ?>
        <div class="alert alert-success">
          <strong>You are now logged out!</strong>
        </div>
      <?php endif; ?>
      <?php if (isset($message)) : ?>
        <div class="alert alert-danger">
          <strong>You need to sign in first!</strong>
        </div>
      <?php endif;?>
       <div class="page-header">
         <h4>Sign in</h4>
       </div>
         <div class="form-group">
           <label for="exampleInputEmail1">Username</label>
           <input type="email" name='user' class="form-control" id="exampleInputEmail1" placeholder="Username">
         </div>
         <div class="form-group">
           <label for="exampleInputPassword1">Password</label>
           <input type="password" name='password' class="form-control" id="exampleInputPassword1" placeholder="Password">
         </div>
         <div class="checkbox">
           <label> <input type="checkbox"> Remember me </label>
         </div>
      </div>
    </form>
<?php pageFoot(); ?>
