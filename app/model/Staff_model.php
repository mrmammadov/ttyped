<?php 

class Staff_model extends baseModel
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getAll()
	{

		$this->db->select("staff");
		return $this->db->getResult();
		// print_r($this->db->getResult());
	}
}