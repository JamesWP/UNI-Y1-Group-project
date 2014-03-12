<?php include '../application/app.php'; ?>
<?php pageInit(); ?>
<?php pageHead(); ?>

<?php
  $id = $_GET['id'];
?>

  <div class="container">
    <div id=flipup-logo class="row">
      <div class="col-md-8 col-md-offset-2 pagination-centered">
      </div>
    </div>
    <div class="row">
      <h1>Subject id: <?php echo $id; ?></h1>
    </div>
  </div>
<?php pageFoot(); ?>
