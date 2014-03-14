<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php

  connectDB();

  $subjects = getSubjects();
  $topdecks = getTopDecks();

  disconnectDB();
?>

<?php pageHead(); ?>
  <div class="container">

      <div class="col-md-3 list-group" style="margin-top:20px;">
        <img src="<?php echo getBaseUrl();?>images/demo.jpg"/ alt="user_picture" class="thumbnail">            
        <h1>UserName</h1>
        <h2>Bio</h2>
        <p1>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam id tristique lectus. Donec suscipit, enim eget semper mattis, nibh erat vestibulum massa, in congue lectus est a metus. Vestibulum gravida ultrices ante nec tempor. Integer vitae elit a neque hendrerit euismod. Nam id imperdiet risus. Nam vitae placerat orci. Donec metus justo, facilisis vel sagittis at, elementum vitae arcu. Aenean tincidunt, nunc non rutrum euismod, tortor augue euismod enim, sed malesuada magna dui a eros. Ut placerat enim eu imperdiet ornare. Integer at faucibus magna.
      </p1>
      </div>
      <div class="col-md-1 list-group"></div>
      <div class="col-md-8 list-group"  style = "text-align:center">
      <h1>Recent Activity</h1><br>

      <p1> User compled a quiz and scored 100%</p1><hr>
      <p1> User created a question for a subject</p1><hr>
      <p1> User's deck is now ranked 3rd in it's subject</p1><hr>
      <p1> AnotherUser commpled User's quiz</p1><hr>
      <p1> User created a quiz in a subject%</p1><hr>
    </div>
  </div>
<?php pageFoot(); ?>
