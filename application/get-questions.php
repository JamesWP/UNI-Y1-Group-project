<?php

function createQuiz($userID, $deckID)
{
    global $con;
    mysqli_query($con, "INSERT INTO `Quiz` (userID, deckID)
                      VALUES ('$userID', '$deckID')");
    $result = mysqli_query($con, "SELECT MAX(quizID) as lastID FROM `Quiz`
                                WHERE userID = '$userID'");
    $array = mysqli_fetch_assoc($result);
    return $array['lastID'];
} // createQuiz

function getNextQuestion($quizID)
{
    global $con;
    $result = mysqli_query($con, "SELECT deckID FROM `Quiz` WHERE quizID = '$quizID'");
    $temp = mysqli_fetch_assoc($result);
    $deckID = $temp['deckID'];

    if (mysqli_num_rows($result) != 0) {
        $result = mysqli_query($con, "SELECT 1 FROM `Quiz` WHERE quizID = '$quizID' AND questionsLeft > 0");
        if (mysqli_num_rows($result) == 0) {
            return false;
        } else {
            $result = mysqli_query($con, "SELECT q.questionID, q.data, q.difficulty FROM Question as q
                                    WHERE q.deckID = '$deckID' AND q.questionID NOT IN
                                    (SELECT r.questionID FROM Result as r WHERE r.quizID = '$quizID')
                                    ORDER BY RAND() LIMIT 1");
            $result2 = mysqli_query($con, "select count(questionID)+1 as questionNo from Result where quizID = $quizID");
            if (mysqli_num_rows($result) == 0) {
                return false;
            } else {
                $question = mysqli_fetch_assoc($result);
                $quiz = mysqli_fetch_assoc($result2);
                return array('questionID' => $question['questionID'], 'json' => $question['data'], 'questionNo' => $quiz['questionNo']);
            }
        }
    } else {
        print_r(error_get_last());
    }
}

function saveQuestionResult($quizID, $correct, $questionID)
{
    global $con;
    $result = mysqli_query($con, "SELECT quizID FROM `Quiz` WHERE quizID = '$quizID'");
    $question = mysqli_query($con, "SELECT 1 FROM `Question` WHERE questionID = '$questionID'");

    if (mysqli_num_rows($result) == 1
        && ($correct == 0 || $correct == 1)
        && mysqli_num_rows($question) == 1
    ) {
        mysqli_query($con, "INSERT INTO Result (quizID, correct, questionID)
                                     VALUES ($quizID, $correct, $questionID)");
        mysqli_query($con, "UPDATE `Quiz` SET questionsLeft = questionsLeft-1
                        WHERE quizID = '$quizID'");
    } else {
        print_r(mysqli_error($con));
    }
}

function getQuestion($id)
{
    global $con;
    $result = mysqli_query($con, "SELECT data FROM Question WHERE questionID = '$id'");
    $temp = mysqli_fetch_assoc($result);
    $question = $temp['data'];
    return $question;
}


function getQuestions($deckID){
  global $con;
  $result = mysqli_query($con,"select data ,questionID from Question where deckID = $deckID");
  $questions = array();
  while($row = mysqli_fetch_assoc($result)){
    $json = json_decode($row['data']);
    $row['text'] = $json->text;
    $questions[] = $row;
  }
  return $questions;
}
function getDeckInfo($deckID){
  global $con;
  $result = mysqli_query($con,"select
       d.name as deckName, s.name as subjectName
      from Deck d
      join Subject s on s.subjectID = d.subjectID
      where d.deckID = $deckID");
  return mysqli_fetch_assoc($result);
}

function createQuestion($userID, $deckID, $data, $difficulty = 3)
{
    global $con;
    $result = mysqli_query($con, "INSERT INTO `Question` (deckID, userID, data, difficulty)
                      VALUES('$deckID', '$userID', '$data', '$difficulty')");
    return $result != false;
}

function updateQuestion($questionID, $data)
{
    global $con;
    $result = mysqli_query($con, "UPDATE `Question` SET data = '$data'
                      WHERE questionID = '$questionID'");
    return $result != false;
}

//function json_decode($obj){
//return array('text' => 'test');
//}

function getResults($quizID)
{
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
    mysqli_multi_query($con, $sql);
    mysqli_next_result($con);
    $result = mysqli_use_result($con);
    $questions = array();
    while ($question = mysqli_fetch_assoc($result)) {
        $question['text'] = json_decode($question['data'])->text;
        $question['correct'] = $question['correct'] == 'true';
        $questions[] = $question;
    }
    $result = mysqli_query($con, "SELECT count(1) AS correct FROM Result WHERE quizid = $quizID AND correct = 1");
    $tmp = mysqli_fetch_assoc($result);
    $correct = $tmp['correct'];

    return array("questions" => $questions, "correct" => $correct);
}

function addQuestionRating($questionID, $quizID, $rating)
{
    $ratingAverage = 5;
    global $con;
    // if question is in the given quiz
    if (mysqli_num_rows(mysqli_query($con, "SELECT 1 FROM Result
                                         WHERE questionID = $questionID
                                         AND quizID = $quizID LIMIT 1")) == 1
    ) {
        // add the rating to the rating table
        mysqli_query($con, "insert into Rating (questionID,rating) values($questionID,$rating)");


        mysqli_multi_query($con, <<<SQL
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

function getQuiz($quizID){
  global $con;
  $result = mysqli_query($con,"select sum(1) as correct from Result where quizID = $$quizID");
  return mysqli_fetch_assoc($result);
}

function getOtherUsersScore($quizID){
  global $con;
  $sql = <<<SQL
SELECT r.quizID,u.name as user,sum(r.correct) as score
FROM `Result` r
join Quiz q on q.quizID = r.quizID
join User u on u.userID = q.userID
where q.deckID =
	(select q2.deckID from Quiz q2 where q2.quizID = $quizID)
group by r.quizID,u.name,q.startedOn
order by sum(r.correct) desc,q.startedOn desc

SQL;
  $result = mysqli_query($con,$sql);
  $res = array();
  while($row = mysqli_fetch_assoc($result))
    $res[] = $row;
  return $res;
}

