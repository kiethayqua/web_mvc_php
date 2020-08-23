<?php 
/**
 * AdminLogin Class
 */
require '../lib/database.php';
require '../lib/session.php';
require '../helpers/format.php';

// start Session
// kiem tra co ton tai thai thai dang nhap cua admin chua
// neu da ton tai chuyen ve trang index cua admin
Session::checkLogin();
class AdminLogin
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function login_admin($adminUser, $adminPass)
	{
		// Kiem tra input hop le chua ?
		$adminUser = $this->fm->validation($adminUser);
		$adminPass = $this->fm->validation($adminPass);

		// Chi dinh dung 2 bien nay ket noi den csdl
		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

		if(empty($adminUser) || empty($adminPass))
		{
			$alert = "User and Password must be not empty";
			return $alert;
		}else
		{
			$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
			$result = $this->db->select($query);

			if($result != false)
			{
				$value = $result->fetch_assoc();
				// set trang thai dang nhap cua admin la true
				// phien dang nhap sau Session se kiem tra
				// dieu huong truc tiep den trang index cua admin
				Session::set('adminlogin', true);
				Session::set('adminId', $value['adminid']);
				Session::set('adminName', $value['adminName']);
				Session::set('adminUser', $value['adminUser']);
				header("Location:index.php");
			}else
			{
				$alert = "User and Pass not match";
				return $alert;
			}
		}
	}
}
?>