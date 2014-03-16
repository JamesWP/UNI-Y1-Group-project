<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php 

if(isset($_GET['id']))
{
  $id = intval($_GET['id']);
  connectDB();
  $questionData = str_replace(array("\n", "\r","\t"), '', getQuestion($id)['data']);
  disconnectDB();
}

?>

<?php pageHead(array("style/createLayout.css")); ?>
        
<div class="container">  
 	<div class="page-header">
    <h3>Create Your Own</h3>
  </div>
  <div class="row form-horizontal">
    <div class="col-md-6"> 
      <h4>Question</h4> 
      <textarea class="form-control questionText" rows="3" placeholder="Enter question here"></textarea>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <h4>Answers</h4>
        <select class="questionTypeSelect form-control" id="selQ">
          <option value="">Choose a quesetion type</option>              
          <option value="multiplechoice">Multiple choice</option>
          <option value="blanks">Fill in the blank</option>
          <option value="truefalse">Truth or false</option>
        </select>
      </div>
      <div class="questionType" data-questionType="multiplechoice">
        <div class="row form-group answer">
          <div class="col-md-8">
            <input type="text" class="form-control" />
          </div>
          <div class="col-md-4">
            <select name="correct" class="form-control">
              <option value="">---</option>
              <option value="true">Correct</option>
              <option value="false">Incorrect</option>
            </select>
          </div>
        </div>
        <div class="btn-group form-group">
          <button type="button" class="btn add-answer btn-success btn-sm">Add <span class="glyphicon glyphicon-plus" ></span></button>
          <button type="button" class="btn rem-answer btn-warning btn-sm">Remove <span class="glyphicon glyphicon-minus" ></span></button>
        </div>
      </div>
      <div class="questionType" data-questionType="blanks">
        <div class="row form-group">
          <label data-toggle="tooltip" class="ttooltip" data-placement="bottom" title="How many changes from the correct answer is accepted">Closeness</label>
          <input type="text" class="form-control editDistance" />
        </div>
        <div class="row form-group answer">
          <div class="col-md-8">
            <input type="text" class="form-control" />
          </div>
          <div class="col-md-4">
            <select name="correct" class="form-control">
              <option value="">---</option>
              <option value="true">Correct</option>
              <option value="false">Incorrect</option>
            </select>
          </div>
        </div>
        <div class="btn-group form-group">
          <button type="button" class="btn add-answer btn-success btn-sm">Add <span class="glyphicon glyphicon-plus" ></span></button>
          <button type="button" class="btn rem-answer btn-warning btn-sm">Remove <span class="glyphicon glyphicon-minus" ></span></button>
        </div>
      </div>
      <div class="questionType" data-questionType="truefalse">
        <div class="row form-group">
          <label>Correct answer</label>
          <select name="correct" class="questionAnswer form-control">
            <option value="">---</option>
            <option value="true">True</option>
            <option value="false">False</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
<?php pageFoot(array('lib/module-create.js')); ?>
