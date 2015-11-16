<?php
class database{
	private $connect=null;
	function __construct(){
		$this->connect = mysqli_connect("localhost","root","","batiket_db") or die(mysqli_error());
	}
	public function result_client($param){
		
	}
	private function check_boolean($param){
		if($param){
			return true;
		}else{
			return false;
		}
	}
	public function insertData($email,$username,$password,$confirm_code){
		return $this->check_boolean(mysqli_query($this->connect,"INSERT INTO `profile`(`username`, `email`, `password`, `confirm_code`, `date_reg`) VALUES ('$username','$email','$password','$confirm_code',current_timestamp())") or die(mysqli_error()));
	}
	public function login($username,$password){
		$sql = mysqli_query($this->connect,"SELECT * FROM `profile` where `username`='$username' and `password`='$password'") or die(mysqli_error());
		if(mysqli_num_rows($sql)>0){
			return true;
		}else{
			return false;
		}
	}
	function selectData($departur,$return, $date_go){
		$sql = mysqli_query($this->connect,"SELECT * FROM `ticket` WHERE `route_depar_ticket`='$departur' and `route_return_ticket`='$return' and `date_ticket`='$date_go'") or die(mysqli_error());
		$data = array();
		if(mysqli_num_rows($sql)>0){
			while ($rows=mysqli_fetch_array($sql)) {
				$data[] = $rows;
			}
			return json_encode($data);
		}else{
			return "data not found";
		}
	}
	public function security($param){
		return htmlentities(htmlspecialchars(stripslashes($param)));
	}
	public function insert_data($judul,$maskapai,$harga){
		return $this->check_boolean(mysqli_query($this->connect,"INSERT INTO "));
	}
	function __destruct(){
		mysqli_close($this->connect);
	}
}
?>