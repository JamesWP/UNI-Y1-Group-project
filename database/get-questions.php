<?php

include '../application/app.php';

function getNextQuestion($quizID) {
  global $con;
  $result = mysqli_query($con, "SELECT deckID FROM `Quiz` WHERE quizID = '$quizID'");
  $temp = mysqli_fetch_assoc($result);
  $deckID = $temp['deckID'];

  if (mysqli_num_rows($result) != 0) {
    $result = mysqli_query($con, "SELECT 1 FROM `Quiz` WHERE quizID = '$quizID' AND questionsLeft > 0");
    if(mysqli_num_rows($result) == 0) {
      return "done";
    }else{
      $result = mysqli_query($con, "SELECT q.questionID, q.data, q.difficulty FROM `Question` as q 
                                    JOIN `Result` as r on r.questionID = q.questionID
                                    WHERE q.deckID = '$deckID' AND q.questionID NOT IN
                                    (SELECT r.questionID FROM `Result` as r WHERE r.quizID = '$quizID')
                                    ORDER BY RAND() LIMIT 1");
      $temp = mysqli_fetch_assoc($result);
    }
  }else{
    print_r(error_get_last());
  }
}
function saveQuestionResult($quizID, $result, $questionID){
  global $con;
  $result = mysqli_query($con, "SELECT quizID FROM `Quiz` WHERE quizID = '$quizID'");
  $question = mysqli_query($con, "SELECT 1 FROM `Question` WHERE questionID = '$questionID'");

  if(mysqli_num_rows($result) =! 0 && ($result == 0 || $result == 1) && $question){
    mysqli_query($con, "INSERT INTO `Result` (quizID, correct, questionID)
                                     VALUES ('$quizID', '$result', '$questionID')");
    mysqli_query($con, "UPDATE `Quiz` SET questionsLeft = questionsLeft-1
                        WHERE quizID = '$quizID'");
  }else{
    print_r(error_get_last());
  }
}

function getResults($quizID){
  // for the given quiz id find all results and return an array with for each question attempted...
  // - if the question was answered correctly 
  // - the question title ie the question number 'Question 1','Question 2'...
  // - the json for the question

  // also return the total number of questions answered correctly

  // so you should return an array / object

  // o['numcorrect'] = 10;
  // o['questions'] = array(); this should be all questions as dictated above
  

}
/*
*/
connectDB();

disconnectDB();
