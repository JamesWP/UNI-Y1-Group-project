<?php include '../application/app.php'; ?>
<?php include '../database/connect.php'; ?>
<?php pageInit(); ?>
<?php pageHead(); ?>

<?php /* TODO need to gather data from database */
  $subjects = array();
  $subjects[] = array("name"=>"Computer science","id"=>1);
  $subjects[] = array("name"=>"French","id"=>2);
  $subjects[] = array("name"=>"Geography","id"=>3);
  $subjects[] = array("name"=>"Drama","id"=>4);
  $subjects[] = array("name"=>"For fun","id"=>5);

  $topdecks = array();
  $topdecks[] = array("name"=>"Gaming trivia","id"=>1);
  $topdecks[] = array("name"=>"Java Syntax","id"=>2);
  $topdecks[] = array("name"=>"Romanian verbs","id"=>3);
  $topdecks[] = array("name"=>"Software engineering","id"=>4);
  $topdecks[] = array("name"=>"Music trivia","id"=>5);
?>
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
