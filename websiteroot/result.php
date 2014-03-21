<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php /* TODO need to gather data from database */
connectDB();


if (isset($_SESSION['quizID'])) {
  $quizID = $_SESSION['quizID'];
  $_SESSION['lastQuizID'] = $_SESSION['quizID'];
  unset($_SESSION['quizID']);
} else {
  $quizID = $_SESSION['lastQuizID'];
}

if (!isset($_SESSION['ratings'])) {
  $_SESSION['ratings'] = array();
}

if (isset($_REQUEST['rate'])) {
  $questionID = intval($_REQUEST['questionID']);
  $rating = intval($_REQUEST['rating']);

  if (!in_array($questionID, $_SESSION['ratings'])) {
    addQuestionRating($questionID, $quizID, $rating);
    $_SESSION['ratings'][] = $questionID;
  }
}
disconnectDB();
connectDB();
$data = getResults($quizID);
$questions = $data['questions'];
$correct = $data['correct'];
$otherResults = getOtherUsersScore($quizID);
$relatedQuizes = getOtherQuizes($quizID);
$score = getScore($quizID) / getNoOfQuestions($quizID) * 100;
disconnectDB();
?>

<?php pageHead(); ?>

<div class="container">
  <div class="row well well-lg">
    <div class="col-md-6 col-md-offset-3" style="text-align:center">
      <h1> Congratz
        <h1>
          <p>You scored <?php echo intval($score) . "%"; ?> on this quiz
          </p>
        </h1>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">

    <div class="col-md-6 list-group">
      <a class="list-group-item active">
        Question Results
      </a>
      <?php foreach ($questions as $question) { ?>
        <div class="accordion" id="accordion2">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a href='#' class='list-group-item'><?php echo $question['title']; ?> <span
                    class="pull-right btn btn-<?php echo $question['correct'] ? "success" : "danger"; ?>"></span></a>

              <div class="panel-collapse collapse">
                <div class="panel-body">
                  <?php if (!in_array($question['questionID'], $_SESSION['ratings'])) : ?>
                    <div class="pull-right btn-group">
                      <a href="<?php echo getBaseUrl() . "result.php?rate&questionID=" . $question['questionID'] . "&rating=0"; ?>"
                         id="rate" class="rate btn btn-default btn-sm"><span
                            class="glyphicon glyphicon-star"></span></a>
                      <a href="<?php echo getBaseUrl() . "result.php?rate&questionID=" . $question['questionID'] . "&rating=1"; ?>"
                         id="rate" class="rate btn btn-default btn-sm"><span
                            class="glyphicon glyphicon-star"></span></a>
                      <a href="<?php echo getBaseUrl() . "result.php?rate&questionID=" . $question['questionID'] . "&rating=2"; ?>"
                         id="rate" class="rate btn btn-default btn-sm"><span
                            class="glyphicon glyphicon-star"></span></a>
                      <a href="<?php echo getBaseUrl() . "result.php?rate&questionID=" . $question['questionID'] . "&rating=3"; ?>"
                         id="rate" class="rate btn btn-default btn-sm"><span
                            class="glyphicon glyphicon-star"></span></a>
                      <a href="<?php echo getBaseUrl() . "result.php?rate&questionID=" . $question['questionID'] . "&rating=4"; ?>"
                         id="rate" class="rate btn btn-default btn-sm"><span
                            class="glyphicon glyphicon-star"></span></a>
                    </div>
                  <?php endif; ?>
                  <?php echo $question['text']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="list-group">
          <a class="list-group-item active">
            Others' Results
          </a>
          <?php foreach ($otherResults as $otherResult) { ?>
            <a href='#' class='list-group-item'><?php echo $otherResult['user']; ?> <span
                  class="pull-right"><?php echo $otherResult['score']; ?></span></a>
          <?php } ?>
        </div>
      </div>
      <div class="row">
        <div class="list-group">
          <a class="list-group-item active">
            Other Quizzes
          </a>
          <?php foreach ($relatedQuizes as $relatedQuiz) { ?>
            <a href='<?php echo getBaseUrl() . "quiz.php?deckID=" . $relatedQuiz['deckID']; ?>'
               class='list-group-item'><?php echo $relatedQuiz['otherQuizes']; ?></a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('#accordion2 .list-group-item').click(function () {
    $(this).parent().find('.collapse').toggle()
    return false;
  });
  $('.btn-default').click(function () {
    $(this).toggleClass('btn-warning');
  });
</script>
<?php pageFoot(); ?>
