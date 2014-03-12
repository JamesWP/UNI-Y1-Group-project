<?php include '../application/app.php'; ?>
<?php include '../database/connect.php'; ?>
<?php pageInit(); ?>
<?php pageHead(); ?>

<div class="container">
    <div class="col-md-4 list-group">
    </div>
<form action ="../database/create-account.php" method = "post" class="col-md-4 form-group" style="align: center;">
<h2 class="form-signin-heading" class="">Sign up for a free account</h2>
    <div class="form-group">
      <label for="name">Username</label>
      <input type="text" class="form-control" id="user" placeholder="Username">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Password">
    </div>  
   <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top: 30px;">Sign up</button>
</form>

</div>

<?php pageFoot(); ?>