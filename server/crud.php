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
		$sql = mysqli_query($this->connect,"SELECT `username`,`password` FROM `profile` where `username`='$username' and `password`='$password'") or die(mysqli_error());
		if(mysqli_num_rows($sql)>0){
			return "success";
		}else{
			return "failed";
		}
	}
	public function buyTicket($id_ticket,$username){
		return $this->check_boolean(mysqli_query($this->connect,"INSERT INTO `order_ticket`(`profile_id_profile`, `ticket_id_ticket`) VALUES ((select `id_profile` from `profile` where `username`='$username'),'$id_ticket')") or die(mysqli_error()));
	}
	public function selectData($departur,$return, $date_go){
		$sql = mysqli_query($this->connect,"SELECT * FROM `ticket` WHERE `route_depar_ticket`='$departur' and `route_return_ticket`='$return' and `date_ticket`='$date_go'") or die(mysqli_error());
		$data = array();
		if(mysqli_num_rows($sql)>0){
			while ($rows=mysqli_fetch_array($sql)) {
				$data[] = $rows;
			}
			return json_encode($data);
		}else{
			return "failed";
		}
	}
	public function security($param){
		return htmlentities(htmlspecialchars(stripslashes($param)));
	}
	public function insert_data($judul,$maskapai,$harga){
		return $this->check_boolean(mysqli_query($this->connect,"INSERT INTO "));
	}
	public function view_profile($username){
		$obj = array();
		$sql = mysqli_query($this->connect,"SELECT username,email,password,complete_name FROM profile WHERE username='$username'") or die(mysqli_error());
		if(mysqli_num_rows($sql)>0){
			while ($rows=mysqli_fetch_array($sql)) {
				$obj[]=$rows;
			}
			return json_encode($obj);
		}else{
			return "failed";
		}

	}
	public function update_profile($username, $password,$completename){
		return $this->check_boolean(mysqli_query($this->connect,"UPDATE `profile` SET `complete_name`='$completename',`password`='$password' WHERE `username`='$username'") or die(mysqli_error()));
	}
	public function manage_order($username){
		$sql = mysqli_query($this->connect,"SELECT id_ticket,id_profile,id_order_ticket, username, price_ticket, maskapai, date_ticket FROM order_ticket,profile,ticket WHERE profile.id_profile=order_ticket.profile_id_profile and ticket.id_ticket=order_ticket.ticket_id_ticket and profile.username='$username'") or die(mysqli_error());
		if(mysqli_num_rows($sql)>0){
			$data =array();
			while($rows=mysqli_fetch_array($sql)){
				$data[]=$rows;
			}
			return json_encode($data);
		}else{
			return "failed";
		}
	}
	function __destruct(){
		mysqli_close($this->connect);
	}
}
?>