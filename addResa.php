<?php

       define('DB_SERVER', "localhost");
       define('DB_USER', "root");
       define('DB_PASSWORD', "kluz116");
       define('DB_DATABASE', "delivery");
       define('DB_DRIVER', "mysql");


	try{

		$data= json_decode(file_get_contents("php://input")); 
        $firstname = $data->erandfirstname; 
        $lastname = $data->erandlastname; 
        $phone = $data->erandphone;
        $email = $data->erandemail;
        $username = $data->erandusername;
        $password = $data->erandpassword;
        	
        	$connection = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
	  	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        	$dataa = $connection->prepare('select * from resa where username=:username and password=:password');	
		    $dataa->bindParam(':username',$username);
		    $dataa->bindParam(':password',$password);
		    $dataa->execute();

		    $row = $dataa->fetch(PDO::FETCH_ASSOC);

		    if (!$row) {
		    $connection = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
	  	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dataa =$connection-> prepare('insert into resa(firstname,lastname,phone,email,username,password)values(:firstname,:lastname,:phone,:email,:username,:password)');
			$dataa->bindParam(':firstname',$firstname);
			$dataa->bindParam(':lastname',$lastname);
			$dataa->bindParam(':phone',$phone);
			$dataa->bindParam(':email',$email);
			$dataa->bindParam(':username',$username);
			$dataa->bindParam(':password',$password);


			$res = $dataa->execute();

			if ($res) {
				$arr = array('msg' => "Added New Resa ".$firstname, 'error' => '');
                $jsn = json_encode($arr);
                print_r($jsn);
			}else{

				   $arr = array('msg' => "", 'error' => "Failed To Add New User"  .$firstname);
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