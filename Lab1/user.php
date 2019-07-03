<?php
include "Crud.php";
include "authenticator.php";
/**
 * 
 */
class User implements Crud, Authenticator 
{
	private $user_id;
	private $first_name;
	private $last_name;
	private $city_name;
	private $username;
    private $password;
    private $file;
    private $utc_timestamp;
    private $offset;

	function __construct($first_name, $last_name, $city_name, $username, $password, $file, $utc_timestamp, $offset)
	{
		$this->first_name=$first_name;
		$this->last_name=$last_name;
		$this->city_name=$city_name;
		$this->username = $username;
		$this->password = $password;
		$this->file=$file;
		$this->utc_timestamp = $utc_timestamp;
        $this->offset = $offset;
	}
	public static function create(){
			$instance = new self();
			return $instance;
	}
	public function setUsername($username){
			$this->username = $username;
	}

	public function getUsername(){
			return $this->username;
	}

	public function setPassword($password){
			$this->username = $username;
	}

	public function getPassword(){
			return $this->password;
	}
	public function setUserId($user_id){
		$this->user_id=$user_id;
	}
	public function getUserId(){
		return $this->user_id;
	}
	public function settimestamp($timestamp){
            $this->utc_timestamp = $timestamp;
    }
    public function gettimestamp(){
            return $this->utc_timestamp;
    }
	public function save($conn){
		$fn=$this->first_name;
		$ln=$this->last_name;
		$city=$this->city_name;
		$uname = $this->username;
		$this->hashPassword();
		$pass = $this->password;
		$upload ="uploads/".basename($_FILES['fileToUpload']['name']);
		$timezone = $this->utc_timestamp;
        $offset = $this->offset;

		$res=mysqli_query($conn,"INSERT INTO user(first_name, last_name, user_city, username, password, file, timestamp_utc, time_zone_offset) VALUES('$fn', '$ln', '$city', '$uname', '$pass','$upload','$timezone','$offset')") or die("Error:" .mysqli_error($conn));
		return $res;
	}
	public function readAll($conn){
		$res=mysqli_query($conn,"SELECT * FROM user") or die("Error:" .mysqli_error($conn));
		return $res;
	}
	public function readUnique(){
		return null;
	}
	public function search(){
		return null;
	}
	public function update(){
		return null;
	}
	public function removeOne(){
		return null;
	}
	public function removeAll(){
		return null;
	}
	public function validateForm(){
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;

			if ($fn == "" || $ln == "" || $city == ""){
				return false;
			}
			return true;
		}

		public function createFormErrorSessions($warning){
			session_start();
			$_SESSION['form_errors'] = $warning;
		}

		public function hashPassword(){
			$this->password = password_hash($this->password, PASSWORD_DEFAULT);
		}

		public function isPasswordCorrect(){
			$this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die("Error: ".mysqli_error());
			mysqli_select_db($this->conn,DB_NAME);
			$found = false;
			$res = mysqli_query($this->conn,"SELECT * FROM user") or die("Error".mysqli_error());
			while ($row=mysqli_fetch_array($res)){
				if (password_verify($this->getPassword(), $row['password']) && $this->getUsername()==$row['username']){
					$found = true;
				}
			}

			mysqli_close($this->conn);
			return $found;
		}

		public function login(){
			if ($this->isPasswordCorrect()){
				header("Location:private_page.php");
			}
		}

		public function createUserSession(){
			session_start();
			$_SESSION['username'] = $this->getUsername();
		}

		public function logout(){
			session_start();
			unset($_SESSION['username']);
			session_destroy();
			header("Location:lab1.php");
		}

}
?>