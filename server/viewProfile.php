<?php 

include "crud.php";
$control = new database();
$username = $control->security($_POST['username']);
echo $control->view_profile($username);

?>