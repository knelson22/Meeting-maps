<?php  




error_reporting(0);
date_default_timezone_set('America/Chicago');

    
    


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "new";


 $con = new mysqli($servername, $username, $password, $dbname);
 $day= $_GET['day'];;
// $d = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
;

$result = $con->query("select * from meetings WHERE DAY LIKE '%$day%'

");

$myArray = array();
    while($row = $result->fetch_assoc()) {
            $myArray[] = $row;
    }
    
    echo json_encode($myArray);
	

	
$con->close();



