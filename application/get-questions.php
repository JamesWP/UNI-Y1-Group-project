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

function getQuestion($id){
  global $con;
  $result = mysqli_query($con,"SELECT data FROM Question WHERE questionID = '$id'");
  $temp = mysqli_fetch_assoc($result);
  $question = $temp['data'];
  return $question;
}

function createQuestion($userID, $deckID,  $data, $difficulty = 3){
  global $con;
  mysqli_query($con, "INSERT INTO `Question` (deckID, userID, data, difficulty)
                      VALUES ('$deckID', '$userID', '$data', '$difficulty')");
}

function updateQuestion($questionID, $data){
  global $con;
  mysqli_query($con, "UPDATE `Question` SET data = '$data'
                      WHERE questionID = '$questionID'");
}
//function json_decode($obj){
//return array('text' => 'test');
//}

function getResults($quizID){
  global $con;
  $sql = "set @row = 0;
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
  $questions = array();
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

function addQuestionRating($questionID,$quizID,$rating){
  $ratingAverage = 5;
  global $con;
  // if question is in the given quiz
  if (mysqli_num_rows(mysqli_query($con,"select 1 from Result where questionID = $questionID and quizID = $quizID limit 1"))==1){
    // add the rating to the rating table
    mysqli_query($con,"insert into Rating (questionID,rating) values($questionID,$rating)");
    

    mysqli_multi_query($con,<<<SQL
      UPDATE Question q
      LEFT JOIN (
        SELECT questionID,avg(rating) AS rating
        FROM Rating 
        GROUP BY questionID
        HAVING count(rating)>=$ratingAverage
      ) r 
      ON r.questionID = q.questionID
      SET difficulty = r.rating;
      DELETE FROM Rating where questionID in (
        SELECT questionID FROM (
          SELECT questionID
          FROM Rating
          GROUP BY questionID
          HAVING count(rating)>=$ratingAverage
        ) as tmp
      )
SQL
    );
  }
}

function getNewDecks(){
  global $con;
  $result = mysqli_query($con,"select d.deckID,d.name from Deck d order by createdOn desc limit 10");
  while(($row = mysqli_fetch_assoc($result)))
    $rows[] = $row;
  return $rows;
}


