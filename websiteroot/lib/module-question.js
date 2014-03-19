/**
 *  represents a question holds reference to the question el and the data
 *
 */
var Question = function(questionEl,questionData){
  this.data = questionData;
  this.$questionEl = questionEl;
  this.init();
};
Question.prototype.isCorrect = function(){
  return this.correct;
}
Question.answerDataTag = 'answer';
Question.prototype.init = function(){
    var question = this;
    var $answersDiv = $('<div>').addClass("list-group");
    switch(question.data.type){
      case "multiplechoice":
        $.each(question.data.answers,function(){
          var answer = this;
          var $answer = $("<a href='#'>").addClass("list-group-item");
          $answer.append('<span class="glyphicon glyphicon-chevron-right onlyActive"></span>');
          $answer.append('<span> '+answer.text+'</span>');
          $answer.data(Question.answerDataTag,answer);
          $answer.click(function(){
            $answersDiv.children().removeClass("active");
            $answer.addClass("active");
            question.correct = answer.correct;
          });
          $answersDiv.append($answer);
        });
        break;
      case "truefalse":
        var $trueAnswer = $("<div>").addClass("list-group-item")
          .append('<span class="glyphicon glyphicon-chevron-right onlyActive"></span>').append('<span>True</span>');
        var $falseAnswer = $("<div>").addClass("list-group-item")
          .append('<span class="glyphicon glyphicon-chevron-right onlyActive"></span>').append('<span>False</span>');
        var trueFalseClick = function(){
          $answersDiv.children().removeClass("active");
          $(this).addClass("active");
          question.correct = ( ($trueAnswer[0]==this) == question.data.answer );
        }
        $falseAnswer.click(trueFalseClick);
        $trueAnswer.click(trueFalseClick);
        $answersDiv.append($trueAnswer);
        $answersDiv.append($falseAnswer);
        break;
      case "blanks":
        var $input = $("<input>").addClass('form-control').attr("type","text");
        $input.keyup(function(){
          var answer = $(this).val();
          var curmindist = 99999;
          var correct = true;
          $.each(question.data.answers,function(){
            var dist = Question.editDistance(this.text,answer);
            curmindist = dist<curmindist?dist:curmindist;
            if(answer==this.text&&!this.correct){
              correct = false;
              return false;
            }
          });
          if(!correct)
            question.correct = false;
          else
            question.correct = curmindist<=question.data.editdistance;
        });
        $listItem = $('<div>').addClass('list-group-item').addClass('active');
        $listItem
            .append(
                $('<form>')
                .addClass('form-horizontal')
                .append(
                    $('<div>')
                    .addClass('form-group')
                        .append(
                            $('<label>')
                            .addClass('col-sm-1 control-label')
                            .append($('<span>').addClass('glyphicon glyphicon-chevron-right onlyActive'))
                        )
                        .append($('<div>').addClass('col-sm-11').append($input))
                )
            );

        $answersDiv.append($listItem);

        break;
      default:
        throw new Error("type not recognised");
    }

    this.$questionEl.find('.questionTitle').append($answersDiv);
};
Question.prototype.getQuestionEl = function (){ return this.$questionEl};
var QuestionTemplateManager = function(templateID){
  this.questionTemplate = Handlebars.compile($('#'+templateID).html());
}
Question.editDistance = function(s,t){
  if (!s.length) return t.length;
  if (!t.length) return s.length;

  return Math.min(
    Question.editDistance(s.substr(1), t) + 1,
    Question.editDistance(t.substr(1), s) + 1,
    Question.editDistance(s.substr(1), t.substr(1)) + (s[0] !== t[0] ? 1 : 0)
  );
}
QuestionTemplateManager.prototype.loadModel = function(model){
  return new Question($(this.questionTemplate(model)),model);
}
