<?php include '../application/app.php'; ?>
<?php include '../database/connect.php'; ?>
<?php //pageInit(); ?>

<?php /* TODO need to gather data from database */
  $questions = array();
  $questions[] = array("title"=>"Question 1","correct"=> true,"text"=>"example text1");
  $questions[] = array("title"=>"Question 2","correct"=> false,"text"=>"example text2");
?>

<?php pageHead(); ?>
<div class="container">
  <div id=flipup-logo class="row">
    <div class="col-md-8 col-md-offset-2 pagination-centered">
      <img class="img-responsive" src="<?php echo getBaseUrl();?>images/flipup.png"/> 
    </div>
  </div>
  <div class="row">
    <div class="col-md-3 list-group">   </div>
    <div class="col-md-6 list-group">
      <?php foreach($questions as $question){ ?>
        <div class="accordion" id="accordion2">
          <div class="accordion-group">
            <div class="accordion-heading">
      		    <a href='#' class='list-group-item'><?php echo $question['title'];?> <span class="pull-right btn btn-<?php echo $question['correct']?"success":"danger"; ?>" ></a>
          	  <div class="panel-collapse collapse">
            	  <div class="panel-body">test</div>
          	  </div>
            </div>
          </div>
        </div>                   
      <?php } ?>
    </div>

  </div>
</div>
<?php pageFoot(); ?>
