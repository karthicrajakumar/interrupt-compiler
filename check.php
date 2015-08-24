<?php
session_start();
require_once('../dbConnect.php');
$sql = dbConnect();

	if(isset($_SESSION['id']))
	{
		$details['user_id'] = $_SESSION['id'];
		$details['name'] = $_SESSION['name'];
		$query = mysqli_query($sql , "SELECT * FROM `online_coding` where `user_id` = ".$details["user_id"]."");
		$data = mysqli_fetch_array($query);
		if($data)
		{
			//$data = mysqli_fetch_array($query);
			$details['current'] = $data['current'];  
			echo json_encode($details);
		}
		else {
			mysqli_query($sql,"INSERT INTO online_coding (user_id) values (".$_SESSION['id'].") ");
			$query = mysqli_query($sql,"SELECT * FROM online_coding where user_id = ".$details['user_id']."");
			$data = mysqli_fetch_array($query);
			$details['current'] = $data['current'];  
			echo json_encode($details);
		}
		
	}
	else {
		echo json_encode(23);
	}


?>