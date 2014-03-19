<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php
  connectDB();
  
  $subjects = getSubjects();
  $topdecks = getTopDecks();
  $newdecks = getNewDecks();

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
        <a href="#" class='list-group-item active'>Subjects</a>
        <?php foreach($subjects as $subject){ ?>
          <a href="<?php echo getLinkForSubject($subject['id'])?>" class='subject list-group-item'><?php echo $subject['name'];?> <span class="pull-right glyphicon glyphicon-circle-arrow-right"></a>
        <?php } ?>
      </div>
      <div class="col-md-4 list-group subjectsAfter">
        <a href="#" class='list-group-item active'>Top Decks</a>
        <?php foreach($topdecks as $deck){ ?>
          <a href="#" class='list-group-item'><?php echo $deck['name'];?> <span class="pull-right glyphicon glyphicon-circle-arrow-right"></a>
        <?php } ?>
      </div>
      <div class="col-md-4 list-group">
        <a href="#" class='list-group-item active'>New Decks</a>
        <?php foreach($newdecks as $deck){ ?>
          <a href="#" class='list-group-item'><?php echo $deck['name'];?> <span class="pull-right glyphicon glyphicon-circle-arrow-right"></a>
        <?php } ?>
      </div>
    </div>
  </div>
  <script>
    $(function(){
      $('.subject').click(function(){
        $('.subjectsAfter').load($(this).attr('href') + ' #subject .list-group',function(){
          $('.subjectsAfter').children().removeClass('list-group').removeClass('col-md-6');
        }); 
        return false;
      });
    });
  </script>
<?php pageFoot(); ?>
