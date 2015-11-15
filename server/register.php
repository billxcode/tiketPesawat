<?php 
include "crud.php";

$control = new database();
$email = $control->security($_POST['email']);
$username = $control->security($_POST['username']);
$password = $control->security($_POST['password']);
$confirm_code = md5($email.$username.$password);
//$control->result_client($control->insertData($email,$username,$password,$confirm_code));

if($control->insertData($email,$username,$password,$confirm_code)){
			echo "success";
		}else{
			echo "failed";
		}
?>