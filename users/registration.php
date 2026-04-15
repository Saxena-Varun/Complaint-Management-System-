<?php
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
	$fullname=$_POST['fullname'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$contactno=$_POST['contactno'];
	$status=1;
	$query=mysql_query("insert into users(fullName,userEmail,password,contactNo,status) values('$fullname','$email','$password','$contactno','$status')");
	$msg="Registration successful. You can now login!";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Management System | User Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
    <style>
        :root {
            --primary: #6366f1;
            --bg-dark: #0f172a;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-dark);
            color: #fff;
            margin: 0; height: 100vh;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }

        .auth-container {
            display: flex;
            width: 1100px;
            height: 700px;
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .auth-visual {
            flex: 1.2;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(15, 23, 42, 0.8) 100%),
                        url('../registration_visual_1776081187850.png');
            background-size: cover;
            background-position: center;
            display: flex; flex-direction: column; justify-content: center; padding: 60px;
        }

        .auth-form-side {
            flex: 1;
            padding: 40px 70px;
            display: flex; flex-direction: column; justify-content: center;
            overflow-y: auto;
        }

        .neo-logo { font-size: 2rem; font-weight: 800; margin-bottom: 2rem; color: #fff; }
        .neo-logo span { color: var(--primary); }

        .form-title { font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem; }
        .form-sub { color: #94a3b8; margin-bottom: 2rem; font-size: 0.95rem; }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 14px 20px;
            border-radius: 12px;
            width: 100%;
            margin-bottom: 1.2rem;
            font-family: inherit;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.08);
        }

        .btn-auth {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        .btn-auth:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .reg-link { margin-top: 1.5rem; text-align: center; color: #94a3b8; font-size: 0.9rem; }
        .reg-link a { color: var(--primary); font-weight: 700; text-decoration: none; }
    </style>
    <script>
        function userAvailability() {
            jQuery.ajax({
                url: "check_availability.php",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status1").html(data);
                }
            });
        }
    </script>
  </head>
  <body>
    <div class="auth-container">
        <div class="auth-visual">
            <h1 class="neo-logo">COMPLAINT <span>SYSTEM</span></h1>
            <h2 style="font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">Create an Account</h2>
            <p style="color: #cbd5e1; font-size: 1.1rem;">Register to track and manage your complaints online.</p>
        </div>
        <div class="auth-form-side">
            <form method="post">
                <h2 class="form-title">User Registration</h2>
                <p class="form-sub">Enter your details below to get started.</p>

                <?php if($msg) { ?>
                    <p style="color: #10b981; font-size: 0.85rem; margin-bottom: 1rem;"><?php echo $msg; ?></p>
                <?php } ?>

                <input type="text" name="fullname" class="form-control" placeholder="Full Name" required autofocus>
                <input type="email" name="email" id="email" onBlur="userAvailability()" class="form-control" placeholder="Email Address" required>
                <span id="user-availability-status1" style="font-size:11px; display: block; margin-top: -12px; margin-bottom: 10px;"></span>
                
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <input type="text" name="contactno" maxlength="10" class="form-control" placeholder="Contact Number" required>

                <button type="submit" name="submit" id="submit" class="btn-auth">Register</button>
                
                <div class="reg-link">
                    Already have an account? <a href="index.php">Login Here</a>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/jquery.js"></script>
  </body>
</html>
