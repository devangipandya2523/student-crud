<?php
	include ('connect.php');

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$qry = mysqli_query($conn,"DELETE FROM student WHERE id=$id");

		if ($qry) {
			echo "success";
		}
		else{
			echo "error";
		}
	}
?>