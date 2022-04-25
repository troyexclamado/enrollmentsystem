<?php 
session_start();
include('dbconnection.php');

// UPDATE tblstudentinfo SET statusID='0' WHERE statusID='1';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	// pre-enrolled.php
	if(isset($_POST['btncmdAccept'])){

		// $preID = $_POST['btncmdAccept'];
		// $update = $conn->query("update tblstudentinfo set statusID='1' where pre_id = '$preID'");
		// if ($update) {
			//echo $preID;
			$maxStudentNum = "SELECT RIGHT(max(studentNumber) ,6) as mnum FROM tblstudents;";
            $result = $conn->query($maxStudentNum);
            if(mysqli_num_rows($result) > 0){
            	while($row = $result->fetch_assoc()) {
	            	if($row['mnum'] == NULL){
	            		$max =  $row['mnum'];
	            		$yearNow = date("Y");
	            		$maxinc = $max+1;
	            		$format = str_pad($maxinc,6,"0",STR_PAD_LEFT);
	            		$studentNum = $yearNow.$format;
	            		echo $studentNum;
	            	}else{
	            		// $maxstudent = "SELECT LEFT(max(studentNumber) ,6) as max FROM tblstudents;"
	            		// $result2 = $conn->query($maxstudent);
	            		// if(mysqli_num_rows($result) > 0){
	            		// 	$max2 =  $row['max'];
		            	// 	$maxinc = $max2+1;
		            	// 	echo $maxinc;
	            		// }
	            		
	            	}
	            }
            }
     //        	}else{
     //        		echo "oki";
     //        	}

		//echo "<script>window.location.href='Pre-Enrolled.php';</script>";

		// }else{
		// 	echo "ekis";
		// }
	}
}
 ?>

