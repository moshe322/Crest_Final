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
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
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
            color: #fff;
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
            letter-spacing: 0.5px;
        }

        .logo p {
            color: #666;
            font-size: 15px;
            margin-top: 8px;
            font-weight: 400;
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
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #e73c7e;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(231, 60, 126, 0.2);
        }

        .form-control::placeholder {
            color: #999;
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
            accent-color: #099fa0;
        }

        .checkbox-group label {
            color: #555;
            font-size: 14px;
            cursor: pointer;
        }

        .checkbox-group a {
            color: #099fa0;
            text-decoration: none;
            margin-left: 4px;
            font-weight: 500;
        }

        .checkbox-group a:hover {
            text-decoration: underline;
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
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(231, 60, 126, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        

        .animation-control {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50px;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
            font-size: 14px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border: 1px solid #e0e0e0;
            z-index: 100;
        }

        .animation-control input {
            margin-right: 5px;
            accent-color: #e73c7e;
        }

        .speed-control {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: 10px;
        }

        .speed-control button {
            background: #f0f0f0;
            border: none;
            color: #333;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .speed-control button:hover {
            background: #e0e0e0;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 30px 24px;
                border-radius: 20px;
            }
            
            .social-login {
                flex-direction: column;
            }
            
            .animation-control {
                bottom: 20px;
                right: 20px;
                left: 20px;
                justify-content: center;
                border-radius: 12px;
                background: white;
            }
        }
</style>
        <main>
      
    <!-- Page Title -->
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
    </div><!-- End Page Title -->

    <section class="section contact__v2" id="contact">
          <div class="container">
            <div class="row justify-content-center">
            <div class="col-lg-5 ">
             
         
    <div class="form-container">
        <div class="logo">
            <i class="fas fa-rocket"></i>
            <h1>Welcome Back</h1>
            <p>Sign in to your account to continue</p>
        </div>
        
        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" class="form-control" placeholder="Enter your password" required>
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
        
       

        <script>
          (function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
        </script>

   
  
        
        <?php include("includes/footer.php"); ?>
        
       