<?php

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

  if(mysqli_num_rows($result) == 1 
      && ($result == 0 || $result == 1) 
      && mysqli_num_rows($question)==1){
    mysqli_query($con, "INSERT INTO `Result` (quizID, correct, questionID)
                                     VALUES ('$quizID', '$result', '$questionID')");
    mysqli_query($con, "UPDATE `Quiz` SET questionsLeft = questionsLeft-1
                        WHERE quizID = '$quizID'");
  }else{
    print_r(error_get_last());
  }
}

function getResults($quizID){
  global $con;
  $sql = " set @row = 0;
          SELECT 
             concat('Question ',@row:=@row+1) as title
            ,q.data as data
            ,q.questionID
            ,case when r.correct=1 then 'true' else 'false' end as correct
          from Result as r
          join Question as q on q.questionID = r.questionID
          where r.quizid = $quizID";
  mysqli_multi_query($con,$sql);
  mysqli_next_result($con);
  $result = mysqli_use_result($con);
  $questions = [];
  while($question = mysqli_fetch_assoc($result)){
    $question['text'] = json_decode($question['data'])->text;
    $question['correct'] = $question['correct']=='true';
    $questions[] = $question;
  }
  $result = mysqli_query($con,"select count(1) as correct from Result where quizid = $quizID and correct = 1");
  $tmp = mysqli_fetch_assoc($result);
  $correct = $tmp['correct'];

  return array("questions"=>$questions,"correct"=>$correct);
}
