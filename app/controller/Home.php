<?php

class Home extends baseController
{
	public function index()
	{
		$data["sinif"] = array("Qulu", "Kamran", "Valeh");
		
		$this->view("home", $data);
	}

	public function errorPage()
	{
		$this->view("/404");
	}

}
