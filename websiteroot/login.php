<?php include '../application/app.php';
  pageInit();
  connectDB();
  
  if(isset($_POST['user'])&&isset($_POST['password'])){
    $user = strtolower($_POST['user']);
	  $password = $_POST['password'];
	  doLogin($user, $password);
  }
  print_r($_SESSION);
  disconnectDB();
?>
