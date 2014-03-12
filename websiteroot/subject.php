<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php
  $id = $_GET['id'];
  connectDB();
  $decks = getDecks($id);
  $subjectInfo = getSubjectInfo($id);
  disconnectDB();
?>

<?php pageHead(); ?>
  <div class="container">
    <div id=flipup-logo class="row">
      <div class="col-md-8 col-md-offset-2 pagination-centered">
      </div>
    </div>
    <div class="row">
      <h3>Subject: <?php echo $subjectInfo['name']; ?></h3>
    </div>
    <div class="row">
      <div class="col-md-6 list-group">
        <a href="#" class="list-group-item active">Decks</a>
        <?php foreach($decks as $deck){?>
          <a href="<?php echo getQuizLinkForDeck($deck['id']);?>" class="list-group-item"><?php echo $deck['name']; ?><span class="badge"><?php echo $deck['total'];?></span></a>
        <?php } ?>
      </div>
    </div>
  </div>
<?php pageFoot(); ?>
