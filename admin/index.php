<?php
session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=md5($_POST['password']);
$ret=mysql_query("SELECT * FROM admin WHERE username='$username' and password='$password'");
$num=mysql_fetch_array($ret);
if($num>0)
{
$extra="change-password.php";
$_SESSION['alogin']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['errmsg']="Invalid Access Credentials";
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Management System | Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
    <style>
        :root {
            --primary: #6366f1;
            --bg-dark: #020617;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-dark);
            color: #fff;
            margin: 0; height: 100vh;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            background-image: radial-gradient(circle at 2px 2px, rgba(99, 102, 241, 0.05) 1px, transparent 0);
            background-size: 40px 40px;
        }

        .auth-container {
            width: 450px;
            padding: 50px;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 32px;
            box-shadow: 0 0 50px rgba(99, 102, 241, 0.1);
            text-align: center;
        }

        .neo-logo { font-size: 2.5rem; font-weight: 800; margin-bottom: 2.5rem; color: #fff; letter-spacing: -1.5px; }
        .neo-logo span { color: var(--primary); }

        .form-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; letter-spacing: -0.5px; }
        .form-sub { color: #64748b; margin-bottom: 2.5rem; font-size: 0.9rem; font-weight: 500; }

        .form-control {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #fff;
            padding: 16px 22px;
            border-radius: 14px;
            width: 100%;
            margin-bottom: 1.5rem;
            font-family: inherit;
            outline: none;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.1);
        }

        .btn-auth {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: #fff;
            border: none;
            padding: 18px;
            border-radius: 14px;
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 11px;
            margin-top: 10px;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.25);
        }

        .btn-auth:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.4);
        }

        .error { color: #ef4444; font-size: 0.85rem; margin-bottom: 1.5rem; font-weight: 600; }
    </style>
  </head>
  <body>
    <div class="auth-container">
        <h1 class="neo-logo">ADMIN <span>PANEL</span></h1>
        
        <h2 class="form-title">Admin Login</h2>
        <p class="form-sub">Please enter your credentials to proceed.</p>

        <?php if($_SESSION['errmsg']) { ?>
            <p class="error"><?php echo $_SESSION['errmsg']; ?><?php $_SESSION['errmsg']=""; ?></p>
        <?php } ?>

        <form method="post">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>

            <button type="submit" name="submit" class="btn-auth">Login</button>
            
            <p style="margin-top: 2rem; font-size: 0.8rem; color: #475569;">
               <a href="../index.html" style="color: inherit; text-decoration: none;"><i class="fa fa-arrow-left"></i> Return to Home</a>
            </p>
        </form>
    </div>
  </body>
</html>