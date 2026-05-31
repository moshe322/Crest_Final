<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/mail.php';
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$success = "";
$error = "";

if(isset($_POST['submit_application'])){

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$state = $_POST['state'];
$city = $_POST['city'];
$experience = $_POST['experience'];
$industry = $_POST['industry'];
$functional_area = $_POST['area'];
$role = $_POST['role'];
$company = $_POST['company'];
$designation = $_POST['designation'];

$resume = "";

if(
isset($_FILES['resume'])
&&
$_FILES['resume']['error'] == 0
){

$upload_dir = __DIR__ . "/uploads/";

if(!is_dir($upload_dir)){
mkdir($upload_dir,0777,true);
}

$resume =
time() . "_" .
preg_replace(
"/[^a-zA-Z0-9._-]/",
"_",
basename($_FILES['resume']['name'])
);

move_uploaded_file(
$_FILES['resume']['tmp_name'],
$upload_dir . $resume
);

}

$stmt =
$conn->prepare(
"
INSERT INTO job_applications
(
name,
email,
phone,
state,
city,
experience,
industry,
functional_area,
role_name,
company,
designation,
resume
)
VALUES
(
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?
)
"
);

$stmt->bind_param(
"ssssssssssss",
$name,
$email,
$phone,
$state,
$city,
$experience,
$industry,
$functional_area,
$role,
$company,
$designation,
$resume
);

if($stmt->execute()){

$download_link =
"https://crest.deployapp.online/uploads/" . $resume;

try{

$mail =
new PHPMailer(true);

$mail->isSMTP();

$mail->Host =
'smtp.gmail.com';

$mail->SMTPAuth =
true;

$mail->Username =
$mail_username;

$mail->Password =
$mail_password;

$mail->SMTPSecure =
PHPMailer::ENCRYPTION_STARTTLS;

$mail->Port =
587;

$mail->setFrom(
$mail_username,
'CoreCrest HR'
);

$mail->addAddress(
$mail_username,
'CoreCrest Admin'
);

$mail->addReplyTo(
$email,
$name
);

$mail->isHTML(true);

$mail->Subject =
'New Job Application Submitted';

$mail->Body =
"
<h3>New Job Application Received</h3>

<p>
A candidate submitted the job application form.
</p>

<table border='1'
cellpadding='5'
cellspacing='0'
style='border-collapse:collapse;'>

<tr>
<td><b>Name</b></td>
<td>$name</td>
</tr>

<tr>
<td><b>Email</b></td>
<td>$email</td>
</tr>

<tr>
<td><b>Phone</b></td>
<td>$phone</td>
</tr>

<tr>
<td><b>State</b></td>
<td>$state</td>
</tr>

<tr>
<td><b>City</b></td>
<td>$city</td>
</tr>

<tr>
<td><b>Experience</b></td>
<td>$experience</td>
</tr>

<tr>
<td><b>Industry</b></td>
<td>$industry</td>
</tr>

<tr>
<td><b>Functional Area</b></td>
<td>$functional_area</td>
</tr>

<tr>
<td><b>Role</b></td>
<td>$role</td>
</tr>

<tr>
<td><b>Current Company</b></td>
<td>$company</td>
</tr>

<tr>
<td><b>Designation</b></td>
<td>$designation</td>
</tr>

<tr>
<td><b>Resume</b></td>
<td>
<a href='$download_link'>
Download Resume
</a>
</td>
</tr>

</table>

<br>

<p>
Thanks,<br>
CoreCrest HR
</p>
";

$mail->send();

$success =
"Your data submitted successfully.";

}catch(Exception $e){

$success =
"Your data submitted successfully.";

error_log($mail->ErrorInfo);

}

}else{

$error =
"Data not submitted. Please try again.";

}

}

include("includes/header.php");
?>

<main>
      
<div class="page-title light-background">
<div class="container d-lg-flex justify-content-between align-items-center">
<h1 class="mb-2 mb-lg-0">Contact</h1>
<nav class="breadcrumbs">
<ol>
<li><a href="index.php">Home</a></li>
<li class="current">contact</li>
</ol>
</nav>
</div>
</div>

<section class="section contact__v2" id="contact">
<div class="container">
<div class="row d-flex justify-content-center">
<div class="col-md-8">
<div class="form-wrapper" data-aos="fade-up" data-aos-delay="300">

<?php if($success){ ?>

<div id="successMessage"
class="alert alert-success text-center">

<?php echo htmlspecialchars($success); ?>

</div>

<script>
setTimeout(function(){
var msg =
document.getElementById("successMessage");

if(msg){
msg.style.display = "none";
}
},2000);
</script>

<?php } ?>

<?php if($error){ ?>

<div class="alert alert-danger text-center">
<?php echo htmlspecialchars($error); ?>
</div>

<?php } ?>

<form
method="POST"
enctype="multipart/form-data"
id="contactForm"
class="needs-validation apply-job-form"
novalidate>

<div class="row mb-3">

<div class="col-md-6">
<label class="mb-2" for="name">Name</label>
<input class="form-control" id="name" type="text" name="name" required>
</div>

<div class="col-md-6">
<label class="mb-2" for="email">Email</label>
<input class="form-control" id="email" type="email" name="email" required>
</div>

</div>

<div class="row mb-3">

<div class="col-md-6">
<label class="mb-2">Mobile Number</label>
<input class="form-control" id="phone" type="text" name="phone" required>
</div>

<div class="col-md-6">
<label class="mb-2">Select State</label>

<select class="form-select" name="state" required>
<option value="">Select State *</option>
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Odisha">Odisha</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Telangana">Telangana</option>
<option value="Tripura">Tripura</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="West Bengal">West Bengal</option>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Ladakh">Ladakh</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Puducherry">Puducherry</option>
</select>

</div>
</div>

<div class="row mb-3">

<div class="col-md-6">
<label class="mb-2">City</label>
<input class="form-control" id="city" type="text" name="city" required>
</div>

<div class="col-md-6">
<label class="mb-2">Work experience Years</label>
<input class="form-control" id="experience" type="number" name="experience" required>
</div>

</div>

<div class="row mb-3">

<div class="col-md-6">
<label class="mb-2">Industry</label>
<input class="form-control" id="industry" type="text" name="industry" required>
</div>

<div class="col-md-6">
<label class="mb-2">Functional Area</label>
<input class="form-control" id="area" type="text" name="area" required>
</div>

</div>

<div class="row mb-3">

<div class="col-md-6">
<label class="mb-2">Role</label>
<input class="form-control" id="role" type="text" name="role" required>
</div>

<div class="col-md-6">
<label class="mb-2">Current Company</label>
<input class="form-control" id="company" type="text" name="company" required>
</div>

</div>

<div class="row mb-3">

<div class="col-md-6">
<label class="mb-2">Designation</label>
<input class="form-control" id="designation" type="text" name="designation" required>
</div>

<div class="col-md-6">
<label for="formFile" class="form-label">Choose file</label>
<input class="form-control" type="file" name="resume" id="formFile" required>
</div>

</div>

<div class="d-grid gap-2">

<button
class="btn btn-primary fw-semibold btn-lg"
type="submit"
name="submit_application">

Apply Now

</button>

</div>

</form>

</div>
</div>
</div>
</div>
</section>

<script>
(function () {
'use strict';

var forms =
document.querySelectorAll('.needs-validation');

Array.prototype.slice.call(forms)
.forEach(function (form) {

form.addEventListener('submit', function (event) {

if (!form.checkValidity()) {
event.preventDefault();
event.stopPropagation();
}

form.classList.add('was-validated');

}, false);

});

})();
</script>

<?php include("includes/footer.php"); ?>
