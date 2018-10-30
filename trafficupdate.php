
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" 
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


</head>
<body>
	 <h1 class="jumbotron">TRAFFIC UPDATER</h1>

 <fieldset>
<center>
    <legend>Traffic Update</legend>

    <form action="" method="POST">
    	<input type="text" name="road_name"
    	placeholder="Enter road_name">
    	<br></br>

    	<input type="text" name="traffic_info" 
    	placeholder="Enter traffic_info">
    	<br></br>


    	<input type="submit" value="Save " class="btn btn-info">


    </form>
    
</fieldset>
</center>
</body>
</html>

<?php 
$conn = mysqli_connect("localhost", "root", "", "clinic_db");
$response1 = mysqli_query($conn, "SELECT * FROM table_traffic ORDER BY date DESC");

while($row = mysqli_fetch_array($response1)) {
   echo "<i class ='text-muted'>$row[0]</i> <br>";
   echo "<p class ='alert alert-warning'>$row[1]</p> ";
   echo "<b class = 'badge badge-secondary'> $row[2]</b>";
   echo "<hr>";
}

if (empty($_POST)) {
	exit();
}

$object = new Traffic($_POST['road_name'],
		              $_POST['traffic_info']);

$object->save();

class Traffic{
     function __construct($road_name, $traffic_info){

     	$this->road_name = $road_name;
     	$this->traffic_info = $traffic_info;
     }

      function save(){
	       $conn = mysqli_connect("localhost","root","","clinic_db");

	     	 $response = mysqli_query($conn, "INSERT INTO 
	     	 	`table_traffic`(`road_name`, `traffic_info`)
	     	 	 VALUES ('$this->road_name','$this->traffic_info')");


		     if ($response==true) {
		     echo "Successfully Saved Record";
		     header("location:trafficupdate.php");
		     }
		      else {
		      	echo "Record failed. Check your records and try again";
		      }

	     }
}




 ?>