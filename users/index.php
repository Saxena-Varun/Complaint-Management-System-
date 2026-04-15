<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(isset($_POST['submit']))
{
$ret=mysql_query("SELECT * FROM users WHERE userEmail='".$_POST['username']."' and password='".md5($_POST['password'])."'");
$num=mysql_fetch_array($ret);
if($num>0)
{
$extra="dashboard.php";
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['errmsg']="Invalid username or password";
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
    <title>Complaint Management System | User Login</title>
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
            width: 1000px;
            height: 600px;
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .auth-visual {
            flex: 1;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(15, 23, 42, 0.8) 100%),
                        url('../dashboard_hightech_final_1776085722281.png');
            background-size: cover;
            background-position: center;
            display: flex; flex-direction: column; justify-content: center; padding: 60px;
        }

        .auth-form-side {
            flex: 1;
            padding: 60px 80px;
            display: flex; flex-direction: column; justify-content: center;
        }

        .neo-logo { font-size: 2rem; font-weight: 800; margin-bottom: 2rem; color: #fff; }
        .neo-logo span { color: var(--primary); }

        .form-title { font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem; }
        .form-sub { color: #94a3b8; margin-bottom: 2.5rem; font-size: 0.95rem; }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 15px 20px;
            border-radius: 14px;
            width: 100%;
            margin-bottom: 1.5rem;
            font-family: inherit;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }

        .btn-auth {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 16px;
            border-radius: 14px;
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-auth:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .reg-link { margin-top: 2rem; text-align: center; color: #94a3b8; font-size: 0.9rem; }
        .reg-link a { color: var(--primary); font-weight: 700; text-decoration: none; }
    </style>
  </head>
  <body>
    <div class="auth-container">
        <div class="auth-visual">
            <h1 class="neo-logo">COMPLAINT <span>SYSTEM</span></h1>
            <h2 style="font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">User Portal Access</h2>
            <p style="color: #cbd5e1; font-size: 1.1rem;">Securely manage and track your complaints online.</p>
        </div>
        <div class="auth-form-side">
            <form method="post">
                <h2 class="form-title">Welcome Back</h2>
                <p class="form-sub">Identify yourself to proceed.</p>

                <?php if($_SESSION['errmsg']) { ?>
                    <p style="color: #ef4444; font-size: 0.85rem; margin-bottom: 1rem;"><?php echo $_SESSION['errmsg']; ?><?php $_SESSION['errmsg']=""; ?></p>
                <?php } ?>

                <input type="email" name="username" class="form-control" placeholder="Email Address" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Password" required>

                <button type="submit" name="submit" class="btn-auth">Login</button>
                
                <div class="reg-link">
                    Don't have an account? <a href="registration.php">Register Here</a>
                </div>
            </form>
        </div>
    </div>
  </body>
</html>
