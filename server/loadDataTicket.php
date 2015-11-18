<?php 

include "crud.php";
$control = new database();

$username = $control->security($_POST['username']);

echo $control->manage_order($username);

?>