<?php

       define('DB_SERVER', "localhost");
       define('DB_USER', "root");
       define('DB_PASSWORD', "");
       define('DB_DATABASE', "taceas");
       define('DB_DRIVER', "mysql");



 try{
 $myuser= $_GET['username'];

 $connection = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
 $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $data = $connection-> prepare('DELETE FROM userregister WHERE username =:myuser ');

 $data->bindParam(':myuser',$myuser);
 $results=$data->execute();

 if ($results) {
 	header("Location:systemusers.php");
 }else{

 	echo "Failed To Delete.";
 }

 }catch(PDOException $e){
 	trigger_error("Error With Delete :".$e->getMessage());

 }


