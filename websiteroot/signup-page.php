<?php include '../application/app.php'; ?>
<?php pageInit(); ?>


<?php

  define (STATE_NOTHING, 0);
  define (STATE_SOMETHING, 1);
  define (STATE_EXISTS, 2);
  define (STATE_SUCCESS, 3);

  connectDB();

  $state = STATE_NOTHING;

  if (isset($_POST['submit'])) 
  {
    if (isset($_POST['user']) && isset($_POST['password']))
      if (available($_POST['user'], $_POST['password'])) {
        create($_POST['user'], $_POST['password']);
        $state = STATE_SUCCESS;
      }
      else
        $state = STATE_EXISTS;
    else
      $state = STATE_SOMETHING;

  }

  disconnectDB();
?>


<?php pageHead(); ?>

<div class="container">
    <div class="col-md-4 list-group">
    </div>
<form action ="<?php echo getBaseUrl(); ?>signup-page.php" method = "post" class="col-md-4 form-group" style="align: center; margin-top: 50px;">
<h2 class="form-signin-heading" style="margin-bottom: 50px;">Sign up for a free account</h2>
  <?php if($state == STATE_SUCCESS): ?>
     <div class="alert alert-danger">
        <a class="alert-link">Account successfully created!</a>
     </div>
  <?php elseif ($state == STATE_EXISTS): ?>
     <div class="alert alert-danger">
        <a class="alert-link">Username already exists!</a>
     </div>
  <?php elseif ($state == STATE_SOMETHING): ?>
     <div class="alert alert-danger">
        <a class="alert-link">Please fill in both fields!</a>
     </div>
  <?php endif; ?>
    <div class="form-group">
      <label for="name">Username</label>
      <input type="text" class="form-control" id="user" name="user" placeholder="Username">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>  
   <input name="submit" value="Sign up" class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top: 60px; margin-bottom: 50px;" />
</form>
<?php // } ?>
</div>

<?php pageFoot(); ?>