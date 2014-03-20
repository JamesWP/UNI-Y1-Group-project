<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php pageHead(); ?>

<?php
// $id = $_GET['id'];
connectDB();
  $decks = getDecks(2);
  $subjectInfo = getSubjectInfo(2);
  $deckID = 2;
  $questions = getQuestions($deckID);
  $deckInfo = getDeckInfo($deckID);
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
            <a href="<?php echo getQuizLinkForDeck($deck['id']);?>" class="list-group-item"><?php echo $deck["name"]; ?></a>
        <?php } ?>
      </div>
      <div class="col-md-6 list-group">
          <a class='list-group-item active'> Questions for <?php echo $deckInfo["deckName"]; ?> 
            <button href="<?php echo getBaseUrl()."create-your-own.php?deckID=".$deckID?>" type="button" class="pull-right btn btn-primary btn-sm">create new question</button>
            <div class="clearfix"></div>
          </a>
          <?php foreach($questions as $question){?>
            <div href="#" class='list-group-item'>
              <div class="row">
                <div class="col-xs-9">
                  <?php echo $question["text"]; ?>
                </div>
                <div class="col-xs-3">
                  <button href="<?php echo getBaseUrl()."create-your-own.php?deckID=".$deckID."&id=".$question['id']; ?>" type="button" class="btn btn-warning btn-sm">edit</button>
                  <button href="#" type="button" class="btn btn-danger btn-sm">delete</button>
                </div>
              </div>
            </div>
          <?php } ?>
          
      </div>
    </div>
  </div>
<script>

  $('button[href]').click(function(){
  	window.location.href = $(this).attr('href');
  })
  
</script>
<?php pageFoot(); ?>      
