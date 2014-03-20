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
    header("location:index.php");
  }

  $message = $_SESSION['message'];
  unset($_SESSION['message']);
?>

<?php pageHead(); ?>

<?php
    if ($_SESSION['loggedin'] == 1)
    header("location:index.php");
?>

<div class="container">
    <div class="col-md-4 list-group">
    </div>

    <form role="<?php echo getBaseUrl(); ?>login.php" method = "post" class="col-md-4 form-group" style="align: center; margin-top: 50px;">
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
           <label for="username">Username</label>
           <input type="text" name='user' class="form-control" id="exampleInputUsername" placeholder="Username">
         </div>
         <div class="form-group">
           <label for="password">Password</label>
           <input type="password" name='password' class="form-control" id="exampleInputPassword1" placeholder="Password">
         </div>
         <div class="checkbox">
           <label> <input type="checkbox"> Remember me </label>
         </div>
         <input type="submit" name="submit" value="Sign in" class="btn btn-lg btn-primary btn-block" style="margin-top: 40px">
    </form>
</div>
<?php pageFoot(); ?>
