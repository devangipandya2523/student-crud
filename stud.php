<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Data From</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="mediaquery.css">
</head>
<body class="bg-primary">
	<div class="container py-5 px-5">
		<div class="row">
			<div class="bg-white">
				<div class="col-md-12 mt-3">
					<a class="btn btn-primary float-end fw-bold" href="studentlist.php">Back</a>
					<h1 class="fw-bold text-center fs-2">
						Student Data Form
					</h1>
				</div>
				<form id="studentForm" enctype="multipart/form-data" class="px-5">
                	<div class="row mt-3">
                        <div class="col-md-6 mb-3 mt-3">
                            <div class="form-group">
                            	<label class="form-label fw-bold text-secondary">Your Name:</label>
                                <input type="text" class="form-control form-container" id="name" name="name" required placeholder="Enter Your Name">
                                <span class="text-danger fw-bold error" id="nameError"></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 mt-3">
                            <div class="form-group">
                            	<label class="form-label fw-bold text-secondary">
    								Your E-Mail:
  								</label>
                                <input type="email" class="form-control form-container" id="email" name="email" required placeholder="Enter Your Email Address">
                                <span class="text-danger fw-bold error" id="emailError"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 mt-3">
                        	<label class="form-label fw-bold text-secondary">
    							Gender:
  							</label><br>
                        	<input class="form-check-input" type="radio" name="gender" id="male" value="0">
  							<label class="form-label">
    							Male
  							</label>
  							<input class="form-check-input" type="radio" name="gender" id="female" value="1">
  							<label class="form-label">
    							Female
  							</label>
  							<span class="text-danger fw-bold error" id="genderError"></span>
                        </div>
                        <div class="col-md-6 mb-3 mt-3">
                        	<label class="form-label fw-bold text-secondary">
    							Subjects:
  							</label><br>
                        	<select class="form-select form-container" name="subject" id="subject" required>
  								<option selected disabled>Choose Subjects</option>
  								<option value="English">English</option>
  								<option value="Maths">Maths</option>
  								<option value="Hindi">Hindi</option>
							</select>
							<span class="text-danger fw-bold error" id="subjectError"></span>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6 mb-3 mt-3">
                    		<label class="form-label fw-bold text-secondary">Upload Image:</label>
                            <input type="file" class="form-control form-container" id="image" name="image" required>
                            <span class="text-danger fw-bold error" id="imageError"></span>
                    	</div>
                    	<div class="col-md-6 mb-3 mt-3">
                    		<label class="form-label fw-bold text-secondary">Description:</label>
                            <textarea class="form-control form-container" rows="4" placeholder="Write your description...." name="description"></textarea>
                            <span class="text-danger fw-bold error" id="descriptionError"></span>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12 mb-3 mt-3 text-center">
                    		<button class="btn btn-primary butn fw-bold" type="button" name="submit" value="submit" id="submitBtn">Submit</button>
                    	</div>
                    </div>
                </form>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#submitBtn").click(function(){
				$(".error").text("");

				var formData = new FormData($("#studentForm")[0]);
				formData.append("submit", "submit");

				$.ajax({
					url: 'stud_db.php',
					type: 'POST',
					data: formData,
					contentType: false,
					processData: false,
					success:function(response){
						var result = JSON.parse(response);

		                if (result.status === "error") {
		                    Object.keys(result.errors).forEach(key => {
		                        $("#" + key + "Error").text(result.errors[key]);
		                    });
		                }
						else if (result.status === "success") {
							alert("Record Added!");
							window.location.href = "studentlist.php";
						}
					}
				});
			});
		});
	</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>