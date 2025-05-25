<!DOCTYPE html>
<html>
<head>
    <?php 
        include ('connect.php');
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Show Data</title>
</head>
<body class="bg-success">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-xl-12 col-12">
                <div class="card p-4">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id']; 
                                    $qry = mysqli_query($conn,"SELECT * FROM student WHERE id = ".$id);
                                    $result = ($qry);
                                    if (mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result); 
                            ?>
                            <img src="image/<?php echo $row['image']; ?>" class="img-thumbnail border-2 mb-3" width="200">
                        </div>
                        <div class="col-md-8">
                            <h1 class="mb-3 fs-2 text-secondary">Student Information</h1>
                            <table class="table">
                                <tr>
                                    <th>First Name:</th>
                                    <td><?php echo $row['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo $row['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td>
                                        <?php 
                                            if ($row['gender'] == 0) {
                                                echo '<span class="badge bg-success">Male</span>';
                                            }
                                            else{
                                                echo '<span class="badge bg-primary">Female</span>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Subject:</th>
                                    <td><?php echo $row['subject']; ?></td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td><?php echo $row['description']; ?></td>
                                </tr>
                            </table>
                            <a class="btn btn-primary fw-bold" href="studentlist.php">Go to List</a>
                        </div>
                        <?php 
                                } 
                            } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>