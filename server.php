<?php
	 session_start();
	//initialize variables
	$name = "";
	$address = "";
	$id = 0;
	$edit_state=false;

	//connect to database
	$db = mysqli_connect('localhost','root','','crud');

	//if save button is clicked
	if(isset($_POST['save'])){
		$name =$_POST['name'];
		$address =$_POST['address'];

		$query ="INSERT INTO info (name,address) VALUES ('$name','$address')";
		mysqli_query($db,$query);
		$_SESSION['msg'] ="Address saved";
		header('location: index.php'); //redirect to index page
	}
	if(isset($_POST['update'])) {
		$name = mysqli_real_escape_string($db, $_POST['name']);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$id = mysqli_real_escape_string($db, $_POST['id']);

		mysqli_query($db,"UPDATE info SET name='$name', address='$address' WHERE id=$id");
		$_SESSION['msg'] = "Address updated";
		header('location: index.php');
	}
	//delete
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db,"DELETE FROM info WHERE id=$id");
		$_SESSION['msg'] = "Address deleted";
		header('location: index.php');
	}

	$results = mysqli_query($db,"SELECT * FROM info");
?>