<aside>
          <div id="sidebar"  class="nav-collapse " style="background: #0f172a; border-right: 1px solid rgba(255,255,255,0.05); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); padding-top: 80px;">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered" style="margin-bottom: 25px;"><a href="profile.php">
                      <div style="position: relative; display: inline-block;">
                        <img src="assets/img/ui-sam.png" class="img-circle" width="100" style="border: 4px solid rgba(99, 102, 241, 0.2); box-shadow: 0 0 20px rgba(99, 102, 241, 0.15);">
                        <div style="position: absolute; bottom: 10px; right: 10px; width: 14px; height: 14px; background: #10b981; border: 3px solid #0f172a; border-radius: 50%;"></div>
                      </div>
                  </a></p>
                   <?php $query=mysql_query("select fullName from users where userEmail='".$_SESSION['login']."'");
 while($row=mysql_fetch_array($query)) 
 {
 ?> 
              	  <h5 class="centered" style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #f1f5f9; margin-top: 10px; font-size: 17px; letter-spacing: -0.5px;"><?php echo htmlentities($row['fullName']);?></h5>
                  <p class="centered" style="color: #64748b; font-size: 12px; margin-top: -5px; font-weight: 500;">PREMIUM MEMBER</p>
                  <?php } ?>
              	  	
                  <li class="mt">
                      <a href="dashboard.php">
                          <i class="fa fa-th-large"></i>
                           <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="register-complaint.php" >
                          <i class="fa fa-bolt"></i>
                           <span>New Complaint</span>
                      </a>
                    </li>
                  <li class="sub-menu">
                      <a href="complaint-history.php" >
                          <i class="fa fa-archive"></i>
                           <span>View History</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="profile.php" >
                          <i class="fa fa-user-circle"></i>
                          <span>User Profile</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="change-password.php" >
                          <i class="fa fa-key"></i>
                           <span>Change Password</span>
                      </a>
                  </li>
                 
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>