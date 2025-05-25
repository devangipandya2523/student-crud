<!DOCTYPE html>
<html>
<head>
	<?php 
		include ('connect.php');
	?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Student List</title>
</head>
<body class="bg-primary">
	<div class="container py-5">
		<div class="row">
			<div class="bg-white">
				<div class="col-md-12 mt-3">
					<a class="btn btn-primary float-end fw-bold px-4 py-2" href="stud.php"><i class="fa-solid fa-plus"></i></a>
					<h1 class="fw-bold text-center fs-2">
						Student Data List
					</h1>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>E-Mail</th>
								<th>Gender</th>
								<th>Subject</th>
								<th>Image</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                        	<?php
	                            $qry = mysqli_query($conn,"SELECT * FROM student ORDER BY id ASC");
	                            $result =($qry);

	                            while ($row = mysqli_fetch_assoc($result)) { ?>
	                                <tr id="row_<?php echo $row['id'];  ?>">
	                                	<td><?php echo $row['id']; ?></td>
	                                    <td><?php echo $row['name']; ?></td>
	                                    <td><?php echo $row['email']; ?></td>
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
	                                    <td><?php echo $row['subject']; ?></td>
	                                    <td>
	                                        <img src="image/<?php echo $row['image']; ?>" width="50">
	                                    </td>
	                                    <td><?php echo $row['description']; ?></td>
	                                    <td class="d-flex">
	                                    	<?php 
	                                    		echo "<a href='edit.php?id={$row['id']}' class='btn btn-primary btn-sm mx-1 fw-bold'>Edit</a>";
	                                    		echo "<a href='show.php?id={$row['id']}' class='btn btn-success btn-sm mx-1 fw-bold'>Show</a>";
	                                    	?>
	                                    	<button class="btn btn-danger btn-sm mx-1 fw-bold" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteStudent(<?php echo $row['id']; ?>)">Delete</button>
	                                    </td>
	                                </tr>
	                        <?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
		function deleteStudent(id) {
			if (confirm("Are you sure you want to delete this record ?")) {
				$.ajax({
					url: "delete.php",
					type: "POST",
					data: {id:id},
					success:function(response) {
						if (response == "success") {
							$("#row_" + id).remove();
						}
						else{
							alert("Error");
						}
					}
				});
			}
		}
	</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>