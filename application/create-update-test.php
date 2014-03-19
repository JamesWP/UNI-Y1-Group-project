<?php
  include '../application/app.php';
  
  pageInit();

  connectDB();

  $userID = 1;
  $json = "james is a peach";
  $difficulty = 4;
  $deckID = 2;

  updateQuestion(27, $json);

  disconnectDB();
?>

