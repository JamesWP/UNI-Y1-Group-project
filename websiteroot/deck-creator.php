<?php include '../application/app.php'; ?>
<?php pageInit(); ?>

<?php pageHead(); ?>
<div class="container">
  <div class="jumbotron"> 
    <div class="row">
      <div class="col-lg-12">
        <h1 class="text-center"><font color="#428BCA">Create A Deck</font></h1>
        <p>
          <div class="input-group">
            <span class="input-group-addon">Deck Name:</span>
            <input type="text" class="form-control" placeholder="Deck Name">
          </div>
        </p>
        <p>
          <div class="input-group">
            <span class="input-group-addon">Subject:</span>
            <select class="form-control">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </p>
        <p>
          <a class="btn-lg btn-primary pull-right" href="help.html" role="button">Create Deck &raquo;</a></p>
        </p>
      </div>
    </div>
  </div>
</div>
<?php pageFoot(); ?>