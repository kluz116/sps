<?php
        require('config.inc.php');
       require_once('connect.php');
       $obj= new Config();

try{       

		       $firstname = $_POST['firstname']; 
		        $lastname = $_POST['lastname'];
		        $product = $_POST['product'];
		        $phone = $_POST['phone'];
		        $partner = $_POST['partner'];
		        $erand = $_POST['erand'];
		        $resa = $_POST['resa'];
		        $district = $_POST['district'];
		        $region = $_POST['region'];
		        $residance= $_POST['residance'];
		        $today = date("Y-m-d H:i:s");

	if (!empty($firstname) && !empty($lastname) && !empty($phone) ) {
		
        	
		    $check_off= $dbh->prepare('SET FOREIGN_KEY_CHECKS=0');
		    if ($check_off->execute()) {
	    $dataa = $dbh->prepare('insert into clients(firstname,lastname, phone,product, partner,erand,resa,district,region,residance)values(:firstname,:lastname,:phone,:product,:partner,:erand,:resa,:district,:region,:residance)');

			$dataa->bindParam(':firstname',$firstname);
			$dataa->bindParam(':lastname',$lastname);
			$dataa->bindParam(':product',$product);
			$dataa->bindParam(':phone',$phone);
			$dataa->bindParam(':partner',$partner);
			$dataa->bindParam(':erand',$erand);
			$dataa->bindParam(':resa',$resa);
			$dataa->bindParam(':district',$district);
			$dataa->bindParam(':region',$region);
			$dataa->bindParam(':residance',$residance);
			$res = $dataa->execute();

			if ($res) {
				echo "<p  class='text-center text-success'><strong>Successfuly Added New Client ".$firstname."</strong></P>";
				//if (isset($_POST['partner'])) {
				 //echo "<p>Partner</p>";	
				$pa = $_POST['partner'];
				$part =$dbh->prepare('select * from partners where id=:pa');
				$part->bindParam(':pa',$pa);
		        $lol = $part->execute();
		        if ($lol) {
		        $part_response = $part->fetch(PDO::FETCH_ASSOC);
		        $name= $part_response['partnername'];
		        $phone_part= $part_response['partnerphonee'];
		        $clie_name = $firstname.' '.$lastname;
		        $msg="Dear ".$name.", ".$clie_name." has made an order for ".$product." today at ".$today.".";
		     
		        $obj->send_sms($phone_part,$msg);
		        }else{
		        	echo "<p>Cant Send Sms</p>";
		        }
		    
				//}else if(isset($_POST['erand'])){
					//echo "<p>Erand</p>";	
				$er = $_POST['erand'];
				$era =$dbh->prepare('select * from erand where id=:er');
				$era->bindParam(':er',$er);
		        $errr= $era->execute();
		        if ($errr) {
		        $era_response = $era->fetch(PDO::FETCH_ASSOC);
		        $name1= $era_response['firstname'];
		        $name2= $era_response['lastname'];
		        $phone_err= $era_response['phone'];
		        $clie_name = $firstname.' '.$lastname;
		        $era_name = $name1.'  '.$name2;
		        $msg="Dear ".$era_name.", ".$clie_name." has made an order for ".$product." today at ".$today.".";
		        $obj->send_sms($phone_err,$msg);
		        }else{
		        	echo "<P>Cant Send</p>";
		        }
				//}else if(isset($_POST['resa'])){
				//echo "<p>Resa</p>";	
				$re =$dbh->prepare('select * from resa where id=:resa');
				$re->bindParam(':resa',$resa);
		        $respo=$re->execute();
		        if ($respo) {
		        $re_response = $re->fetch(PDO::FETCH_ASSOC);
		        $namee= $re_response['firstname'];
		        $nameee= $re_response['lastname'];
		        $phone_re= $re_response['phone'];
		        $clie_name = $firstname.' '.$lastname;
		        $re_name = $namee.'  '.$nameee;
		        $msg="Dear ".$re_name." ,".$clie_name." has made an order for ".$product." today at ".$today.".";
		       
		        $obj->send_sms($phone_re,$msg);
		        }else{
		        	echo "<p>Cant Send </p>";
		        }
		  
		        
				//}else{
					
				$msg="Dear ".$firstname." ".$lastname.", You have made an order for ".$product." today at ".$today.". Delivery will be made as soon as possible in 24 Hr";
		        $obj->send_sms($phone,$msg);
		        
				//}
			}else{
				echo "<p  class='text-center text-danger'><strong>Failed To Add New Client</strong></P>";
			}
			$check_on= $dbh->prepare('SET FOREIGN_KEY_CHECKS=1');
		    $check_on->execute();
		    }
	  	    

		   
	}else{
	echo "<p  class='text-center text-danger'><strong>Fill In All Fields Please To Add New Client</strong></P>";
	}
 		

			}catch(PDOException $e){
			 trigger_error("error_msg".$e->getMessage());

			}

?>