<?php 

include 'system/baseController.php';
include 'system/baseModel.php';
include 'app/controller/Error.php';

class Loader
{	
	private $url;
	private $controller;
	private $method;

	public function __construct()
	{
		
	}
	public function run()
	{
		// $error = new Error;
		
		if (isset($_GET["url"])) {
			$this->url = $_GET["url"];
			$this->url = explode("/", $this->url);
			// print_r($this->url);

			if (file_exists("app/controller/". $this->url[0] .".php")) {
				require_once "app/controller/". $this->url[0] .".php";
				$this->controller = new $this->url[0]();
				unset($this->url[0]);

				if (isset($this->url[1])) {
					if (method_exists($this->controller, $this->url[1])) {
						$this->method = $this->url[1];
						unset($this->url[1]);			
							if (isset($this->url[2])) {
								call_user_func_array(array($this->controller, $this->method), $this->url);
							}else {
								$this->controller->method();
								unset($this->method);
							}

					}else {
						// $error->errorPage();
						echo "method doesnt exist";
						// print_r($url[1]);
					}			
				}else {
					// $error->errorPage();
					echo "method doesnt set";
					// print_r($url[1]);
				}


			}else {
					// $error = new Error;
					// $error->errorPage();
				echo "controller doesnt set";
			}


		}else {
			echo "Home Page";
		}		
	}

}