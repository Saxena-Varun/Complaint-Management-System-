<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="assets/css/modern-ui.css" rel="stylesheet">
<header class="header black-bg" style="background: rgba(15, 23, 42, 0.82) !important; backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.1); height: 75px; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; position: fixed; width: 100%; top: 0; z-index: 1000;">
            <div class="sidebar-toggle-box" style="background: rgba(255,255,255,0.05); border-radius: 12px; padding: 10px; cursor: pointer; transition: all 0.3s ease;">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation" style="color: #6366f1; font-size: 18px;"></div>
            </div>
            <!--logo start-->
            <a href="dashboard.php" class="logo" style="margin: 0; font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 24px; color: #ffffff; letter-spacing: -1px; text-decoration: none;">COMPLAINT<span style="color: #6366f1;">SYSTEM</span></a>
            <!--logo end-->
            
            <div class="top-menu">
            	<ul class="nav pull-right top-menu" style="margin: 0;">
                    <li><a class="logout" href="logout.php" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: #fff; border: none; padding: 10px 22px; border-radius: 14px; font-weight: 600; font-size: 13px; transition: all 0.4s ease; display: inline-block; text-decoration: none; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);">Logout <i class="fa fa-power-off" style="margin-left: 7px;"></i></a></li>
            	</ul>
            </div>
</header>
<style>
    /* Fix font jittering */
    * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
    }
    body {
        font-family: 'Outfit', sans-serif !important;
    }
</style>