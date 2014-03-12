<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php

  connectDB();

  $subjects = getSubjects();
  $topdecks = getTopDecks();

  disconnectDB();
?>

<?php pageHead(); ?>
  <div class="container">
    <div id=flipup-logo class="row">
      <div class="col-md-8 col-md-offset-2 pagination-centered">
        <img class="img-responsive" src="<?php echo getBaseUrl();?>images/flipup.png"/> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 list-group">
        <a href="#" class='list-group-item active'>Subjects</span></a>
        <?php foreach($subjects as $subject){ ?>
          <a href="<?php echo getLinkForSubject($subject['id'])?>" class='list-group-item'><?php echo $subject['name'];?> <span class="pull-right glyphicon glyphicon-circle-arrow-right"></a>
        <?php } ?>
      </div>
      <div class="col-md-4 list-group">
        <a href="#" class='list-group-item active'>Top Decks</span></a>
        <?php foreach($topdecks as $deck){ ?>
          <a href="#" class='list-group-item'><?php echo $deck['name'];?> <span class="pull-right glyphicon glyphicon-circle-arrow-right"></a>
        <?php } ?>
      </div>
      <div class="col-md-4 list-group">
        <a href="#" class='list-group-item active'>Subjects</span></a>
        <?php foreach($subjects as $subject){ ?>
          <a href="#" class='list-group-item'><?php echo $subject['name'];?> <span class="pull-right glyphicon glyphicon-circle-arrow-right"></a>
        <?php } ?>
      </div>
    </div>
  </div>
<?php pageFoot(); ?>
