<?php
if(!class_exists("DB")){
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper'. DIRECTORY_SEPARATOR .'DB.php';
  }

  if( ! session_id() || session_id() == '' || !isset($_SESSION) ) {
    session_start();
  }

  if(!isset($_SESSION['authorized']) || (isset($_SESSION['authorized']) && $_SESSION['authorized'] != true)){
    header('Location: admin_login.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="includes/css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="includes/css/fonts/font-awesome.min.css">
    </head>
    
    <body class="app sidebar-mini rtl">
        <!-- Navbar-->
        <header class="app-header"><a class="app-header__logo" href="#" style="margin-top:10px;"><img src="resources/images/logo-home.png"></a>
        <!-- Sidebar toggle button<a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a> -->
        <ul class="app-nav">
          <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"><span  style="margin-left:5px"><?php echo $_SESSION['admin_email']; ?></span><span style="padding-left:5px;"><i class="fa fa-caret-down"></i></span></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="admin_logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
        </ul>
        </li>
    </ul>
        </header>
        <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    
    <aside class="app-sidebar">
      <div class="app-sidebar__user" style="padding-left:40px"><img src="resources/images/miniorange.png"  style="width:37.25px; height:50px;" alt="User Image">
        <div style="margin-left:15px;">
          <p class="app-sidebar__user-name">PHP SAML</p>
          <p class="app-sidebar__user-designation">Connector</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="setup.php"><i style="font-size:20px;" class="app-menu__icon fa fa-gear"></i><span class="app-menu__label"><b>Plugin Settings</b></span></a></li>
        <li><a class="app-menu__item" href="how_to_setup.php"><i style="font-size:20px;" class="app-menu__icon fa fa-info-circle"></i><span class="app-menu__label"><b>How to Setup?</b></span></a></li>
        <li><a class="app-menu__item active" href="account.php"><i style="font-size:20px;" class="app-menu__icon fa fa-user"></i><span class="app-menu__label"><b>Account Setup</b></span></a></li>
        <li><a class="app-menu__item" href="support.php"><i style="font-size:20px;" class="app-menu__icon fa fa-support"></i><span class="app-menu__label"><b>Support</b></span></a></li>
              </ul>
    </aside>

    <main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa fa-user"></i>  Account Setup</h1>
            
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Account Setup</a></li>
          </ul>
        </div>

        <p id="saml_message"></p>
        <?php
        require_once "connector.php";
        ?>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="row">
                <div class="col-lg-12">
                <?php
                    if(mo_saml_is_customer_registered()){
                        if(mo_saml_is_customer_license_verified())
                            mo_saml_show_customer_details();
                        else
                            mo_saml_show_verify_license_page();
                    } else {
                    if(DB::get_option( 'mo_saml_verify_customer' ) == 'true'){
                        mo_saml_show_verify_password_page();
                    }
                    else {
                        mo_saml_show_verify_password_page();
                    }
                    }
                ?>
                </div>
                </div>
              </div>
            </div>
        </div>
    </main>
    </body>
</html>