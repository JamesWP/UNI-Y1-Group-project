<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php
  connectDB();
  $subjects = getSubjects();
  disconnectDB();
?>

<?php
  connectDB();
  global $con;

  $subjectName = $_GET['subject'];
  $deckName = $_GET['deckname'];

  if (isset($subjectName) && (isset($deckName))) {
      $subjectID = mysqli_query($con, "SELECT subjectID FROM `Subject` WHERE name = '$subjectName'");
     // $subjectID = $temp['subjectID'];
      $userID = $_SESSION['userID'];
      $date = date_create();
      $timestamp = date_format($date, 'U = Y-m-d H:i:s');
      mysqli_query($con, "INSERT INTO `Deck` (subjectID, name, userID, createdOn)
                          VALUES ('$subjectID', '$subjectName', '$userID', '$timestamp')");
    }
    else if (isset($subjectName)){  
      $noDeck = 1;
      header("location:deck-creator.php");
    }
  else if (isset($deckName)) {
    $noSubject = 1;
    header("location:deck-creator.php");
  }

  disconnectDB();
?>

<?php pageHead(); ?>
<div class="container">
  <?php if (isset($noSubject)) { ?>
    <div class="alert alert-danger">
      <strong>You need to choose a subject!</strong>
    </div>
  <?php } if (isset($noDeck)) { ?>
    <div class="alert alert-danger">
      <strong>The deck name cannot be empty!</strong>
    </div>
  <?php } ?>
  <div class="row">
    <div class="jumbotron col-md-6 col-md-offset-3"> 
      <h1 class="text-center"><font color="#428BCA">Create a Deck</font></h1>
      <p>
        <form method="get" action="deck-creator.php">
        <div class="input-group">
          <span class="input-group-addon" style="font-weight:bold">Deck Name:</span>
          <input type="text" class="form-control" placeholder="Deck Name" id="deckname" name="deckname">
        </div>
      </p>
      <p>
        <div class="input-group">
          <span class="input-group-addon" style="padding-left:36px; font-weight:bold">Subject:</span>
          <select class="form-control" id="subject" name="subject">
            <?php foreach ($subjects as $subject) { ?>
              <option><?php echo $subject["name"] ?></option>
            <?php } ?>
          </select>
        </div>
      </p>
      <p style="margin-top: 25px">
        <input type="submit" class="btn-lg btn-primary pull-right" href="help.html" role="button" value="Create Deck &raquo;"></p>
      </p>
      </form>
    </div>
  </div>
</div>
<?php pageFoot(); ?>