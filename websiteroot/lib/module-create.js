
  var init = function(){
    $('.ttooltip').tooltip();
    $('.questionTypeSelect').change();
  }
  /* setup for events */    
  $('.add-answer').click(function(){
    $this = $(this);
    $lastAnswer = $this.parent().parent().children(".answer").last()
    $lastAnswer.clone().insertAfter($lastAnswer);
  });
  $('.rem-answer').click(function(){
    $answers = $(this).parent().parent().children(".answer");
    if($answers.size()>1)
      $answers.last().remove()
  });
  $('.questionTypeSelect').change(function(){
    var type = $(this).val();
    $selected = $('.questionType[data-questionType="'+type+'"]');
    $others = $('.questionType').not($selected);
    $selected.show();
    $others.hide();
  });
  $('.save-btn').click(function(){
    try{
      json = JSON.stringify(getJson());
      questionID = $('.questionID').val()
      var req = $.ajax({
        type:'POST',
        url: window.location.href,
        data: {'save':true,'questionID':questionID,'json':json},
        dataType: 'json'
      });
      //window.location.href,{'save':true,'questionID':questionID,'json':json},"json");
      req.done(function(data){
        if(data.success){
          $('.save-error').hide();
          $('.save-success').removeClass("hidden").show();
          setTimeout(function(){
              window.location.href=returnUrl;
          },2000);
        }else{
          showError("could not save: " + data.message);
        }
      });
      req.fail(function(err) {console.log(err)});
    }catch(e){
      showError(e);
    }
  });

  var showError = function(e){
      $('.save-error .detail').text("" + e);
      $('.save-error').removeClass("hidden").show();
  }

  var getJson = function(){
    var obj = {};
    obj.text = $('.questionText').val();
    obj.type = $(".questionTypeSelect").val();
    if(obj.type==undefined){
      throw new Error("you must select a question type");
    }else if(obj.type=="truefalse"){
      var answer = $('.questionType[data-questiontype="truefalse"] select').val();
      if(answer=="true"||answer=="false")
        obj.answer = answer=="true";
      else
        throw new Error("you must select true or false"); 
    }else{
      $section = $('.questionType[data-questiontype="'+obj.type+'"]');
      $answers = $('.answer',$section);
      $editdistance = $section.find(".editDistance");
      if($editdistance.size() > 0){
        obj.editdistance = parseInt($editdistance.val());
        if(isNaN(obj.editdistance))
          throw new Error("you must provide a number for the editdistance");
      }
      obj.answers = $answers.map(function(){
        $this = $(this);
        var correct = $this.find("select").val();
        if (correct != "true" && correct != "false")
          throw new Error("you must select correct or incorrect for each answer");
        correct = correct == "true";
        var text = $this.find("input").val();
        if(text.length<1)
          throw new Error("you must enter text for each answer");
        return {
          text:text,
          correct:correct
        };
      }).get();
      if(obj.answers.length<1)
        throw new Error("you must have at least one answer")
      if(obj.text.length<1)
        throw new Error("you must enter a question")
    }
    return obj;
  }

  
  /* loader also tests saving for equality */
  var loadJson = function(obj){
    $('.questionText').val(obj.text);
    $('.questionTypeSelect').val(obj.type).change();
    if(obj.type=="truefalse"){
      $('.questionAnswer').val(""+obj.answer);
    }else{
      $section = $('.questionType[data-questiontype="'+obj.type+'"]');
      if(obj['editdistance']!=undefined)
        $section.find(".editDistance").val(obj.editdistance);
      $answers = $('.answer',$section);
      $answer = $answers.first().clone();
      $.each(obj.answers,function(){
        var answer = this;
        var $newanswer = $answer.clone();
        $newanswer.find("select").val("" + answer.correct);
        $newanswer.find("input").val(answer.text);
        $newanswer.insertAfter($answers);
      });
      $answers.remove();
    }
  }

  init();
