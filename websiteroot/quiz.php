<?php include '../application/app.php'; ?>
<?php pageInit(); ?>


<?php pageHead(array('style/quiz.css')); ?>
  <div class="container">
    <h1>It's quiz time!</h1>
    <div class="row">
      <div class="col-md-8 col-md-offset-2 bg-success questionCont">
        <h3><span class="label label-success">Q1:</span></h3>
        <div class="panel panel-default">
          <div class="panel-body">
            <h3>Question text ... goes here ... </h3>
          </div>
          <div class="list-group">
            <div class="list-group-item active">
              <form class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-1 control-label">
                    <span class="glyphicon glyphicon-chevron-right onlyActive"></span>
                  </label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" />
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="list-group">
            <div class="list-group-item">
              <span class="glyphicon glyphicon-chevron-right onlyActive"></span>
              Answer 1
            </div>
            <div class="list-group-item">
              <span class="glyphicon glyphicon-chevron-right onlyActive"></span>
              Answer 2
            </div>
            <div class="list-group-item">
              <span class="glyphicon glyphicon-chevron-right onlyActive"></span>
              Answer 3
            </div>
            <div class="list-group-item">
              <span class="glyphicon glyphicon-chevron-right onlyActive"></span>
              Answer 4
            </div>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-3 col-md-offset-9">
                <button type="button" class="btn btn-success btn-lg btn-block">Flip! <span class="glyphicon glyphicon-random"></span></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $('.questionCont .list-group-item').click(function(){
      $selectedItem = $(this);
      $allItems = $('.questionCont .list-group-item.active').removeClass('active');
      $selectedItem.addClass('active');
    });
  </script>
  <script type="text/javascript">
    colours = [
      {name: 'green', color:'#beffaa', border:'#90ee90', active:'#5cb85c'},
      {name: 'pink', color:'#ffd1dc', border:'#ff85a2', active:'#ff9eb5'},
      {name: 'yellow', color:'#fdfdaf', border:'#fefec8', active:'#fdfd7d'},
      {name: 'blue', color:'#d4ebf2', border:'#86c5da', active:'#99d0e0'},
      {name: 'orange', color:'#ffddae', border:'#ffb347', active:'#ffc97b'},
      {name: 'purple', color:'#cabbcb', border:'#9c819f', active:'#9c819f'},
      {name: 'gray', color:'#c6c6c6', border:'#adadad', active:'#adadad'}
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
</script>
<?php pageFoot(); ?>
