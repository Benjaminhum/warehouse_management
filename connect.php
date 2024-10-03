<?php
	$kapcsolat=new mysqli("localhost","root","","warehouse");
	
	if($kapcsolat)
	{
		$kapcsolat->query("set names utf8");
		
		
	}
	else
	{
		echo("Error during the connection to the server!");
	}
	
?>