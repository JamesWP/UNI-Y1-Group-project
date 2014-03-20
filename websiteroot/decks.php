<?php include '../application/app.php'; ?>
<?php pageInit(); ?>


<?php
if (isset($_GET['deckID']))
  $deckID = $_GET['deckID'];
connectDB();
if (isset($_GET['subjectID']))
  $subjectID = $_GET['subjectID'];
else {
  $subjectID = getSubjectFromDeck($deckID);
}

if (isset($_GET['delete'])) {
  $questionID = $_REQUEST['questionID'];
  $userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : -1;
  if ($userID == -1) {
    header("location:" . getBaseUrl() . "decks.php&subjectID=" . $subjectID . "&deckID=" . $deckID);
    disconnectDB();
    die();
  }
  $result = mysqli_query($con, "SELECT userID FROM `Question` WHERE questionID = $questionID");
  $creator = mysqli_fetch_assoc($result);
  $creator = $creator['userID'];
  if ($creator == $userID) {
    deleteQuestion($questionID);
    $deleted = 1;
  } else
    $notCreator = 1;

}

$subjects = getSubjects();
$isLoggedIn = isLoggedIn();
$decks = getDecks($subjectID);
$subjectInfo = getSubjectInfo($subjectID);
if (isset($deckID)) {
  $questions = getQuestions($deckID);
  $deckInfo = getDeckInfo($deckID);
}

disconnectDB();
?>
<?php pageHead(); ?>
<style>
  .top-page {
    margin-bottom: 195px;
  }
</style>
<div class="container">
  <div class="page-header top-page">
    <h1>The list of decks for <?php echo $subjectInfo["name"]; ?></h1>
  </div>
  <div class="row">
    <?php if (isset($notCreator)) { ?>
      <div class="alert alert-danger">
        <strong>You cannot delete a question that wasn't created by you!</strong>
      </div>
    <?php
    }
    if (isset($deleted)) {
      ?>
      <div class="alert alert-success save-success hidden">
        <strong>You have successfully deleted a question!</strong>
      </div>
    <?php } ?>
    <div class="col-md-4 list-group">
      <a href="#" class='list-group-item active'>Subjects</a>
      <?php foreach ($subjects as $subject) { ?>
        <a href="<?php echo getLinkForSubject($subject['id']) ?>"
           class='subject list-group-item'><?php echo $subject['name']; ?>
          <span class="pull-right glyphicon glyphicon-circle-arrow-right">
        </a>
      <?php } ?>
    </div>
    <div class="col-md-4 list-group">
      <a class='list-group-item active'>
        <button href="<?php echo getBaseUrl() . "decks.php?subjectID=" . $subjectID . "&deckID=" . $deck['id']; ?>"
                                                type="button" class="pull-right btn btn-default btn-xs">new deck
        </button>List of Decks</a>
      <?php foreach ($decks as $deck) { ?>
        <a class="list-group-item">
          <?php echo $deck["name"]; ?>
          <div class="pull-right">
            <span class="badge"><?php echo $deck["questions"]; ?></span>
            <button href="<?php echo getBaseUrl() . "decks.php?subjectID=" . $subjectID . "&deckID=" . $deck['id']; ?>"
                    type="button" class="btn btn-default btn-sm">view
            </button>
            <button href="<?php echo getBaseUrl() . "quiz.php?deckID=" . $deck['id']; ?>" type="button"
                    class="btn btn-success btn-sm">start
            </button>
          </div>
          <div class="clearfix"></div>
        </a>
      <?php } ?>
    </div>
    <div class="col-md-4 list-group">
      <?php if (isset($_GET['deckID'])): ?>
      <a class='list-group-item active'> Questions for <?php echo $deckInfo["deckName"]; ?>
        <?php if ($isLoggedIn): ?>
          <button href="<?php echo getBaseUrl() . "create-your-own.php?deckID=" . $deckID ?>" type="button"
                  class="pull-right btn btn-default btn-xs">new question
          </button>
        <?php endif; ?>
        <div class="clearfix"></div>
      </a>
      <?php foreach ($questions as $question) { ?>
        <div class='list-group-item'>
          <?php if ($isLoggedIn): ?>
            <div class="pull-right">
              <button
                  href="<?php echo getBaseUrl() . "create-your-own.php?deckID=" . $deckID . "&id=" . $question["questionID"]; ?>"
                  type="button" class="btn btn-warning btn-sm">edit
              </button>
              <button type="button"
                      href="<?php echo getBaseUrl() . "decks.php?subjectID=" . $subjectID . "&deckID=" . $deckID . "&questionID=" . $question['questionID'] . "&delete"; ?>"
                      class="btn btn-danger btn-sm">Delete
              </button>
            </div>
          <?php endif; ?>
          <?php echo $question["text"]; ?>
          <div class="clearfix"></div>
        </div>
      <?php } ?>
    </div>
  <?php endif; ?>
  </div>
</div>
</div><?php //cont ?>
<script>

  $('button[href]').click(function () {
    window.location.href = $(this).attr('href');
  })

</script>
<?php pageFoot(); ?>      
