<!DOCTYPE html>
<html>
  <head>
    <title>Flipup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="style/main.css" rel='stylesheet' media=screen />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php foreach($css as $link){ ?>      
      <link href="<?php echo $link; ?>" rel='stylesheet' media=screen />
    <?php } ?>
    <script src="lib/jquery.min.js"></script>
  </head>
  <body>
    <div id="wrap">
      <div class="navbar navbar-default" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo getBaseUrl(); ?>index.php"> <img class="img-responsive" style="margin-top:-12px;" src="images/smallLogo.gif" height="43" width="150"/> </a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

              <li><a href="<?php echo getBaseUrl(); ?>">Subjects</a></li>
              <li><a href="<?php echo getBaseUrl(); ?>result.php">Result</a></li>
              <li><a href="<?php echo getBaseUrl(); ?>create-your-own.php">Create your own</a></li>
            </ul>
            <?php if ($_SESSION["loggedin"] != 1):?>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo getBaseUrl(); ?>signup-page.php">Sign Up</a></li>
              <li class="divider-vertical"></li>
              <li class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
                <div class="dropdown-menu" style="padding: 15px; padding-bottom: 15px;">
                  <!-- Login form here -->
                  <form action="<?php echo getBaseUrl();?>login.php" method="post" accept-charset="UTF-8">
                    <input id="user" style="margin-bottom: 15px;" type="text" name="user" placeholder="Username" size="30" />
                    <input id="password" style="margin-bottom: 15px;" type="password" name="password" placeholder="Password" size="30" />
                    <input id="user_remember_me" style="float: left; margin-right: 10px;" type="checkbox" name="remember" value="1" />
                    <label class="string optional" for="user_remember_me"> Remember me</label>
                    <input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" name="commit" value="Sign In" />
                  </form>
                </div>
              </li>
            </ul>
            <?php else: ?> 
            <ul class="nav navbar-nav navbar-right">
              <li>Welcome, <?php echo $_SESSION["user"];?></li>
              <li><a href="<?php echo getBaseUrl();?>logout.php">Sign out</a></li>
              <li class="divider-vertical"></li>  
            </ul>
            <?php endif; ?>
          </div><!--/.nav-collapse -->
        </div>
      </div> 
