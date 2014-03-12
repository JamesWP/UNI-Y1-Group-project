<?php include '../application/app.php'; ?>
<?php include '../database/connect.php'; ?>
<?php //pageInit(); ?>

<?php /* TODO need to gather data from database */
  $Questions = array();
  $Questions[] = array("title"=>"Question 1","correct"=> true,"text"=>"example text1");
  $Questions[] = array("title"=>"Question 2","correct"=> false,"text"=>"example text2");
?>

<?php pageHead(); ?>
  <div class="container">
    <div id=flipup-logo class="row">
      <div class="col-md-8 col-md-offset-2 pagination-centered">
        <img class="img-responsive" src="<?php echo getBaseUrl();?>images/flipup.png"/> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 list-group">
        <a href="#" class='list-group-item active'>Question</span></a>
        <?php foreach($Questions as $Question){ ?>
          <div class="panel-group" id="accordion">
	  	        <div class="panel panel-default">
	  	          <div class="panel-heading"> 
          		       <a href="<?php echo getLinkForSubject($Question['correct'])?>" class='list-group-item'><?php echo $Question['title'];?> <span class="pull-right btn btn-success"></a>
		          	<div class="panel-collapse collapse">
		            	  <div class="panel-body">
		              	    test
		            	  </div>
		          	</div>
                           </div>
                     	</div>                    
        <?php } ?>
      </div>
    </div>
  </div>
<?php pageFoot(); ?>
