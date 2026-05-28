<?php
session_start();
include("includes/db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins 
            WHERE username='$username' 
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        $_SESSION['user'] = $user['username'];

        header("Location: index.php");
        exit;

    } else {
        $message = "Invalid Username or Password";
    }
}
?>

<?php include("includes/header.php"); ?>

<style type="text/css">
.gradient-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 18s ease infinite;
}

@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.form-container {
    width: 100%;
    max-width: 480px;
    background: white;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    position: relative;
    overflow: hidden;
}

.form-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 18s ease infinite;
}

.logo {
    text-align: center;
    margin-bottom: 36px;
}

.logo i {
    font-size: 42px;
    background: linear-gradient(90deg, #ee7752, #e73c7e);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 12px;
}

.logo h1 {
    color: #333;
    font-size: 28px;
    font-weight: 700;
}

.logo p {
    color: #666;
    font-size: 15px;
    margin-top: 8px;
}

.form-group {
    margin-bottom: 24px;
    position: relative;
}

.form-group label {
    display: block;
    color: #444;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 500;
}

.input-with-icon {
    position: relative;
}

.input-with-icon i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
    font-size: 18px;
}

.form-control {
    width: 100%;
    padding: 16px 16px 16px 48px;
    background: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    color: #333;
    font-size: 16px;
}

.form-control:focus {
    outline: none;
    border-color: #e73c7e;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(231, 60, 126, 0.2);
}

.checkbox-group {
    display: flex;
    align-items: center;
    margin-bottom: 28px;
}

.checkbox-group input {
    margin-right: 10px;
    width: 18px;
    height: 18px;
}

.checkbox-group label {
    color: #555;
    font-size: 14px;
}

.checkbox-group a {
    color: #099fa0;
    text-decoration: none;
    margin-left: 4px;
    font-weight: 500;
}

.submit-btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(90deg, #0ed0d1, #099fa0);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
}

.message {
    padding: 12px;
    margin-bottom: 18px;
    border-radius: 8px;
    background: #ffe6e6;
    color: #b30000;
    text-align: center;
    font-weight: 500;
}

@media (max-width: 600px) {
    .form-container {
        padding: 30px 24px;
        border-radius: 20px;
    }
}
</style>

<main>
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Login</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">login</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section contact__v2" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">

                    <div class="form-container">
                        <div class="logo">
                            <i class="fas fa-rocket"></i>
                            <h1>Welcome Back</h1>
                            <p>Sign in to your account to continue</p>
                        </div>

                        <?php if ($message != "") { ?>
                            <div class="message"><?php echo $message; ?></div>
                        <?php } ?>

                        <form id="loginForm" method="POST" action="">
                            <div class="form-group">
                                <label for="email">Username</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter username" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
                                </div>
                            </div>

                            <div class="checkbox-group">
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember me for 30 days</label>
                                <a href="changepassword.php">Change password?</a>
                            </div>

                            <button type="submit" class="submit-btn btn btn-primary">Sign In</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>

<?php include("includes/footer.php"); ?>
