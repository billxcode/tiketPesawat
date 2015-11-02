<?php
class database{
	private $connect=null;
	function __construct(){
		$this->connect = mysqli_connect("localhost","root","","tiketPesawat") or die(mysqli_error());
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
		$this->check_boolean(mysqli_query($this->connect,"INSERT INTO `RegLog`(`email`, `username`, `password`, `confirm_code`, `date_reglog`) VALUES ('$email','$username','$password','$confirm_code',current_timestamp())") or die(mysqli_error()));
	}
	public function login($username,$password){
		$sql = mysqli_query($this->connect,"SELECT * FROM `RegLog` where `username`='$username' and `password`='$password'") or die(mysqli_error());
		if(mysqli_num_rows($sql)>0){
			return true;
		}else{
			return false;
		}
	}
	function selectData(){
		
	}
	public function security($param){
		return htmlentities(htmlspecialchars(stripslashes($param)));
	}
	public function insert_data($judul,$maskapai,$harga){
		return $this->check_boolean(mysqli_query($this->connect,"INSERT INTO ");
	}
	function __destruct(){
		mysqli_close($this->connect);
	}
}
?>