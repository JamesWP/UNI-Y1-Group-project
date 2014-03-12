<?php include '../application/app.php'; ?>
<?php include '../database/connect.php'; ?>
<?php pageInit(); ?>
<?php pageHead(); ?>
        
      <div class="container">  
     	 <div class="page-header">
          <h3>Create Your Own</h3>
         </div>
        <!-- Choose a question type -->
        <div class="btn-group">
          <button type="button" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown">
            Choose a Question Type <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Multiple choice</a></li>
            <li><a href="#">Truth or false</a></li>
            <li><a href="#">Fill in the blanks</a></li>
          </ul>
       </div>
       </div>
       
       <div class="col-lg-6" style="margin-top:50px; margin-left: 20%;"> 
         <!-- Buttons (bold, italic, image) -->
         <div id="wysiwyg_cp">
          <button id="boldButton" type="button" class="btn btn-primary" onClick="iBold()">
            <span class="glyphicon glyphicon-bold"></span>
          </button>
          <button id="italicButton" type="button" class="btn btn-primary" onClick="iItalic()">
            <span class="glyphicon glyphicon-italic"></span>
          </button>
          <button type="button" id="imageButton" class="btn btn-primary" onClick="iImage()">
            <span class="glyphicon glyphicon-picture"></span>
          </button>
          </div>
         <!-- Text area-->
          <textarea style="display:none;" id="textArea" class="form-control"></textarea>
          <iframe name"richTextField" id="richTextField" style="margin:10px 0px 0px -14px; width:500px; height:250px;" placeholder="Enter question..."></iframe>
       </div>
       
       <div class="col-lg-6" style="margin-top:50px; margin-right: 20%;">
         <h4>Type your answers</h4>
         <form class="form-inline" role="form">
           <div class="form-group">
             <label class="sr-only" for="answer">Answers</label>
             <input type="text" class="form-control" placeholder="Answer">
           </div>
           <div class="radio">
             <label> <input type="radio" name="answers" id="answer1" value="option1" checked>Correct</label>
           </div>
           <br></br>
           <div class="form-group">
             <label class="sr-only" for="answer">Answers</label>
             <input type="text" class="form-control" placeholder="Answer">
           </div>
           <div class="radio">
             <label> <input type="radio" name="answers" id="answer2" value="option2" checked>Correct</label>
           </div>
           <br></br>
           <div class="form-group">
             <label class="sr-only" for="answer">Answers</label>
             <input type="text" class="form-control" placeholder="Answer">
           </div>
           <div class="radio">
             <label> <input type="radio" name="answers" id="answer3" value="option3" checked>Correct</label>
           </div>
           <br></br>
           <div class="form-group">
             <label class="sr-only" for="answer">Answers</label>
             <input type="text" class="form-control" placeholder="Answer">
           </div>
           <div class="radio">
             <label> <input type="radio" name="answers" id="answer4" value="option4" checked>Correct</label>
           </div>
         </form>
         <button type="button" class="btn btn-primary btn-lg" type="submit" style="margin-top:20px;">Submit</button>
       </div> 
     </div> <!--/wrap -->
    
<?php pageFoot(); ?>