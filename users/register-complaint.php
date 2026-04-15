<?php session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$uid=$_SESSION['id'];
$category=$_POST['category'];
$subcat=$_POST['subcategory'];
$complaintype=$_POST['complaintype'];
$state=$_POST['state'];
$city=$_POST['city'];
$address=$_POST['address'];
$noc=$_POST['noc'];
$complaintdetials=$_POST['complaindetails'];
$compfile=$_FILES["compfile"]["name"];

move_uploaded_file($_FILES["compfile"]["tmp_name"],"complaintdocs/".$_FILES["compfile"]["name"]);
$query=mysql_query("insert into tblcomplaints(userId,category,subcategory,complaintType,state,city,address,noc,complaintDetails,complaintFile) values('$uid','$category','$subcat','$complaintype','$state','$city','$address','$noc','$complaintdetials','$compfile')");
// code for show complaint number
$sql=mysql_query("select complaintNumber from tblcomplaints  order by complaintNumber desc limit 1");
while($row=mysql_fetch_array($sql))
{
 $cmpn=$row['complaintNumber'];
}
$complainno=$cmpn;
echo '<script> alert("Node registered successfully. Core registry reference: "+"'.$complainno.'")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS | Registry Node</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .wrapper { background: #0f172a; min-height: 100vh; padding-top: 100px !important; }
        .page-title { font-weight: 800; font-size: 32px; color: #fff; margin-bottom: 30px; letter-spacing: -1px; }
        
        .form-section-title {
            font-size: 14px;
            font-weight: 700;
            color: #6366f1;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }
        .form-section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(99, 102, 241, 0.2);
            margin-left: 20px;
        }
    </style>

    <script>
function getCat(val) {
  $.ajax({
  type: "POST",
  url: "getsubcat.php",
  data:'catid='+val,
  success: function(data){
    $("#subcategory").html(data);
  }
  });
}

function getCity(val) {
  $.ajax({
  type: "POST",
  url: "get-city.php",
  data:'stateid='+val,
  success: function(data){
    $("#city").html(data);
  }
  });
}
    </script>
  </head>

  <body>

  <section id="container">
<?php include("includes/header.php");?>
<?php include("includes/sidebar.php");?>
      <section id="main-content">
          <section class="wrapper">
          	<h3 class="page-title"><i class="fa fa-bolt" style="color: #6366f1; margin-right: 15px;"></i> Registry Node Initiation</h3>
          	
          	<div class="row">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	
                      <?php if($successmsg) { ?>
                      <div class="alert alert-success" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); color: #10b981; border-radius: 15px;">
                        <b>Success Node:</b> <?php echo htmlentities($successmsg);?>
                      </div>
                      <?php } ?>

                      <?php if($errormsg) { ?>
                      <div class="alert alert-danger" style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); color: #ef4444; border-radius: 15px;">
                        <b>Error Node:</b> <?php echo htmlentities($errormsg);?>
                      </div>
                      <?php } ?>

                      <form class="form-horizontal style-form" method="post" name="complaint" enctype="multipart/form-data">
                          
                          <div class="form-section-title">Categorization</div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Department</label>
                              <div class="col-sm-4">
                                  <select name="category" id="category" class="form-control" onChange="getCat(this.value);" required="">
                                      <option value="">Select Department</option>
                                      <?php $sql=mysql_query("select id,categoryName from category ");
                                      while ($rw=mysql_fetch_array($sql)) { ?>
                                      <option value="<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['categoryName']);?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                              <label class="col-sm-2 control-label">Incident Type</label>
                              <div class="col-sm-4">
                                  <select name="subcategory" id="subcategory" class="form-control" >
                                      <option value="">Select Incident Type</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Priority Class</label>
                              <div class="col-sm-4">
                                  <select name="complaintype" class="form-control" required="">
                                      <option value=" Complaint">Standard Report</option>
                                      <option value="General Query">Informational Node</option>
                                  </select> 
                              </div>
                          </div>

                          <div class="form-section-title">Geographic Data</div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Regional Hub (State)</label>
                              <div class="col-sm-4">
                                  <select name="state" id="state" class="form-control" onChange="getCity(this.value);" required="">
                                      <option value="">Select HUB</option>
                                      <?php $sql=mysql_query("select stateName from state");
                                      while ($rw=mysql_fetch_array($sql)) { ?>
                                      <option value="<?php echo htmlentities($rw['stateName']);?>"><?php echo htmlentities($rw['stateName']);?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                              <label class="col-sm-2 control-label">Registry Sector (City)</label>
                              <div class="col-sm-4">
                                  <select name="city" id="city" class="form-control" required="">
                                      <option value="">Select SECTOR</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Precise Coordinates (Address)</label>
                              <div class="col-sm-10">
                                  <textarea name="address" required="" placeholder="Enter Full Address Registry" class="form-control" rows="3"></textarea>
                              </div>
                          </div>

                          <div class="form-section-title">Incident Analysis</div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Nature of Event</label>
                              <div class="col-sm-10">
                                  <input type="text" name="noc" required="" class="form-control" placeholder="Summary of event...">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Core Evidence Details</label>
                              <div class="col-sm-10">
                                  <textarea name="complaindetails" required="" cols="10" rows="10" class="form-control" placeholder="Detailed technical analysis of the incident..."></textarea>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Visual Artifacts (Files)</label>
                              <div class="col-sm-10">
                                  <input type="file" name="compfile" class="form-control">
                                  <span class="help-block" style="color: #6366f1; font-weight: 600; font-size: 11px; margin-top: 10px;">
                                      <i class="fa fa-info-circle"></i> SYSTEM TIP: UPLOAD GPS-STAMPED PHOTOGRAMS FOR HIGHER SCAN PRIORITY.
                                  </span>
                              </div>
                          </div>

                          <div class="form-group" style="margin-top: 40px; text-align: right;">
                              <div class="col-sm-12">
                                  <button type="submit" name="submit" class="btn btn-primary" style="width: 250px;">Initialize Registry <i class="fa fa-chevron-right" style="margin-left: 10px;"></i></button>
                              </div>
                          </div>

                      </form>
                  </div>
                </div>
          	</div>
		</section>
      </section>
    <?php include("includes/footer.php");?>
  </section>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/common-scripts.js"></script>
  </body>
</html>
<?php } ?>
