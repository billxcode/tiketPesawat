<?php 

include "crud.php";

$control = new database();
$username = $control->security($_POST['username']);
$password = $control->security($_POST['password']);
$completename = $control->security($_POST['completename']);
echo $control->update_profile($username,$password,$completename);

?>