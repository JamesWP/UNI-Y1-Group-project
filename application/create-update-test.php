<?php
  include '../application/app.php';
  
  pageInit();

  connectDB();

  $userID = 1;
  $json = '{
  "text":"Minecraft was created by Jeb.",
  "answer":false,
  "type":"truefalse"
}';
  $difficulty = 4;
  $deckID = 2;

  createQuestion($userID, $deckID, $json, $difficulty);

  disconnectDB();
?>

