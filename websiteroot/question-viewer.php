<?php include '../application/app.php'; ?>
<?php pageInit(); ?>
<?php pageHead(); ?>

<div class="container">  
      <div class="page-header">
      <h3>Quiz #15</h3>
      </div> 
      <div class="flipcard">
        <div class="q-no">Question #1<hr></div>
        <div class="q-text">What is the capital city of Germany?</div>
        <div class="answers">
          <form action="submit-answer.php" method="POST">
            <input type="radio" name="answer">London</input><br>
            <input type="radio" name="answer">Berlin</input><br>
            <input type="radio" name="answer">New York</input><br>
            <input type="radio" name="answer">Cupcake</input><br>
            <input type="submit" name="submit" class="btn btn-primary btn-lg pull-right"></input>
          </form>
        </div>
      </div>
</div>
<script type="text/javascript">
  colours = [
    {name: 'green', color:'#dcffd1', border:'#90ee90'},
    {name: 'pink', color:'#ffd1dc', border:'#ff85a2'},
    {name: 'yellow', color:'#fdfd96', border:'#fefec8'},
    {name: 'blue', color:'#d4ebf2', border:'#86c5da'},
    {name: 'orange', color:'#ffd394', border:'#ffb347'},
    {name: 'purple', color:'#cabbcb', border:'#9c819f'},
    {name: 'gray', color:'#c6c6c6', border:'#adadad'}
  ];
</script>
<?php pageFoot(); ?>

