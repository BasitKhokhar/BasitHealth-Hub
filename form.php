<?php
	$Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $MobileNumber= $_POST['MobileNumber'];
    $Doctortype = $_POST['Doctortype'];
    $Date = $_POST['Date'];
    $Time = $_POST['Time'];
    $Problem = $_POST['Problem'];
	// Database connection
	$conn = new mysqli('localhost','root','','hospitaldb');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into problemtable(Name ,Email , MobileNo ,Doctortype ,Date ,Time ,Problem ) values(?, ?, ?, ?, ?,?,?)");
		$stmt->bind_param("sssssss",$Name,$Email,$MobileNumber,$Doctortype, $Date, $Time,$Problem);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>