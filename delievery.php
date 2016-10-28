<?php
        
        require('config.inc.php');
       require_once('connect.php');
       $obj= new Config();
      

try{       

		        $customer = $_POST['customer']; 
		        $resa = $_POST['resa'];
		        $product = $_POST['product'];
		        $plate = $_POST['plate'];
		 		$date= $_POST['date'];
		        $erand = $_POST['erand'];
		        $today = date("Y-m-d H:i:s");
		 
	if (!empty($plate) && !empty($product) && !empty($date) ) {
		
        	
		   
	$dataa = $dbh->prepare('insert into delivered(customer,resa, product, plate,date,erand)values(:customer,:resa,:product,:plate,:date,:erand)');

			$dataa->bindParam(':customer',$customer);
			$dataa->bindParam(':resa',$resa);
			$dataa->bindParam(':product',$product);
			$dataa->bindParam(':plate',$plate);
			$dataa->bindParam(':date',$date);
			$dataa->bindParam(':erand',$erand);
			$res = $dataa->execute();

			if ($res) {
			if (isset($customer)) {
				$part =$dbh->prepare('select * from clients where id=:customer');
				$part->bindParam(':customer',$customer);
		        $lol = $part->execute();
		        if ($lol) {
		        $part_response = $part->fetch(PDO::FETCH_ASSOC);
		        $name1= $part_response['firstname'];
		        $name2= $part_response['lastname'];
		        $phone_part= $part_response['phone'];
		        $name=$name1.' '.$name2;
		        
		        $msg="Dear ".$name.", Your order for ".$product." has been delivered today at ".$today.". Will be delivered to you in 24 Hr";
		     
		        $obj->send_sms($phone_part,$msg);
		       echo "<p  class='text-center text-success'><strong>Successfuly Comfirmed Delivery.</strong></P>";
		        }else{
		        	echo "<p>Cant Send Sms</p>";
		        }
		    
			}
				$re =$dbh->prepare('select * from resa where id=:resa');
				$re->bindParam(':resa',$resa);
		        $respo=$re->execute();
		        if ($respo) {
		        $re_response = $re->fetch(PDO::FETCH_ASSOC);
		        $namee= $re_response['firstname'];
		        $nameee= $re_response['lastname'];
		        $phone_re= $re_response['phone'];
		        $re_name = $namee.'  '.$nameee;
		        $msg="Dear ".$re_name." ,Customer order for ".$product." has been delivered today at ".$today.".";
		       
		        $obj->send_sms($phone_re,$msg);
		        }else{
		        	echo "<p>Cant Send </p>";
		        }
				
			}else{
				echo "<p  class='text-center text-danger'><strong>Failed To Add New Client</strong></P>";
			}
		   
	}else{
	echo "<p  class='text-center text-danger'><strong>Fill In All Fields Please To Add New Client</strong></P>";
	}
 		

			}catch(PDOException $e){
			 trigger_error("error_msg".$e->getMessage());

			}

?>