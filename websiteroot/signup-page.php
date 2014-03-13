<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php

  $STATE_NOTHING   =  0;
  $STATE_SOMETHING =  1;
  $STATE_EXISTS    =  2;
  $STATE_SUCCESS   =  3;
  $STATE_NOTMATCH  =  4;

  connectDB();

  $state = $STATE_NOTHING;

  if (isset($_POST['submit'])) 
  {
    if (isset($_POST['user']) && isset($_POST['password']) && isset($_POST['repassword']))
    {
      if ($_POST['password'] != $_POST['repassword']){
        $state = $STATE_NOTMATCH;
      }elseif(available($_POST['user'], $_POST['password'])) {
        create($_POST['user'], $_POST['password']);
        $state = $STATE_SUCCESS;
      }else{
        $state = $STATE_EXISTS;
      }
     }else{
       $state = $STATE_SOMETHING;
     }
  }
  //print_r(STATE_NOTMATCH==0);
 // die($state);
  disconnectDB();
?>


<?php pageHead(); ?>

<div class="container">
    <div class="col-md-4 list-group">
    </div>
<form action ="<?php echo getBaseUrl(); ?>signup-page.php" method = "post" class="col-md-4 form-group" style="align: center; margin-top: 50px;">
<h2 class="form-signin-heading" style="margin-bottom: 50px;">Sign up for a free account</h2>
<<<<<<< HEAD
  <?php if($state == $STATE_SUCCESS): ?>
     <div class="alert alert-danger">
=======
  <?php if($state == STATE_SUCCESS): ?>
     <div class="alert alert-success">
>>>>>>> getquestions 2/3 done
        <a class="alert-link">Account successfully created!</a>
     </div>
  <?php elseif($state == $STATE_NOTMATCH): ?>
     <div class="alert alert-danger">
        <a class="alert-link">Passwords don't match!</a>
     </div>
  <?php elseif ($state == $STATE_EXISTS): ?>
     <div class="alert alert-danger">
        <a class="alert-link">Username already exists!</a>
     </div>
  <?php elseif ($state == $STATE_SOMETHING): ?>
     <div class="alert alert-danger">
        <a class="alert-link">Please fill in both fields!</a>
     </div>
  <?php endif; ?>
    <div class="form-group">
      <label for="name">Username</label>
      <input type="text" class="form-control" id="user" name="user" placeholder="Username">
    </div>
    <div class="form-group">
      <label for="name">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="form-group">
      <label for="password">Retype Password</label>
      <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Retype Password">
    </div> 
   <input name="submit" value="Sign up" class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top: 60px; margin-bottom: 50px;" />
</form>
<?php // } ?>
</div>

<?php pageFoot(); ?>
