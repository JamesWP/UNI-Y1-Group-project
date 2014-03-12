<!DOCTYPE html>

<html>
  <head>
    <title>Flipup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="style/main.css" rel='stylesheet' media=screen />
  <style>
  #f1_container {
  position: relative;
  margin: 10px auto;
  width: 450px;
  height: 281px;
  z-index: 1;
  }
  #f1_container {
  -webkit-perspective: 1000px;
  -moz-perspective: 1000px;
  -o-perspective: 1000px;
  perspective: 1000px;
  }
  #f1_card {
  width: 100%;
  height: 100%;
  -webkit-transform-style: preserve-3d;
  -webkit-transition: all 0.5s linear;
  -moz-transform-style: preserve-3d;
  -moz-transition: all 0.5s linear;
  -o-transform-style: preserve-3d;
  -o-transition: all 0.5s linear;
  transform-style: preserve-3d;
  transition: all 0.5s linear;
  }
  #f1_container:hover #f1_card, #f1_container.hover_effect #f1_card {
  -webkit-transform: rotateX(180deg);
  -moz-transform: rotateX(180deg);
  -o-transform: rotateX(180deg);
  transform: rotateX(180deg);
}
  .face {
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -o-backface-visibility: hidden;
    backface-visibility: hidden;
  }
  .face.back {
   display: block;
  -webkit-transform: rotateX(180deg);
  -webkit-box-sizing: border-box;
  -moz-transform: rotateX(180deg);
  -moz-box-sizing: border-box;
  -o-transform: rotateX(180deg);
  -o-box-sizing: border-box;
  transform: rotateX(180deg);
  box-sizing: border-box;
  padding: 10px;
  text-align: center;
  }
  </style>
</head>


  <body>
    <div id=wrap>
      <div class="navbar navbar-default" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"> <img class="img-responsive" style="margin-top:-12px;" src="images/flipup_logo.png"/> </a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

              <li><a href="#about">Subjects</a></li>
              <li><a href="#contact">Create your own</a></li>
            </ul>
			<ul class="nav navbar-nav navbar-right">
          <li><a href="login_page.html">Sign Up</a></li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 15px;">
              <!-- Login form here -->
				<form action="[YOUR ACTION]" method="post" accept-charset="UTF-8">
				<input id="user_username" style="margin-bottom: 15px;" type="text" name="user[username]" placeholder="Username" size="30" />
				<input id="user_password" style="margin-bottom: 15px;" type="password" name="user[password]" placeholder="Password" size="30" />
				<input id="user_remember_me" style="float: left; margin-right: 10px;" type="checkbox" name="user[remember_me]" value="1" />
				<label class="string optional" for="user_remember_me"> Remember me</label>
				<input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" name="commit" value="Sign In" />
				</form>
			  </div>
          </li>
        </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div> 
      <div class="container">
        <!-- Im adding code here!-->
        <div id="f1_container">
          <div id="f1_card" class="shadow">
            <div class="front face">
              <div class="jumbotron">
                <h1 class="text-center"> Question Text Here!</h1>
                <p class = "text-center">This is where either a dropdown menu goes or a text entry!</p>      

                <p><a href="#" class="btn btn-primary btn-lg" role="button">Submit Answer</a></p>
              </div>
            </div>
            <div class="back face center">
              <div class="jumbotron">
                <h1 class="text-center"> You were (In)Correct!</h1>
                <p class = "text-center">The answer is blablabla! You answered blabla!</p>      
              </div>
            </div>
          </div>
        </div>
        <!--Not adding any more code outside of this! -->
      </div>
    </div>
    <div id="footer">
      <div class=container>
        <small>flipup &copy; 2014</small> 
      </div>
    </div>
    <script src="lib/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>