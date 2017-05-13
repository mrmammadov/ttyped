<?php 

class News extends baseController
{
	public function index()
	{
		echo "news/index";
	}

	public function read($id=null)
	{
		echo "news/read"."<br>";
		echo "Id equals : ". "$id";
	}


}



 ?>