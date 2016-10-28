<?php
require'connection.php';
require('AfricasTalkingGateway.php');

session_start();


class Config extends Connection
{


public function loginUser()
{
	if(isset($_POST['username']) && isset($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (!empty($username) && !empty($password)) {
			try{

		    $data =$this->dbh-> prepare('select * from userregister where password=:password and username=:username');
			$data->bindParam(':username',$username);
			$data->bindParam(':password',$password);
			$data->execute();

			$row = $data->fetch(PDO::FETCH_ASSOC);

			if($row){
				         $_SESSION['username'] = $username;
						if(isset($_SESSION['username'])){

                             header("Location:index.php");
                             exit();
						}else{
							 header("Location:login.php");
						}
			}else{
				echo "User Not Found.";
			}

			}catch(PDOException $e){
				trigger_error('Error: ' .$e->getMessage());
			}

		}else{

			echo "Fill In All Fields.";
		}
	}
}
public function loginErand()
{
	if(isset($_POST['username']) && isset($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (!empty($username) && !empty($password)) {
			try{

		    $data =$this->dbh-> prepare('select * from erand where password=:password and username=:username');
			$data->bindParam(':username',$username);
			$data->bindParam(':password',$password);
			$data->execute();

			$row = $data->fetch(PDO::FETCH_ASSOC);

			if($row){
				         $_SESSION['username'] = $username;
						if(isset($_SESSION['username'])){

                             header("Location:welcomeErand.php");
                             exit();
						}else{
							 header("Location:erandLogin.php");
						}
			}else{
				echo "User Not Found.";
			}

			}catch(PDOException $e){
				trigger_error('Error: ' .$e->getMessage());
			}

		}else{

			echo "Fill In All Fields.";
		}
	}
}

public function getUsers()
{
	try{
		 $date =$this->dbh->prepare('select * from users');
		 $date->execute();

		 echo "<table id='example1' class='table table-bordered table-striped'>";
		 echo "<thead>";
		 echo"<tr>";
		 echo "<th>First Name</th>";
		 echo "<th>Last Name</th>";
		 echo "<th>Email</th>";
		 echo "<th>Category</th>";
		 echo "<th>Password</th>";
		 echo "<th>User</th>";
		 echo "<th>Edit</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 while ($row= $date->fetch(PDO::FETCH_ASSOC)) {

		 	$firstname = $row['firstname'];
		 	$lastname = $row['lastname'];
		 	$email = $row['email'];
		 	$password = $row['password'];
		 	$username = $row['username'];
		 	$category = $row['category'];


		 	echo "<tr>";
		 	echo "<td>$firstname</td>";
		 	echo "<td>$lastname</td>";
		 	echo "<td>$email</td>";
		 	echo "<td>$category</td>";
		 	echo "<td>$password</td>";
		 	echo "<td>$username</td>";
		 	echo "<td><a href='delete?username=$username' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></td>";
		 	echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "<tfoot>";
		 echo"<tr>";
		 echo "<th>First Name</th>";
		 echo "<th>Last Name</th>";
		 echo "<th>Email</th>";
		 echo "<th>Category</th>";
		 echo "<th>Password</th>";
		 echo "<th>User</th>";
		 echo "<th>Edit</th>";
		 echo "</tr>";
		 echo "</tfoot>";
		 echo "</table>";


	}catch(PDOException $e){

		trigger_error('Errors :'.$e->getMessage());

	}
}

public function getClients()
{
	try{

		 $date =$this->dbh->prepare('select * from client order by id desc');
		 $date->execute();
		 echo "<div class='box-body'>";
		 echo "<table id='example1' class='table table-bordered table-striped'>";
		 echo "<thead>";
		 echo"<tr>";
		 echo "<th>Client ID</th>";
		 echo "<th>Phone Number</th>";
		 echo "<th>Client Name</th>";
		 echo "<th>Email</th>";
		 echo "<th>District</th>";
		 echo "<th>Region</th>";
		 echo "<th>Residance</th>";
		 echo "<th>Product Name</th>";
         echo "<th>Edit</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 while ($row= $date->fetch(PDO::FETCH_ASSOC)) {

		 	$phone = $row['phone'];
		 	$name = $row['name'];
		 	$district = $row['district'];
		 	$region = $row['region'];
		 	$residance = $row['residance'];
		 	$productname = $row['productname'];
		 	$email = $row['email'];
		 	$id = $row['id'];

		 	echo "<tr>";
		 	echo "<td>C000$id</td>";
		 	echo "<td><a href='clientdetails?phone=$phone&&name=$name'>$phone<a></td>";
		 	echo "<td>$name</td>";
		 	echo "<td>$email</td>";
		 	echo "<td>$district</td>";
		 	echo "<td>$region</td>";
		 	echo "<td>$residance</td>";
		 	echo "<td>$productname</td>";
            echo "<td><a href='deleteClient?phone=$phone' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></td>";
		 	echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "<tfoot>";
		 echo"<tr>";
		 echo "<th>Client ID</th>";
		 echo "<th>Phone Number</th>";
		 echo "<th>Client Name</th>";
		 echo "<th>Email</th>";
		 echo "<th>District</th>";
		 echo "<th>Region</th>";
		 echo "<th>Residance</th>";
		 echo "<th>Product Name</th>";
         echo "<th>Edit</th>";
		 echo "</tr>";
		 echo "</tfoot>";
		 echo "</table>";
		 echo "</div>";


	}catch(PDOException $e){

		trigger_error('Errors :'.$e->getMessage());

	}
}
public function getErand()
{
	try{

		 $date =$this->dbh->prepare('select * from erand order by id desc');
		 $date->execute();
		 echo "<div class='box-body'>";
		 echo "<table id='example1' class='table table-bordered table-striped'>";
		 echo "<thead>";
		 echo"<tr>";
		 echo "<th>ID</th>";
		 echo "<th>First Name</th>";
		 echo "<th>Last Name</th>";
		 echo "<th>Email</th>";
		 echo "<th>Phone</th>";
		 echo "<th>Username</th>";
		 echo "<th>Edit</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 while ($row= $date->fetch(PDO::FETCH_ASSOC)) {

		 	$phone = $row['phone'];
		 	$firstname = $row['firstname'];
		 	$lastname = $row['lastname'];
		 	$email = $row['email'];
		 	$username = $row['username'];
		 	$id = $row['id'];

		 	echo "<tr>";
		 	echo "<td>E000$id</td>";
		 	echo "<td><a href='clientdetails?phone=$phone&&name=$name'>$phone<a></td>";
		 	echo "<td>$firstname</td>";
		 	echo "<td>$lastname</td>";
		 	echo "<td>$email</td>";
		 	echo "<td>$username</td>";
            echo "<td><a href='deleteClient?phone=$phone' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></td>";
		 	echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "<tfoot>";
		 echo"<tr>";
		 echo "<th>ID</th>";
		 echo "<th>First Name</th>";
		  echo "<th>Last Name</th>";
		 echo "<th>Email</th>";
		 echo "<th>Phone</th>";
		 echo "<th>Username</th>";
         echo "<th>Edit</th>";
		 echo "</tr>";
		 echo "</tfoot>";
		 echo "</table>";
		 echo "</div>";


	}catch(PDOException $e){

		trigger_error('Errors :'.$e->getMessage());

	}
}
public function getResa()
{
	try{

		 $date =$this->dbh->prepare('select * from resa order by id desc');
		 $date->execute();
		 echo "<div class='box-body'>";
		 echo "<table id='example1' class='table table-bordered table-striped'>";
		 echo "<thead>";
		 echo"<tr>";
		 echo "<th>ID</th>";
		 echo "<th>First Name</th>";
		 echo "<th>Last Name</th>";
		 echo "<th>Email</th>";
		 echo "<th>Phone</th>";
		 echo "<th>Username</th>";
		 echo "<th>Edit</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 while ($row= $date->fetch(PDO::FETCH_ASSOC)) {

		 	$phone = $row['phone'];
		 	$firstname = $row['firstname'];
		 	$lastname = $row['lastname'];
		 	$email = $row['email'];
		 	$username = $row['username'];
		 	$id = $row['id'];

		 	echo "<tr>";
		 	echo "<td>E000$id</td>";
		 	echo "<td><a href='clientdetails?phone=$phone&&name=$name'>$phone<a></td>";
		 	echo "<td>$firstname</td>";
		 	echo "<td>$lastname</td>";
		 	echo "<td>$email</td>";
		 	echo "<td>$username</td>";
            echo "<td><a href='deleteClient?phone=$phone' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></td>";
		 	echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "<tfoot>";
		 echo"<tr>";
		 echo "<th>ID</th>";
		 echo "<th>First Name</th>";
		  echo "<th>Last Name</th>";
		 echo "<th>Email</th>";
		 echo "<th>Phone</th>";
		 echo "<th>Username</th>";
         echo "<th>Edit</th>";
		 echo "</tr>";
		 echo "</tfoot>";
		 echo "</table>";
		 echo "</div>";


	}catch(PDOException $e){

		trigger_error('Errors :'.$e->getMessage());

	}
}
public function getPartner()
{
	try{

		 $date =$this->dbh->prepare('select * from partners order by id desc');
		 $date->execute();
		 echo "<div class='box-body'>";
		 echo "<table id='example1' class='table table-bordered table-striped'>";
		 echo "<thead>";
		 echo"<tr>";
		 echo "<th>ID</th>";
		 echo "<th>Phone</th>";
		 echo "<th>Partner Name</th>";
		 echo "<th>Email</th>";
		 echo "<th>Partner Phone</th>";
		 echo "<th>Username</th>";
		 echo "<th>Edit</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 while ($row= $date->fetch(PDO::FETCH_ASSOC)) {

		 	$phone = $row['partnerphonee'];
		 	$firstname = $row['partnername'];
		 	$lastname = $row['lastname'];
		 	$email = $row['email'];
		 	$username = $row['username'];
		 	$Partner = $row['partnerphonee'];
		 	$id = $row['id'];

		 	echo "<tr>";
		 	echo "<td>E000$id</td>";
		 	echo "<td><a href='clientdetails?phone=$phone&&name=$name'>$phone<a></td>";
		 	echo "<td>$firstname</td>";
		 	echo "<td>$email</td>";
		 	echo "<td>$Partner</td>";
		 	echo "<td>$username</td>";
            echo "<td><a href='deleteClient?phone=$phone' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></td>";
		 	echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "<tfoot>";
		 echo"<tr>";
		 echo "<th>ID</th>";
		  echo "<th>Phone</th>";
		 echo "<th>Partner Name</th>";
		 echo "<th>Email</th>";
		 echo "<th>Partner Phone</th>";
		 echo "<th>Username</th>";
		 echo "<th>Edit</th>";
		 echo "</tr>";
		 echo "</tfoot>";
		 echo "</table>";
		 echo "</div>";


	}catch(PDOException $e){

		trigger_error('Errors :'.$e->getMessage());

	}
}
public function getallClient()
{
	try{

		 $date =$this->dbh->prepare('select * from clients order by id desc');
		 $date->execute();
		 echo "<div class='box-body'>";
		 echo "<table id='example1' class='table table-bordered table-striped'>";
		 echo "<thead>";
		 echo"<tr>";
		 echo "<th>ID</th>";
		 echo "<th>Phone</th>";
		 echo "<th>First Name</th>";
		 echo "<th>Last Name</th>";
		 echo "<th>Product</th>";
		 echo "<th>District</th>";
		 echo "<th>Region</th>";
		 echo "<th>Residance</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 while ($row= $date->fetch(PDO::FETCH_ASSOC)) {

		 	$phone = $row['phone'];
		 	$firstname = $row['firstname'];
		 	$lastname = $row['lastname'];
		 	$product = $row['product'];
		 	$phone= $row['phone'];
		 	$district = $row['district'];
		 	$region= $row['region'];
		 	$residance= $row['residance'];
		 	$id = $row['id'];

		 	echo "<tr>";
		 	echo "<td>C0$id</td>";
		 	echo "<td><a href=''>$phone<a></td>";
		 	echo "<td>$firstname</td>";
		 	echo "<td>$lastname</td>";
		 	echo "<td>$product</td>";
		 	echo "<td>$district</td>";
		 	echo "<td>$region</td>";
		 	echo "<td>$residance</td>";
		 	echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "</table>";
		 echo "</div>";


	}catch(PDOException $e){

		trigger_error('Errors :'.$e->getMessage());

	}
}
public function getallDelivery()
{
	try{

		 $date =$this->dbh->prepare('select * from delivered order by id desc');
		 $date->execute();
		 echo "<div class='box-body'>";
		 echo "<table id='example1' class='table table-bordered table-striped'>";
		 echo "<thead>";
		 echo"<tr>";
		 echo "<th>ID</th>";
		 echo "<th>Customer</th>";
		 echo "<th>Resa</th>";
		 echo "<th>Product</th>";
		 echo "<th>Plate</th>";
		 echo "<th>Date</th>";
		 echo "<th>Erand</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 while ($row= $date->fetch(PDO::FETCH_ASSOC)) {

		 	$customer= $row['customer'];
		 	$resa = $row['resa'];
		 	$product = $row['product'];
		 	$plate= $row['plate'];
		 	$date = $row['date'];
		 	$erand= $row['erand'];
		 	$id = $row['id'];
/*
		 	$part =$this->dbh->prepare('select * from clients where id = :customer');
			$part->bindParam(':customer',$customer);
		    $part->execute();
		    while($part_response = $part->fetch(PDO::FETCH_ASSOC));
		    $firstname= $part_response['firstname'];
		    $lastname= $part_response['lastname'];
*/
		 	echo "<tr>";
		 	echo "<td>C0$id</td>";
		 	echo "<td>$customer</td>";
		 	echo "<td>$resa</td>";
		 	echo "<td>$product</td>";
		 	echo "<td>$plate</td>";
		 	echo "<td>$date</td>";
		 	echo "<td>$erand</td>";
		 	echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "</table>";
		 echo "</div>";


	}catch(PDOException $e){

		trigger_error('Errors :'.$e->getMessage());

	}
}


public function getSessionInfo()
{
	try {
        if($_SESSION['username']){
        $username = $_SESSION['username'];

        $data =$this->dbh-> prepare('select * from userregister where username=:username');
        $data->bindParam(':username',$username);
        $results= $data->execute();

        while ($row= $data->fetch(PDO::FETCH_ASSOC)) {

            $firstname = $row['firstname'];
		 	$lastname = $row['lastname'];
		 	$email = $row['email'];
		 	$password = $row['password'];
		 	$username = $row['username'];
		 	$category = $row['category'];

		 		echo "<div class='row'>";
		 		echo "<div class='col-md-5'>";
		 		echo "<img src='dist/img/user2-160x160.jpg' class='user-image image-circle image-rounded' />";
		 		echo "</div>";
		 		echo "<div class='col-md-7'>";
		 		echo "<h4>First Name : $firstname </h4>";
		 		echo "<h4>Last Name : $lastname </h4>";
		 		echo "<h4>Email : $email </h4>";
		 		echo "<h4>Username : $username </h4>";
		 		echo "<h4>Category : $category</h4>";
		 		echo "</div>";
		 		echo "</div>";


		 		echo "<div class='row'>";
		 		echo "<div class='col-md-12'>";
		 		//echo "<h4>Email : $email </h4>";
		 		echo "</div>";
		 		echo "</div>";



		 		echo "<div class='row'>";
		 		echo "<div class='col-md-6'>";
		 		//echo "<h4>Username : $username </h4>";
		 		echo "</div>";
		 		echo "<div class='col-md-6'>";
		 		//echo "<h4>Category : $category</h4>";
		 		echo "</div>";
		 		echo "</div>";


           }


          }



} catch (PDOException $e) {

     }
}


public function geClintNumber()
{
	try{
		 $data =$this->dbh->prepare('select count(phone) as total from client');
		 $data->execute();
		 echo "<div class='small-box bg-yellow'>";

		 while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
		 	$total = $row['total'];
		 	echo "<div class='inner'>";
		 	echo "<h3>$total</h3>";
		 	echo "<p>Registered Clients</p>";
		 	echo "</div>";
		 }
		 echo "<div class='icon'>";
		 echo "<i class='ion ion-person-add'></i>";
		 echo "</div>";
		 echo "<a href='registeredclient' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>";
		 echo "</div>";
    }catch(PDOException $e){
     trigger_error("error_msg". $e->getMessage());

    }
}
public function getProductNumber()
{
	try{

		 $data =$this->dbh->prepare('select count(phone) as total from client');
		 $data->execute();

		 echo "<div class='small-box bg-green'>";

		 while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
		 	$total = $row['total'];
		 	echo "<div class='inner'>";
		 	echo "<h3>$total</h3>";
		 	echo "<p>Number Of Products</p>";
		 	echo "</div>";
		 }
		 echo "<div class='icon'>";
		 echo "<i class='ion ion-person-add'></i>";
		 echo "</div>";
		 echo "<a href='products' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>";
		 echo "</div>";
    }catch(PDOException $e){
     trigger_error("error_msg". $e->getMessage());

    }
}

public function getClientList()
{
		try{

		 $data =$this->dbh->prepare('select * from client limit 5');
		 $data->execute();


		 echo "<li class='treeview'>";
		 echo "<a href=''>";
		 echo "<i class='fa fa-users'></i>";
		 echo "<span>Users</span>";
		 echo "<i class='fa fa-angle-left pull-right'></i>";
		 echo "</a>";
		 echo "<ul class='treeview-menu'>";
		 while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
		 	$phone = $row['phone'];
		 	$name = $row['name'];
		 	$district = $row['district'];
		 	$region = $row['region'];
		 	$residance = $row['residance'];
		 	$productname = $row['productname'];
		 	$email = $row['email'];
		 	$names = str_replace(' ', '-',$name);


		 	echo "<li><a href='".BASE_URL."/client/".$phone."/".$names.".html'><i class='fa fa-angle-right'></i> $name</a></li>";
		 }
		 echo "</ul>";
		 echo "</li>";

		}catch(PDOException $e){

		}
}



public function getCustomers()
{
	try{


		 $date =$this->dbh-> prepare('select * from customers');

		 $date->execute();
		 echo "<div class='box-body'>";
		 echo "<table id='example1' class='table table-bordered table-striped'>";
		 echo "<thead>";
		 echo"<tr>";
		 echo "<th>Phone Number</th>";
		 echo "<th>Client Name</th>";
		 echo "<th>District</th>";
		 echo "<th>Region</th>";
		 echo "<th>Parish</th>";
		 echo "<th>Product Name</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 while ($row= $date->fetch(PDO::FETCH_ASSOC)) {

		 	$phone = $row['phone'];
		 	$name = $row['name'];
		 	$district = $row['district'];
		 	$region = $row['region'];
		 	$parish = $row['parish'];
		 	$productname = $row['productname'];

		 	echo "<tr>";
		 	echo "<td>$phone</td>";
		 	echo "<td>$name</td>";
		 	echo "<td>$district</td>";
		 	echo "<td>$region</td>";
		 	echo "<td>$parish</td>";
		 	echo "<td>$productname</td>";
		 	echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "<tfoot>";
		 echo"<tr>";
		 echo "<th>Phone Number</th>";
		 echo "<th>Client Name</th>";
		 echo "<th>District</th>";
		 echo "<th>Region</th>";
		 echo "<th>Parish</th>";
		 echo "<th>Product Name</th>";
		 echo "</tr>";
		 echo "</tfoot>";
		 echo "</table>";
		 echo "</div>";


	}catch(PDOException $e){

		trigger_error('Errors :'.$e->getMessage());

	}
}

public function partners()
{
	try{
		 $data =$this->dbh->prepare('select * from partners');
		 $data->execute();
		 echo "<select class='form-control' id='partner'>";

		 while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
		 	$partnername = $row['partnername'];
		 	$id= $row['id'];
		 	echo "<option value='$id'>$partnername </option>";
		 }
		 echo "</select>";
    }catch(PDOException $e){
     trigger_error("error_msg". $e->getMessage());

    }
}
public function resa()
{
	try{
		 $data =$this->dbh->prepare('select * from resa');
		 $data->execute();
		 echo "<select class='form-control' id='resa'>";

		 while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
		 	$lastname = $row['lastname'];
		 	$firstname = $row['firstname'];
		 	$id= $row['id'];
		 	echo "<option value='$id'>$firstname $lastname</option>";
		 }
		 echo "</select>";
    }catch(PDOException $e){
     trigger_error("error_msg". $e->getMessage());

    }
}
public function Erand()
{
	try{
		 $data =$this->dbh->prepare('select * from erand');
		 $data->execute();
		 echo "<select class='form-control' id='erand'>";

		 while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
		 	$lastname = $row['lastname'];
		 	$firstname = $row['firstname'];
		 	$id= $row['id'];
		 	echo "<option value='$id'>$firstname $lastname</option>";
		 }
		 echo "</select>";
    }catch(PDOException $e){
     trigger_error("error_msg". $e->getMessage());

    }
}

public function send_sms($recipients,$message)
{
//require('AfricasTalkingGateway.php');
$username   = "kluz116";
$apikey     = "448cdfda1c4065a0274f6561a794b833cc34b0e13e0e21532b7b5e831822e4b6";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
//$recipients = "+254711XXXYYY,+254733YYYZZZ";
// And of course we want our recipients to know what we really do
//$message    = "I'm a lumberjack and its ok, I sleep all night and I work all day";
// Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);
// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}
}

public function clients()
{
	try{
		 $data =$this->dbh->prepare('select * from clients');
		 $data->execute();
		 echo "<select class='form-control' id='customer'>";
		 echo "<option>--Choose Client From List--</option>";
		 while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
		 	$lastname = $row['lastname'];
		 	$firstname = $row['firstname'];
		 	$id= $row['id'];
		 	echo "<option value='$id'>$firstname $lastname</option>";
		 }
		 echo "</select><br><br>";
    }catch(PDOException $e){
     trigger_error("error_msg". $e->getMessage());

    }
}

public function resa__()
{
	try{
		 $data =$this->dbh->prepare('select * from resa');
		 $data->execute();
		 echo "<select class='form-control' id='resa'>";
		 echo "<option>--Choose Resa From List--</option>";
		 while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
		 	$lastname = $row['lastname'];
		 	$firstname = $row['firstname'];
		 	$id= $row['id'];
		 	echo "<option value='$id'>$firstname $lastname</option>";
		 }
		 echo "</select><br><br>";
    }catch(PDOException $e){
     trigger_error("error_msg". $e->getMessage());

    }
}


public function getErandSessionInfo()
{
	try {
        if($_SESSION['username']){
        $username = $_SESSION['username'];

        $data =$this->dbh-> prepare('select * from erand where username=:username');
        $data->bindParam(':username',$username);
        $results= $data->execute();

        while ($row= $data->fetch(PDO::FETCH_ASSOC)) {

            $firstname = $row['firstname'];
		 	$lastname = $row['lastname'];
		 	$email = $row['email'];
		 	$password = $row['password'];
		 	$username = $row['username'];

		 	echo $name= $firstname.' '.$lastname;

		 

           }


          }



} catch (PDOException $e) {

     }
}



public function getApproval()
{
	try{

		 $date =$this->dbh->prepare('select * from approve order by id desc');
		 $date->execute();
		 echo "<div class='box-body'>";
		 echo "<table id='example1' class='table table-bordered table-striped'>";
		 echo "<thead>";
		 echo"<tr>";
		 echo "<th>ID</th>";
		 echo "<th>Client Name</th>";
		 echo "<th>Phone</th>";
		 echo "<th>Date</th>";
		 echo "<th>Status</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 while ($row= $date->fetch(PDO::FETCH_ASSOC)) {

		 	$phone = $row['phone'];
		 	$customer = $row['customer'];
		 	$date = $row['date'];
		 	$status = $row['status'];
		 	$id = $row['id'];

		 	echo "<tr>";
		 	echo "<td>A0$id</td>";
		 	echo "<td>$customer</td>";
		 	echo "<td>$phone</td>";
		 	echo "<td>$date</td>";
		 	echo "<td>$status</td>";
		 	echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "</table>";
		 echo "</div>";


	}catch(PDOException $e){

		trigger_error('Errors :'.$e->getMessage());

	}
}

}//End of the class.






?>
