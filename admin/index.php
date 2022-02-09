<?php
// include the configuration and functions
include("../inc/config.php");
if (isset($_SESSION["admin"])){
  header('Location: https://'.$_SERVER['HTTP_HOST'].'/LaB/admin/wow.php');
  exit;
};
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $lang["admin_title"]; ?></title>
  <meta name="description" content="<?php echo $lang["admin_description"]; ?>">
  <meta name="author" content="<?php echo $lang["author"]; ?>">
  <meta name="generator" content="<?php echo $lang["generator"]; ?>">
  <link href="../img/logo_dg.png" rel="icon" />

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- flag-icon-css -->
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/plugins/flag-icon-css/css/flag-icon.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/dist/css/adminlte.css">

  <style type="text/css">
  .lockscreen-image {
      left: -30px;
      top: -2px;
  }
  </style>
</head>
<body class="hold-transition lockscreen">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center" style="margin-top: -20px">
    <img class="animation__shake" src="../img/loading_screen.gif" alt="DogeGardeen" height="161">
    <?php echo $lang["loading"]; ?>
  </div>

<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
        <ul class="navbar-nav ml-auto">
      <!-- Language Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="flag-icon flag-icon-<?php if ($_SESSION["l"] == "EN"){ echo "gb"; }else{ echo strtolower($_SESSION["l"]); };?>"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right p-0">
          <a href="?l=EN" class="dropdown-item <?php if ($_SESSION["l"] == "EN"){ echo "active"; }; ?>">
            <i class="flag-icon flag-icon-gb mr-2"></i> English
          </a>
          <a href="?l=DE" class="dropdown-item <?php if ($_SESSION["l"] == "DE"){ echo "active"; }; ?>">
            <i class="flag-icon flag-icon-de mr-2"></i> German
          </a>
          <a href="?l=FR" class="dropdown-item <?php if ($_SESSION["l"] == "FR"){ echo "active"; }; ?>">
            <i class="flag-icon flag-icon-fr mr-2"></i> French
          </a>
          <a href="?l=ES" class="dropdown-item <?php if ($_SESSION["l"] == "ES"){ echo "active"; }; ?>">
            <i class="flag-icon flag-icon-es mr-2"></i> Spanish
          </a>
          <a href="?l=PT" class="dropdown-item <?php if ($_SESSION["l"] == "PT"){ echo "active"; }; ?>">
            <i class="flag-icon flag-icon-pt mr-2"></i> Português
          </a>
        </div>
      </li>
    </ul>
  </div>
  <!-- User name -->

  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="../img/logo_dgg.png" alt="DogeGarden">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" action="wow.php" method="post">
      <div class="input-group">
        <input type="text" name="username" class="form-control" placeholder="<?php echo $lang["username"]; ?>">

        <div class="input-group-append">
          <button type="button" class="btn">
            <i class="fas fa-users text-muted"></i>
          </button>
        </div>
      </div>
      <div class="input-group">
        <input type="password" name="password" class="form-control" placeholder="<?php echo $lang["password"]; ?>">

        <div class="input-group-append">
          <button type="submit" class="btn">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->

  <div class="lockscreen-footer text-center">
    <?php echo $lang["copyrigh"]; ?><br><?php echo $lang["version"]; ?>
  </div>
</div>
<!-- /.center -->


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../inc/vendors/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../inc/vendors/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="../inc/vendors/AdminLTE/dist/js/adminlte.min.js"></script>

</body>
</html>