<?php
    include ('connect.php');

    if (isset($_GET['id'])) {
        $id=$_GET['id'];
    
        $qry=mysqli_query($conn,"SELECT *FROM student WHERE id=".$id);
        $result=($qry);

        if (mysqli_num_rows($result)>0) {
            $row=mysqli_fetch_assoc($result);
        }
        else{
            echo "Record not found";
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="bg-secondary">
    <div class="container py-5 px-5">
        <div class="row">
            <div class="bg-white">
                <div class="col-md-12 mt-3">
                    <h1 class="fw-bold text-center fs-2">
                        Update Record
                    </h1>
                </div>
                <form id="editForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
                    <div class="row mt-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 mt-3">
                            <div class="form-group">
                                <label class="form-label fw-bold text-secondary">Your Name:</label>
                                <input type="text" class="form-control form-container" id="name" name="name" required value="<?php echo $row['name']; ?>">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 mt-3">
                            <div class="form-group">
                                <label class="form-label fw-bold text-secondary">
                                    Your E-Mail:
                                </label>
                                <input type="email" class="form-control form-container" id="email" name="email" required value="<?php echo $row['email']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 mt-3">
                            <label class="form-label fw-bold text-secondary">
                                Gender:
                            </label><br>
                            <input class="form-check-input" type="radio" name="gender" value="0"<?php if($row['gender'] == 0) echo "checked"; ?>>
                            <label class="form-label">
                                Male
                            </label>
                            <input class="form-check-input" type="radio" name="gender" value="1" <?php if($row['gender'] == 1) echo "checked"; ?>>
                            <label class="form-label">
                                Female
                            </label>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 mt-3">
                            <label class="form-label fw-bold text-secondary">
                                Subjects:
                            </label><br>
                            <select class="form-select form-container" name="subject" required>
                                <option value="English" <?php if($row['subject'] == "English") echo "selected"; ?>>English</option>
                                <option value="Maths" <?php if($row['subject'] == "Maths") echo "selected"; ?>>Maths</option>
                                <option value="Hindi" <?php if($row['subject'] == "Hindi") echo "selected"; ?>>Hindi</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 mt-3">
                            <label class="form-label fw-bold text-secondary">Your Image:</label>
                            <input type="file" class="form-control form-container" name="image">
                            <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>"> 
                            <img src="image/<?php echo $row['image']; ?>" class="img-thumbnail border-2 mt-2" width="150">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 mt-3">
                            <label class="form-label fw-bold text-secondary">Description:</label>
                            <textarea class="form-control form-container" name="description" rows="4"><?php echo $row['description']; ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3 mt-3">
                            <button type="button" id="updateBtn" class="btn btn-primary updte">Update</button>
                            <a href="studentlist.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#updateBtn").click(function(){
                var formData = new FormData($("#editForm")[0]);

                $.ajax({
                    url: 'studedit_db.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if (response.trim() == "success") {
                            alert("Record Updated!");
                            window.location.href = 'studentlist.php';
                        }
                        else{
                            alert("Error");
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>