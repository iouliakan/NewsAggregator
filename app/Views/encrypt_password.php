
<!-- I manually enter the admin password after executing this code. -->

<?php

$password = '12345678';

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;


 ?>           

