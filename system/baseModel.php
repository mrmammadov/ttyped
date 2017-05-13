<?php 

class baseModel 
{
	public $db;

	public function __construct()
	{
		include 'Database.php';
		$this->db = new Database("localhost", "root", "", "endorphin");
		$this->db->connect();
	}
}