<?php
include "crud.php";

$control  = new database();
$departur = $control->security($_POST['departur']);
$return = $control->security($_POST['return']);
$date_go = $control->security($_POST['date-go']);
$ticket_options = $control->security($_POST['ticket-options']);
$date_back = $control->security($_POST['date-back']);

echo $control->selectData($departur,$return,$date_go);
?>