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
    $answersDiv = $('<div>').addClass("answers");
    switch(this.data.type){
      case "multiplechoice":
        $.each(this.data.answers,function(answer){
          $answer = $("<div>").addClass("answer");
          $answer.text(this.text);
          $answer.data(Question.answerDataTag,answer);
          $answersDiv.append($answer);
        });
        break;
    }
    this.$questionEl.append($answersDiv);
};
Question.prototype.getQuestionEl = function (){ return this.$questionEl};

var QuestionTemplateManager = function(templateID){
  this.questionTemplate = Handlebars.compile($('#'+templateID).html());
}
QuestionTemplateManager.prototype.loadModel = function(model){
  return new Question($(this.questionTemplate(model)),model);
}
