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
    <div id="flipup-logo" class="row">
      <div class="col-md-8 col-md-offset-2 pagination-centered">
        <img class="img-responsive" src="<?php echo getBaseUrl();?>images/rsz_flipup.png"/> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-4"><div class="list-group">
        <a href="#" class='list-group-item active'>Subjects</a>
        <?php foreach($subjects as $subject){ ?>
          <a href="<?php echo getLinkForSubject($subject['id'])?>" class='subject list-group-item'><?php echo $subject['name'];?> <span class="pull-right glyphicon glyphicon-circle-arrow-right"></a>
        <?php } ?>
      </div></div>
      <div class="col-md-4 subjectsAfter"><div class="list-group">
        <a href="#" class='list-group-item active'>Top Decks</a>
        <?php foreach($topdecks as $deck){ ?>
          <a href="<?php echo getBaseUrl()."quiz.php?deckID=".$deck['id'];?>" class='list-group-item'><?php echo $deck['name'];?> <span class="pull-right glyphicon glyphicon-circle-arrow-right"></a>
        <?php } ?>
      </div></div>
      <div class="col-md-4"><div class="list-group">
        <a href="#" class='list-group-item active'>New Decks</a>
        <?php foreach($newdecks as $deck){ ?>
          <a href="<?php echo getBaseUrl()."quiz.php?deckID=".$deck['id'];?>" class='list-group-item'><?php echo $deck['name'];?> <span class="pull-right glyphicon glyphicon-circle-arrow-right"></a>
        <?php } ?>
      </div></div>
    </div>
  </div>
  <div class="container">
    <!--<div class="well">-->
      <div class="row">
        <div class="col-md-3">
          <div class="panel panel-default mypanel">
            <div class="panel-body">
              <span class="label label-default col-md-1">1</span>
              <p class="col-md-11">First select a subject or a deck to begin!</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-md-offset-1">
          <div class="panel panel-default mypanel">
            <div class="panel-body">
            <span class="label label-default col-md-1">2</span>
              <p class="col-md-11">Then pick a Deck of questions and either view the questions or take the quiz!</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-md-offset-1">
          <div class="panel panel-default mypanel">
            <div class="panel-body">
              <span class="label label-default col-md-1">3</span>
              <p class="col-md-11">Then create an account and create your own Decks!</p>
            </div>
          </div>
        </div>
      </div>
    <!--</div>-->
  </div>
  <script>
    $(function(){
      /*$('.subject').click(function(){
        $('.subjectsAfter').load($(this).attr('href') + ' #subject .list-group',function(){
          $('.subjectsAfter').children().removeClass('list-group').removeClass('col-md-6');
        }); 
        return false;
      });*/
    });
  </script>
<?php pageFoot(); ?>
