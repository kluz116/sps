<?php

       define('DB_SERVER', "localhost");
       define('DB_USER', "root");
       define('DB_PASSWORD', "");
       define('DB_DATABASE', "taceas");
       define('DB_DRIVER', "mysql");


	try{

		$data= json_decode(file_get_contents("php://input")); 
        $firstname = $data->userfirstname; 
        $lastname = $data->userlastname;
        $email = $data->useremail;
        $category = $data->usercategory;
        $username = $data->userusername;
        $password = $data->userpassword;
        	
        	$connection = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
	  	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        	$dataa = $connection->prepare('select * from userregister where username=:username and password=:password');	
		    $dataa->bindParam(':username',$username);
		    $dataa->bindParam(':password',$password);
		    $dataa->execute();

		    $row = $dataa->fetch(PDO::FETCH_ASSOC);

		    if (!$row) {
		    $connection = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
	  	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dataa =$connection-> prepare('insert into userregister(firstname,lastname,email,category,username,password)values(:firstname,:lastname,:email,:category,:username,:password)');
			$dataa->bindParam(':firstname',$firstname);
			$dataa->bindParam(':lastname',$lastname);
			$dataa->bindParam(':email',$email);
			$dataa->bindParam(':category',$category);
			$dataa->bindParam(':username',$username);
			$dataa->bindParam(':password',$password);


			$res = $dataa->execute();

			if ($res) {
				$arr = array('msg' => "Added New Administrator  ".$username, 'error' => '');
                $jsn = json_encode($arr);
                print_r($jsn);
			}else{

				   $arr = array('msg' => "", 'error' => "Failed To Add New User"  .$username);
                   $jsn = json_encode($arr);
                   print_r($jsn);
			}
		    }else{
				$arr = array('msg' => "", 'error' => "User Already Exists");
                $jsn = json_encode($arr);
                print_r($jsn);
		}
        	
      

	}catch(PDOException $e){


		trigger_error("error_msg".$e->getMessage());

	}
?>