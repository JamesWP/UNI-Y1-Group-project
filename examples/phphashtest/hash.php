<?php
$password_verify = '$2y$10$X0xE6vPq4T2ZabM.AptNxuhE7BNPci0LjO4da46DCrl.jJcETx8Am';
// echo password_verify("rasmuslerdorf", $password_verify);
echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
?>