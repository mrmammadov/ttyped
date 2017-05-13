<?php 

class baseController{

	public function __construct()
	{
	 	
	} 

	protected function view($pagename, $data = null)
	{
		if (file_exists("app/view/".$pagename.".php")) {
			if ($data !== null) {
				extract($data);					
			}
			
			include 'app/view/'.$pagename.'.php';
		}else {
			echo "View Not Found";
		}
	}

	protected function model($name)
	{
		if (file_exists("app/model/". $name .".php")) {
			include "app/model/". $name .".php";

			return new $name();
		}else {
			echo $name." doesnt exist"; 
		}
	}

}
