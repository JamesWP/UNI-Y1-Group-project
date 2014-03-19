<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php /* TODO need to gather data from database */
  $score = 5;
  connectDB();
  $data = getResults(15);
  $questions = $data['questions'];
  $correct = $data['correct'];
  $otherResults = array(array('user' => 'username', 'score' => 'score'));
  disconnectDB();
?>

<?php pageHead(); ?>
<span class="pull-right btn btn-
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
    <div class="col-md-6 list-group">
      <?php foreach($otherResults as $otherResult){ ?>
        <div class="accordion" id="accordion2">
          <div class="accordion-group">
            <div class="accordion-heading">
      		    <a href='#' class='list-group-item'><?php echo $otherResult['user'];?><span class="pull-right btn btn-<?php echo $otherResult['score'];?>"></span></a>
            </div>
           </div>
        </div>
      <?php } ?> 
   </div>
<script>
 $('.list-group-item').click(function(){
   $(this).parent().find('.collapse').toggle()
   return false;
 });
</script>
<?php pageFoot(); ?>
