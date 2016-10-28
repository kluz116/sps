<?php
	try {
	  $dbh = new PDO("mysql:host=localhost;dbname=delivery", 'root','kluz116');
	}
	catch(PDOException $e) {
	    echo $e->getMessage();
	}