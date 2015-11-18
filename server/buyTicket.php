<?php 
include "crud.php";
$control = new database();

$id_ticket=$control->security($_POST['id_ticket']);
$username =$control->security($_POST['username']);
echo $control->buyTicket($id_ticket,$username);

?>