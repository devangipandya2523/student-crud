<?php

	include ('connect.php');


    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    	$id=$_POST['id'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $gender=$_POST['gender'];
        $subject=$_POST['subject'];
        $desc=$_POST['description'];
        $old_image = $_POST['old_image'];

        
        if (!empty($_FILES["image"]["name"])) {  
            $filename = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "image/".$filename;
            move_uploaded_file($tempname,$folder);
        }
        else{
            $filename = $old_image;
        }

        $qry=mysqli_query($conn,"UPDATE student SET name='$name', email='$email', gender='$gender', subject='$subject', description='$desc',image='$filename' WHERE id=".$id);

        if ($qry) {
            echo "success";
        }
        else{
            echo "Error";
        }
    }
?>