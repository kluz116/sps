<?php

define('DB_SERVER', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_DATABASE', "taceas");
define('DB_DRIVER', "mysql");

try{
 		$data= json_decode(file_get_contents("php://input")); 

        $phone = $data->customerphone; 
        $name = $data->customername;
        $district = $data->customerdistrict;
        $region = $data->customerregion;
        $parish = $data->customerparish;
        $productname = $data->customerproductname; 
        $productprice = $data->customerproductprice;

            $connection = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
	  	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        	$dataa = $connection->prepare('select * from customers where phone=:phone');	
		    $dataa->bindParam(':phone',$phone);
		    $dataa->execute();

		    $row = $dataa->fetch(PDO::FETCH_ASSOC);

		    if (!$row) {

		     $connection = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
	  	      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  	      $dataa = $connection-> prepare('insert into customers(phone,name,district,region,parish,productname,productprice)values(:phone,:name,:district,:region,:parish,:productname,:productprice)');

			$dataa->bindParam(':phone',$phone);
			$dataa->bindParam(':name',$name);
			$dataa->bindParam(':district',$district);
			$dataa->bindParam(':region',$region);
			$dataa->bindParam(':parish',$parish);
			$dataa->bindParam(':productname',$productname);
			$dataa->bindParam(':productprice',$productprice);


			$res = $dataa->execute();

			if ($res) {
				$arr = array('msg' => "Added New Customer  ".$name, 'error' => '');
                $jsn = json_encode($arr);
                print_r($jsn);
			}else{
				$arr = array('msg' => "", 'error' => "Failed To Add New Customer"  .$name);
                $jsn = json_encode($arr);
                print_r($jsn);
			}

		    }else{
		    	$arr = array('msg' => "", 'error' => "Client Already Exists");
                $jsn = json_encode($arr);
                print_r($jsn);
		    }


}catch(PDOException $e){
 echo "".$e->getMessage();

}

?>