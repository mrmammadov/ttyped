<?php 


class Staff extends baseController
{

	private $newsDb;

	public function __construct()
	{
		$this->newsDb = $this->model("staff_model");
	}

	public function index()
	{

		$data["staff_list"] = $this->newsDb->getAll();


		var_dump($data["staff_list"]);
		// $this->view("home", $data);
	}
}