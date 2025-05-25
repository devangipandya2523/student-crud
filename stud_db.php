<?php
	include 'connect.php';
	if (isset($_POST['submit'])) 
	{
		
		$name=$_POST['name'] ?? "";
		$email=$_POST['email'] ?? "";
		$gender=$_POST['gender'] ?? "";
		$subject=$_POST['subject'] ?? "";
		$desc=$_POST['description'] ?? "";
		$image = $_FILES["image"]["name"] ?? "";

		$errors = [];

		if ($gender === "") {
        	$errors['gender'] = "Gender is required!";
    	}
	    if ($desc === "") {
	        $errors['description'] = "Description is required!";
	    }

		$required_fields = [
			'name'=>'Name',
			'email'=>'E-Mail',
			'subject'=>'Subject',
			'image'=>'Image',
		];
    	foreach ($required_fields as $field => $label) {
	        if (empty($$field)) { 
	            $errors[$field] = "$label is required!";
	   		}
    	}
	    if (!empty($errors)) {
	        echo json_encode(["status" => "error", "errors" => $errors]);
	        exit();
	    }
		$filename = time() . '_' . $_FILES['image']['name'];
    	$tempname = $_FILES['image']['tmp_name'];
   		$folder = "image/" . $filename;
        move_uploaded_file($tempname, $folder);

    	$qry=mysqli_query($conn,"INSERT INTO student(name,email,gender,subject,image,description)VALUES('".$name."','".$email."','".$gender."','".$subject."','".$filename."','".$desc."')");
    		
    	if ($qry) {
    		echo json_encode(["status" => "success"]);
    	}
    	else{
    		echo json_encode(["status" => "error" , "errors" => ["db" => "database error"]]);
    	}
	}
?>