<?php
        
        require('config.inc.php');
       require_once('connect.php');
       $obj= new Config();
      

     try{       

		$customer = $_POST['customer']; 
		$phone= $_POST['phone'];
		$order_status = $_POST['order_status'];
		$today = date("Y-m-d H:i:s");
		 
	if (!empty($phone) && !empty($customer) ) {
			   
	      $dataa = $dbh->prepare('insert into approve(customer,phone, date, status)values(:customer,:phone,:date,:order_status)');

			 $dataa->bindParam(':customer',$customer);
			$dataa->bindParam(':phone',$phone);
			$dataa->bindParam(':date',$today);
			$dataa->bindParam(':order_status',$order_status);

			$res = $dataa->execute();

			if ($res) {
				echo "<p  class='text-center text-success'><strong>Successfuly Comfirmed.</strong></P>";

			if ($_POST['order_status']=='Accept') {
				$msg="Dear ".$customer." You Accepted The Purchase Of Our Product on ".$today.". Thanks For Being A Customer";
		        $obj->send_sms($phone,$msg);
			}else{
				$msg="Dear ".$customer." You  Declined The Purchase Of Our Product on ".$today.". Please Contact Us And Tell Us Why?";
		        $obj->send_sms($phone,$msg);
			}
			   	
			}else{
				echo "<p  class='text-center text-danger'><strong>Failed To Add New Client</strong></P>";
			}
		   
	}else{
	    echo "<p  class='text-center text-danger'><strong>Fill In All Fields Please To Confirm</strong></P>";
	}
			}catch(PDOException $e){
			 trigger_error("error_msg".$e->getMessage());

			}

?>