<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS | Ledger History</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .wrapper { background: #0f172a; min-height: 100vh; padding-top: 100px !important; }
        .page-title { font-weight: 800; font-size: 32px; color: #fff; margin-bottom: 30px; letter-spacing: -1px; }
        
        .status-pill {
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .pill-pending { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); }
        .pill-process { background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2); }
        .pill-closed { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }

        .btn-view {
            background: rgba(99, 102, 241, 0.1);
            color: #6366f1;
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 10px;
            padding: 8px 16px;
            font-weight: 600;
            font-size: 12px;
            transition: all 0.3s ease;
        }
        .btn-view:hover {
            background: #6366f1;
            color: #fff;
            transform: translateX(3px);
        }

        .ledger-table thead th { border-bottom: 1px solid rgba(255,255,255,0.05) !important; }
    </style>
  </head>

  <body>

  <section id="container" >
<?php include("includes/header.php");?>
<?php include("includes/sidebar.php");?>

      <section id="main-content">
          <section class="wrapper">
          	<h3 class="page-title"><i class="fa fa-archive" style="color: #6366f1; margin-right: 15px;"></i> Ledger History</h3>
		  		<div class="row">
			  		<div class="col-lg-12">
                      <div class="content-panel">
                          <section id="unseen">
                            <table class="table ledger-table">
                              <thead>
                              <tr>
                                  <th>Registry ID</th>
                                  <th>Initiation Date</th>
                                  <th>Last Sync</th>
                                  <th>Status Node</th>
                                  <th style="text-align: right;">Action</th>
                              </tr>
                              </thead>
                              <tbody>
  <?php $query=mysql_query("select * from tblcomplaints where userId='".$_SESSION['id']."' order by regDate desc");
while($row=mysql_fetch_array($query))
{
  ?>
                              <tr>
                                  <td style="font-weight: 700; color: #fff;">#<?php echo htmlentities($row['complaintNumber']);?></td>
                                  <td><?php echo date('d M, Y', strtotime($row['regDate']));?></td>
                                 <td><?php echo ($row['lastUpdationDate']) ? date('d M, Y', strtotime($row['lastUpdationDate'])) : 'Awaiting Update'; ?></td>
                                  <td><?php 
                                    $status=$row['status'];
                                    if($status=="" or $status=="NULL") { echo '<span class="status-pill pill-pending">Pending</span>'; }
                                    if($status=="in process"){ echo '<span class="status-pill pill-process">Processing</span>'; }
                                    if($status=="closed") { echo '<span class="status-pill pill-closed">Resolved</span>'; }
                                    ?>
                                  </td>
                                   <td style="text-align: right;">
                                   <a href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']);?>">
                                    <button type="button" class="btn btn-view">Access Node <i class="fa fa-arrow-right" style="margin-left: 5px;"></i></button></a>
                                   </td>
                                </tr>
                              <?php } ?>
                              </tbody>
                          </table>
                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-12 -->			
		  	</div><!-- /row -->
		</section>
      </section>
  </section>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/common-scripts.js"></script>
  </body>
</html>
<?php } ?>
