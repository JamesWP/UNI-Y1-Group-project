<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php pageHead(); ?>


    <form role="form">
      <div class="col-md-4 col-md-offset-4">
      <div class="alert alert-success">
        <strong>You are now logged out!</strong>
      </div>
       <div class="alert alert-danger">
         <strong>You need to sign in first!</strong>
       </div>
      <div class="alert alert-warning">
        <strong>Your username or password is incorrect!</strong>
      </div>
       <div class="page-header">
         <h4>Sign in</h4>
       </div>
         <div class="form-group">
           <label for="exampleInputEmail1">Email address</label>
           <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
         </div>
         <div class="form-group">
           <label for="exampleInputPassword1">Password</label>
           <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
         </div>
         <div class="checkbox">
           <label> <input type="checkbox"> Remember me </label>
         </div>
      </div>
    </form>
<?php pageFoot(); ?>
<?php include '../application/app.php';
  pageInit();
  connectDB();
  
  if(isset($_POST['user'])&&isset($_POST['password'])){
    $user = strtolower($_POST['user']);
	  $password = $_POST['password'];
	  doLogin($user, $password);
  }
  print_r($_SESSION);
  disconnectDB();
?>
>>>>>>> 1b8414586985ce375188cc8754125cbcba5bd0ac
