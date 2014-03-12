<?php
	session_save_path("sessions/");
	session_destroy();
	header("Location: ../design/index.php");
?>