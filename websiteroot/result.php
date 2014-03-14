<?php include '../application/app.php'; ?>
<?php include '../database/connect.php'; ?>
<?php pageInit(); ?>

<?php /* TODO need to gather data from database */
  connectDB();
  $data = getResults(15);
  $questions = $data['questions'];
  $correct = $data['correct'];
  disconnectDB();
?>

<?php pageHead(); ?>
<div class="container">
  <div class="row">
    <div class="col-md-3 list-group">   </div>
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
  </div>
</div>
<script>
 $('.list-group-item').click(function(){
   $(this).parent().find('.collapse').toggle()
   return false;
 });
</script>
<?php pageFoot(); ?>
