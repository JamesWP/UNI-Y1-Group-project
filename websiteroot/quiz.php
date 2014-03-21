<?php include '../application/app.php'; ?>
<?php pageInit();


if (!isset($_GET['deckID'])) {
    die('you must provide a deck');
}

$deckID = intval($_GET['deckID']);
$userID = isset($_SESSION['userID'])?$_SESSION['userID']:-1;

connectDB();
if (!isset($_SESSION['quizID'])
    || (isset($_SESSION['lastdeckID']) && $_SESSION['lastdeckID'] != $deckID)
) {
    // new quiz needs creating
    $_SESSION['quizID'] = $quizID = createQuiz($userID, $deckID);
    $_SESSION['lastdeckID'] = $deckID;
} else {
    $quizID = $_SESSION['quizID'];
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'save') {
        $correct = $_POST['correct'] == 'true' ? 1 : 0;
        $questionID = $_SESSION['lastQuestion'];
        saveQuestionResult($quizID, $correct, $questionID);
        echo '{"success":true}';
        disconnectDB();
        die();
    } else if ($_POST['action'] == 'next') {
        $question = getNextQuestion($quizID);
        if (!$question) {
            // no more quesitons left
            echo '{"success":"true","finished":true}';
        } else {
            // return question to user
            $json = $question['json'];
            $questionNumber = $question['questionNo'];
            $questionID = $question['questionID'];
            $_SESSION['lastQuestion'] = $questionID;
            echo json_encode(array("finished" => false, "success" => true, "questionNo" => $questionNumber, "json" => $json));
        }
        disconnectDB();
        die();
    }
    die();
}
disconnectDB();
/*
if is save result then save result

if is get next question then get next question
*/


?>


<?php pageHead(array('style/quiz.css')); ?>
<div class="container">
    <h1>It's quiz time!</h1>

    <div class="row" id="question"></div>
</div>

<script id="question-template" type="text/x-handlebars-template">
    <div class="col-md-8 col-md-offset-2 bg-success questionCont">
        <h3><span class="label label-success">Q{{questionNo}}:</span></h3>

        <div class="panel panel-default">
            <div class="panel-body questionTitle">
                <h3>{{text}}</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 col-md-offset-9">
                        <button type="button" id="submit" class="btn btn-success btn-lg btn-block">Flip! <span
                            class="glyphicon glyphicon-random"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script>
    var question, questionTemplate;

    function getNextQuestion() {
        $.ajax({
            'type': 'POST',
            'url': window.location.href,
            'data': {'action': 'next'},
            'dataType': 'json'
        }).done(function (data) {
            if (!data.finished) {
                var questionJson = JSON.parse(data.json);
                questionJson.questionNo = data.questionNo;
                question = questionTemplate.loadModel(questionJson);
                $("#question").empty().append(question.getQuestionEl());
                applyColor();
            } else {
                window.location.href="<?php echo getBaseUrl().'result.php';?>";
            }
        }).error(function (err) {
            console.log(err.responseText);
        });
    }
    $(function () {
        questionTemplate = new QuestionTemplateManager('question-template');
        getNextQuestion();
    });

    $('#question').on('click', '#submit', function () {
        if (question.isCorrect()) {
            alert('Correct!');
        } else {
            alert('Oops, that was wrong :(');
        } 
        $.ajax({'type': 'POST', 'url': window.location.href, data: {'action': 'save', 'correct': question.isCorrect() ? 'true' : 'false'}, dataType: 'json'})
            .done(function () {
                getNextQuestion();
            }).error(function (err) {
                console.log(err);
                document.write(err.responseText);
            });
    });
</script>

<script type="text/javascript">
    function applyColor() {
        colours = [
            {name: 'green', color: '#beffaa', border: '#90ee90', active: '#5cb85c'},
            {name: 'pink', color: '#ffd1dc', border: '#ff85a2', active: '#ff9eb5'},
            {name: 'yellow', color: '#fdfdaf', border: '#fefec8', active: '#fdfd7d'},
            {name: 'blue', color: '#d4ebf2', border: '#86c5da', active: '#99d0e0'},
            {name: 'orange', color: '#ffddae', border: '#ffb347', active: '#ffc97b'},
            {name: 'purple', color: '#cabbcb', border: '#9c819f', active: '#9c819f'},
            {name: 'gray', color: '#c6c6c6', border: '#adadad', active: '#adadad'}
        ];

        var randomColour = colours[Math.floor(Math.random() * colours.length)];
        $(".questionCont").css("background", randomColour.color);
        $(".questionCont .active").css("background", randomColour.active);
        $(".questionCont .list-group-item").hover(
            function () {
                $(this).css("background", randomColour.active);
            },
            function () {
                $(this).not(".active").css("background", '#fff');
            }
        );
    }
    ;
</script>
<script>
<?php pageFoot(array('lib/handlebars-v1.3.0.js', 'lib/module-question.js')); ?>
