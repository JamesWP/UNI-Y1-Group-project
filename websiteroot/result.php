<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php /* TODO need to gather data from database */
  $score = 5;
  connectDB();
  $data = getResults($_SESSION['quizID']);
  $questions = $data['questions'];
  $correct = $data['correct'];
  $otherResults = array(array('user' => 'username', 'score' => 'score'));
  $relatedQuizes = array(array('otherQuizes' => 'quiz'));
  disconnectDB();
?>

<?php pageHead(); ?>

<div class="container">
<div class="row well well-lg">
<div class="col-md-6 col-md-offset-3" style="text-align:center">
<h1> Congratz <h1>
<p1>You score <?php echo $score;?> on this quiz<p1>
</div>

</div>
</div>
<div class="container">
  <div class="row">

    <div class="col-md-6 list-group">
      <a class="list-group-item active">
      Question Results
      </a>
      <?php foreach($questions as $question){ ?>
        <div class="accordion" id="accordion2">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a href='#' class='list-group-item'><?php echo $question['title'];?> <span class="pull-right btn btn-<?php echo $question['correct']?"success":"danger"; ?>" ></span></a>
          	  <div class="panel-collapse collapse">
            	  <div class="panel-body"><?php echo $question['text']; ?></div>
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
            Other's Results
          </a>
          <?php foreach($otherResults as $otherResult){ ?>
            <a href='#' class='list-group-item'><?php echo $otherResult['user'];?> <span class="pull-right"><?php echo $otherResult['score'];?></span></a>
          <?php } ?>
        </div>
      </div>
      <div class="row">
        <div class="list-group">
          <a class="list-group-item active">
            Other Quizes
          </a>
          <?php foreach($otherResults as $otherResult){ ?>
            <a href='#' class='list-group-item'><?php echo $relatedQuizes['otherQuizes'];?></a>
          <?php } ?>
        </div>
      </div>
   </div>
 </div>
</div>
<script>
 $('.list-group-item').click(function(){
   $(this).parent().find('.collapse').toggle()
   return false;
 });
</script>
<?php pageFoot(); ?>
