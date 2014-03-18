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
<?php pageFoot(); ?>
