<?php
session_start();

$allowed_email =
"chagalamarri85@gmail.com";

if(isset($_POST['admin_login'])){

$email =
trim($_POST['email']);

if(
$email ==
$allowed_email
){

$_SESSION['admin_logged_in'] =
true;

$_SESSION['admin_email'] =
$email;

header(
"Location: admin.php"
);

exit;

}else{

$login_error =
"Access Denied";

}

}

if(
!isset($_SESSION['admin_logged_in'])
){
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1">

<title>
Admin Login
</title>

<link
href="assets/vendors/bootstrap/bootstrap.min.css"
rel="stylesheet">

<style>

body{
background:#f2edf3;
font-family:Arial,sans-serif;
}

.login-box{
margin-top:120px;
max-width:420px;
}

.logo{
width:120px;
margin-bottom:15px;
}

</style>

</head>

<body>

<div
class="container login-box">

<div class="card shadow">

<div class="card-body p-4">

<div class="text-center">

<img
class="logo"
src="assets/images/Core-Crest-logo.png">

<h3 class="mb-4">

Admin Login

</h3>

</div>

<?php
if(isset($login_error)){
?>

<div class="alert alert-danger">

<?php echo $login_error; ?>

</div>

<?php
}
?>

<form method="POST">

<div class="mb-3">

<label>
Enter Admin Email
</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<button
type="submit"
name="admin_login"
class="btn btn-primary w-100">

Enter

</button>

</form>

</div>

</div>

</div>

</body>

</html>

<?php
exit;
}

require_once __DIR__ . '/includes/db.php';

$total_resumes_result = mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM job_applications
WHERE resume IS NOT NULL
AND resume != ''"
);

$total_resumes =
mysqli_fetch_assoc(
$total_resumes_result
);

$total_required_result =
mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM job_applications"
);

$total_required =
mysqli_fetch_assoc(
$total_required_result
);

$total_taken =
array(
"total" => 0
);
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1">

<title>
CORECREST HR SERVICES PRIVATE LIMITED
</title>

<link href="assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

<link href="assets/vendors/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">

<link href="assets/css/style.css" rel="stylesheet">

<link href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap5.css" rel="stylesheet">

<link href="https://cdn.datatables.net/responsive/3.0.8/css/responsive.bootstrap5.css" rel="stylesheet">

<style>

body{
background-color:#f2edf3;
}

.admin-header{
background:#ffffff;
padding:15px 25px;
}

.admin-logo{
width:95px;
}

.logout-link{
font-size:14px;
color:#333;
text-decoration:underline;
}

.card{
border:none;
border-radius:5px;
}

.big-text{
font-size:42px;
font-weight:700;
color:#3f3f52;
}

.table-card{
background:#ffffff;
border-radius:6px;
box-shadow:0 8px 25px rgba(0,0,0,.08);
padding:15px;
}

</style>

</head>

<body>

<div class="site-wrap">

<header class="admin-header">

<div
class="d-flex align-items-center justify-content-between">

<a href="admin.php">

<img
class="admin-logo"
src="assets/images/Core-Crest-logo.png"
alt="CoreCrestHR">

</a>

<a
class="logout-link"
href="admin-logout.php">

Logout

</a>

</div>

</header>

<main>

<section
class="section contact__v2"
style="background-color:#f2edf3;">

<div class="container-fluid mb-3">

<div class="row">

<div class="col-md-4 mb-2">

<div class="card shadow">

<div class="card-body">

<h6>
Resume Uploaded
</h6>

<div class="big-text">

<?php
echo $total_resumes['total'];
?>

</div>

</div>

</div>

</div>

<div class="col-md-4 mb-2">

<div class="card shadow">

<div class="card-body">

<h6>
Applications
</h6>

<div class="big-text">

<?php
echo $total_required['total'];
?>

</div>

</div>

</div>

</div>

<div class="col-md-4 mb-2">

<div class="card shadow">

<div class="card-body">

<h6>
Admin Access
</h6>

<div class="big-text">

1

</div>

</div>

</div>

</div>

</div>

</div>

<div class="container-fluid">

<div class="table-card">

<table
id="example"
class="table table-striped nowrap"
style="width:100%;">

<thead>

<tr>

<th>Name</th>
<th>E-mail</th>
<th>Mobile Number</th>
<th>State</th>
<th>City</th>
<th>Experience</th>
<th>Industry</th>
<th>Current Company</th>
<th>Designation</th>
<th>Download Resume</th>

</tr>

</thead>

<tbody>

<?php

$applications =
mysqli_query(
$conn,
"SELECT * FROM job_applications ORDER BY id DESC"
);

while(
$row =
mysqli_fetch_assoc(
$applications
)
){
?>

<tr>

<td>
<?php echo htmlspecialchars($row['name'] ?? ''); ?>
</td>

<td>
<?php echo htmlspecialchars($row['email'] ?? ''); ?>
</td>

<td>
<?php echo htmlspecialchars($row['phone'] ?? ''); ?>
</td>

<td>
<?php echo htmlspecialchars($row['state'] ?? ''); ?>
</td>

<td>
<?php echo htmlspecialchars($row['city'] ?? ''); ?>
</td>

<td>
<?php echo htmlspecialchars($row['experience'] ?? ''); ?>
</td>

<td>
<?php echo htmlspecialchars($row['industry'] ?? ''); ?>
</td>

<td>
<?php echo htmlspecialchars($row['company'] ?? ''); ?>
</td>

<td>
<?php echo htmlspecialchars($row['designation'] ?? ''); ?>
</td>

<td>

<?php
if(
!empty($row['resume'])
){
?>

<a
href="uploads/<?php echo htmlspecialchars($row['resume']); ?>"
class="btn btn-info btn-sm"
download>

Download

<i class="bi bi-cloud-arrow-down-fill"></i>

</a>

<?php
}else{
?>

<span class="badge bg-danger">

No Resume

</span>

<?php
}
?>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>

</section>

</main>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>

<script src="https://cdn.datatables.net/2.3.8/js/dataTables.bootstrap5.js"></script>

<script src="https://cdn.datatables.net/responsive/3.0.8/js/dataTables.responsive.js"></script>

<script src="https://cdn.datatables.net/responsive/3.0.8/js/responsive.bootstrap5.js"></script>

<script>

new DataTable(
'#example',
{
responsive:true
}
);

</script>

</body>

</html>
