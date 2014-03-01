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
  return false; 
}
Question.answerDataTag = 'answer';
Question.prototype.init = function(){
    var question = this;
    var $answersDiv = $('<div>').addClass("answers");
    switch(question.data.type){
      case "multiplechoice":
        $.each(question.data.answers,function(){
          var answer = this;
          var $answer = $("<div>").addClass("answer");
          $answer.text(answer.text);
          $answer.data(Question.answerDataTag,answer);
          $answer.click(function(){
            $answersDiv.children().removeClass("selected");
            $answer.addClass("selected");
            question.correct = answer.correct;
          });
          $answersDiv.append($answer);
        });
        break;
      case "truefalse":
        var $trueAnswer = $("<div>").addClass("answer").text("True");
        var $falseAnswer = $("<div>").addClass("answer").text("False");
        var trueFalseClick = function(){
          $answersDiv.children().removeClass("selected");
          $(this).addClass("selected");
          question.correct = ( ($trueAnswer[0]==this) == question.data.answer );            
        }
        $falseAnswer.click(trueFalseClick);
        $trueAnswer.click(trueFalseClick);
        $answersDiv.append($trueAnswer);
        $answersDiv.append($falseAnswer);
        break;
      case "blanks":
        var $input = $("<input>").attr("type","text"); 
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
        $answersDiv.append($input);
        break;
      default:
        throw new Error("type not recognised");
    }
    this.$questionEl.append($answersDiv);
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
