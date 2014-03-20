<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php pageHead(); ?>

<?php
  $subjectID = $_GET['subjectID'];
  if(isset($_GET['deckID']))
    $deckID = $_GET['deckID'];
  connectDB();
  $isLoggedIn = isLoggedIn();
  $decks = getDecks($subjectID);
  $subjectInfo = getSubjectInfo($subjectID);
  if(isset($deckID)){
    $questions = getQuestions($deckID);
    $deckInfo = getDeckInfo($deckID);
  }
  disconnectDB();
?>
  <div class="container">
    <div class="page-header">
      <h1>The list of decks for <?php echo $subjectInfo["name"]; ?></h1>
    </div>
    <div class="row">
      <div class="col-md-6 list-group">
          <a class='list-group-item active'>List of Decks</a>
          <?php foreach($decks as $deck){?>
            <a href="<?php echo getBaseUrl()."decks.php?subjectID=".$subjectID."&deckID=".$deck['id'];?>" class="list-group-item"><?php echo $deck["name"]; ?>
              <span class="pull-right badge"><?php echo $deck["questions"];?></span>
            </a>
        <?php } ?>
      </div>
      <div class="col-md-6 list-group">
        <?php if(isset($_GET['deckID'])):?>
          <a class='list-group-item active'> Questions for <?php echo $deckInfo["deckName"]; ?>
            <?php if($isLoggedIn):?>
              <button href="<?php echo getBaseUrl()."create-your-own.php?deckID=".$deckID?>" type="button" class="pull-right btn btn-primary btn-sm">create new question</button>
            <?php endif;?>
            <div class="clearfix"></div>
          </a>
          <?php foreach($questions as $question){?>
            <div class='list-group-item'>
              <?php if($isLoggedIn):?>
              <div class="pull-right">
                <button href="<?php echo getBaseUrl()."create-your-own.php?deckID=".$deckID."&id=".$question['id']; ?>" type="button" class="btn btn-warning btn-sm">edit</button>
                <button href="#" type="button" class="btn btn-danger btn-sm">delete</button>
              </div>
              <?php endif;?>
              <?php echo $question["text"]; ?>
              <div class="clearfix"></div>
            </div>
          <?php } ?>
          
      </div>
      <?php endif;?>
    </div>
</div>
</div><?php //cont ?>
<script>

  $('button[href]').click(function(){
  	window.location.href = $(this).attr('href');
  })
  
</script>
<?php pageFoot(); ?>      
