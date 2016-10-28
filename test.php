<?php
require 'connect.php';
$partner=3;
$part =$dbh->prepare('select * from partners where id=:partner ');
$part->bindParam(':partner',$partner);
$part->execute();
$part_response = $part->fetch(PDO::FETCH_ASSOC);
$name= $part_response['partnername'];
echo $name;