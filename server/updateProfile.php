<?php 

include "crud.php";

$control = new database();
$completename = $control->security($_POST['complete-name']);
$password = $control->security($_POST['password']);
$control->update_profile($completename,$password);

?>