<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php
$id = $_GET['id'];
connectDB();
$questions = getQuestions($id);
$deckInfo = getDeckInfo($id);

disconnectDB();
?>

<?php pageHead(); ?>
<div class="container">
  <div class="row">
    Deck: <?php echo $deckInfo['deckName']; ?> ( <?php echo $deckInfo['subjectName']; ?> )
  </div>
  <div class="row" id="subject">
    <div class="col-md-6 list-group">
      <div class="list-group-item active">Decks</div>
      <?php foreach ($questions as $question) { ?>
        <div class="list-group-item">
          <?php echo $question['text']; ?>
          <span class="btn-group pull-right">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Action</a>
              </li>
              <li><a href="#">Another action</a>
              </li>
              <li><a href="#">Something else here</a>
              </li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a>
              </li>
            </ul>
          </span>
          <div class="clearfix"></div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php pageFoot(); ?>
