<?php

define('DB_SERVER', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_DATABASE', "taceas");
define('DB_DRIVER', "mysql");



try{
 		$data= json_decode(file_get_contents("php://input")); 

        $phone = $data->clientphone; 
        $name = $data->clientname;
        $email = $data->clientemail;
        $district = $data->clientdistrict;
        $region = $data->clientregion;
        $residance = $data->clientresidance;
        $productname = $data->clientproductname; 
        $productprice = $data->clientproductprice;
        $productsize = $data->clientproductsize;
        $productcolor = $data->clientproductcolor;
        $producttype = $data->clientproducttype;



             $connection = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
	  	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        	$dataa = $connection->prepare('select * from client where phone=:phone and productname=:productname');	
		    $dataa->bindParam(':phone',$phone);
		    $dataa->bindParam(':productname',$productname);
		    $dataa->execute();

		    $row = $dataa->fetch(PDO::FETCH_ASSOC);

		    if (!$row) {

		     $connection = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
	  	      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  	      $dataa = $connection-> prepare('insert into client(phone,name,email,district,region,residance,productname,productprice,productsize,productcolor,producttype)values(:phone,:name,:email,:district,:region,:residance,:productname,:productprice,:productsize,:productcolor,:producttype)');

			$dataa->bindParam(':phone',$phone);
			$dataa->bindParam(':name',$name);
			$dataa->bindParam(':email',$email);
			$dataa->bindParam(':district',$district);
			$dataa->bindParam(':region',$region);
			$dataa->bindParam(':residance',$residance);
			$dataa->bindParam(':productname',$productname);
			$dataa->bindParam(':productprice',$productprice);
			$dataa->bindParam(':productsize',$productsize);
			$dataa->bindParam(':productcolor',$productcolor);
			$dataa->bindParam(':producttype',$producttype);

			$res = $dataa->execute();

			if ($res) {
				$arr = array('msg' => "Added New Client  ".$name, 'error' => '');
                $jsn = json_encode($arr);
                print_r($jsn);
			}else{
				$arr = array('msg' => "", 'error' => "Failed To Add New Client"  .$name);
                $jsn = json_encode($arr);
                print_r($jsn);
			}

		    }else{
		    	$arr = array('msg' => "", 'error' => "Client Already Exists");
                $jsn = json_encode($arr);
                print_r($jsn);
		    }




}catch(PDOException $e){
 trigger_error(''.$e->getMessage());

}

?>