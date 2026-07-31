<?php
/* php and mysql connectivity class
	-- Mysqli-- 
*/
error_reporting(E_ERROR);
/*ob_start();*/
if (!isset($_SESSION)) { session_start(); }
date_default_timezone_set("Asia/Kolkata");

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');

class Database{
	private $_connection;
	private static $_instance; //The single instance
	/* Credentials now resolve from env var -> config.local.php -> legacy fallback (see config.php).
	   TODO(security): remove the fallback defaults once env vars are configured on the server. */
	private $_host;
	private $_database;
	private $_username;
	private $_password;
	
	//this function is called everytime this class is instantiated		
	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	// Constructor
	private function __construct() {
		$this->_host     = svr_config('SVR_DB_HOST', '82.25.121.160');
		$this->_database = svr_config('SVR_DB_NAME', 'u320743426_SVR');
		$this->_username = svr_config('SVR_DB_USER', 'u320743426_SVR');
		$this->_password = svr_config('SVR_DB_PASS', 'ez?Zcc4X9$');
		$this->_connection = new mysqli($this->_host, $this->_username,
			$this->_password, $this->_database);
	
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}

	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }

	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}
	
	/* Insert,Update Query Use Input Field Function */
	function setfilter($data){
		if (!empty($data) && isset($data)) {
			$con = $this->getConnection();
			$data = trim($data);
			$data = addslashes($data);
			$data = mysqli_real_escape_string($con,$data);
			return $data;
		}else{
			return null;
		}
	}
	
	/* Retrive data function */
	function getfilter($data){
		$con = $this->getConnection();
		$data = trim($data);
		$data =  stripslashes($data);
		$data = mysqli_real_escape_string($con,$data);
		return $data;
	}

	public function get_siteconfig() { 

		$sql_site_config = mysqli_query($this->getConnection(),"SELECT * FROM siteconfig");
		$data_set = mysqli_fetch_object($sql_site_config);
		return $data_set;
	}
	
	/* Desc: Sign In Customer Check Email Verify or Not Function 
		Added Doc: Santy, Date: 3-8-2021
	*/
	public function Check_EmailVerifyORNot($matriid=NULL) { 
		if(isset($matriid) && !empty($matriid)){
			$sql = mysqli_query($this->getConnection(),"Select count(*) as isnotverify from `emailverify` where 1 AND `emailverify`.`MatriID`= '".$matriid."' AND `emailverify`.`verification`='No'");
			$data_setNotVerifyUser = mysqli_fetch_object($sql);

			if(isset($data_setNotVerifyUser->isnotverify) && !empty($data_setNotVerifyUser->isnotverify) && $data_setNotVerifyUser->isnotverify > 0){

					$sqlverify = mysqli_query($this->getConnection(),"Select count(`register`.`MatriID`) as is_emailverify from `register` 
			left outer join `emailverify` on `register`.`MatriID` = `emailverify`.`MatriID` 
	        where 1 AND CURRENT_DATE() = DATE_ADD(`register`.`Regdate`, INTERVAL 4 DAY) AND `emailverify`.`verification` = 'Yes' AND `register`.`MatriID` = '".$matriid."'");
				$data_set = mysqli_fetch_object($sqlverify);
				if($data_set->is_emailverify == 1){
					return true;
				}else{
					return false;	
				}

			}else{
				return true;
			}
			
		}else{
			return false;
		}
		
	}
	



	
}
//Declare Class Object 
$db = Database::getInstance();
$con = $db->getConnection(); 
