<?php session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{ ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complaint Management System Dashboard">
    <title>CMS | User Dashboard</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .wrapper { background: #0f172a; min-height: 100vh; padding-top: 100px !important; }
        
        .hero-section {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(79, 70, 229, 0.05) 100%), 
                        url('assets/img/dash-bg.png');
            background-size: cover;
            background-position: center;
            border-radius: 30px;
            padding: 60px 40px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 10% 20%, rgba(99, 102, 241, 0.1) 0%, transparent 40%);
        }

        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; }
        
        .neo-card {
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 30px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .neo-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .glow-icon {
            width: 56px; height: 56px;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; color: #6366f1;
            margin-bottom: 20px;
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.1);
        }

        .card-val { font-size: 38px; font-weight: 800; color: #fff; margin-bottom: 5px; }
        .card-title { font-size: 14px; font-weight: 500; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; }

        .pulse {
            position: absolute; top: 25px; right: 25px;
            width: 8px; height: 8px;
            background: #10b981; border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
    </style>
  </head>

  <body>

  <section id="container">
<?php include("includes/header.php");?>
<?php include("includes/sidebar.php");?>
      <section id="main-content">
          <section class="wrapper">

              <div class="hero-section">
                  <div style="position: relative; z-index: 1;">
                      <h1 style="font-weight: 800; font-size: 42px; margin-bottom: 12px; letter-spacing: -1.5px;">Dashboard Overview</h1>
                      <p style="font-size: 18px; color: #cbd5e1; max-width: 600px; line-height: 1.6;">Welcome to the Complaint Management System. Track your reports and monitor their resolution status in real-time.</p>
                  </div>
              </div>

              <div class="stat-grid">
                  
                  <div class="neo-card">
                      <div class="pulse" style="background: #ef4444; box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); animation-name: pulse-red;"></div>
                      <div class="glow-icon"><i class="fa fa-terminal"></i></div>
                      <?php 
                        $rt = mysql_query("SELECT * FROM tblcomplaints where userId='".$_SESSION['id']."' and status is null");
                        $num1 = mysql_num_rows($rt);
                      ?>
                      <div class="card-val"><?php echo htmlentities($num1);?></div>
                      <div class="card-title">Pending Complaints</div>
                  </div>

                  <div class="neo-card">
                      <div class="pulse" style="background: #f59e0b; box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7); animation-name: pulse-orange;"></div>
                      <div class="glow-icon" style="color: #f59e0b; background: rgba(245, 158, 11, 0.1);"><i class="fa fa-random"></i></div>
                      <?php 
                        $status="in Process";                   
                        $rt = mysql_query("SELECT * FROM tblcomplaints where userId='".$_SESSION['id']."' and status='$status'");
                        $num2 = mysql_num_rows($rt);
                      ?>
                      <div class="card-val"><?php echo htmlentities($num2);?></div>
                      <div class="card-title">In-Process</div>
                  </div>

                  <div class="neo-card">
                      <div class="pulse"></div>
                      <div class="glow-icon" style="color: #10b981; background: rgba(16, 185, 129, 0.1);"><i class="fa fa-check-square-o"></i></div>
                      <?php 
                        $status="closed";                   
                        $rt = mysql_query("SELECT * FROM tblcomplaints where userId='".$_SESSION['id']."' and status='$status'");
                        $num3 = mysql_num_rows($rt);
                      ?>
                      <div class="card-val"><?php echo htmlentities($num3);?></div>
                      <div class="card-title">Closed Complaints</div>
                  </div>

              </div>

          </section>
      </section>
  </section>

    <style>
        @keyframes pulse-red { 0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); } 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); } }
        @keyframes pulse-orange { 0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(245, 158, 11, 0); } 100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); } }
    </style>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/common-scripts.js"></script>
  </body>
</html>
<?php } ?>
