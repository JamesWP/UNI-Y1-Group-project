<?php include '../application/app.php'; ?>
<?php include '../database/connect.php'; ?>
<?php pageInit(); ?>
<?php pageHead(); ?>

<div class="container">
    <div class="col-md-4 list-group">
</div>
<form action ="../database/create-account.php" method = "post" class="col-md-4 form-group" style="align: center;">
    <div class="form-group">
      <label for="name">Username</label>
      <input type="text" class="form-control" id="user" placeholder="Username">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Password">
    </div>  
    <button type="submit" class="btn btn-default">Submit</button>
</form>

</div>

<?php pageFoot(); ?>