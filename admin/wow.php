<?php
// include the configuration and functions
include("../inc/config.php");
// we logout from the session
  if (isset($_GET["logout"])){
    $_SESSION["admin"] = NULL;
  }

// we autenticate the admin
if (!isset($_SESSION["admin"])){
  if (isset($_POST["username"]) and isset($_POST["password"])){
    if ($d->CleanString($_POST["username"]) == $config["admin_user"] and $d->CleanString($_POST["password"]) == $config["admin_pass"]){
          $_SESSION["admin"] = 1;
    }else{
      header('Location: https://'.$_SERVER['HTTP_HOST']);
    };
  }else{
      header('Location: https://'.$_SERVER['HTTP_HOST']);
  };
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
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/plugins/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/dist/css/adminlte.css">
  <style type="text/css">
    .container, .container-fluid, .container-sm, .container-md, .container-lg, .container-xl {
        padding-top: 20px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center" style="margin-top: -20px;">
    <img class="animation__shake" src="../img/loading_screen.gif" alt="DogeGardeen" height="161">
    <?php echo $lang["loading"]; ?>
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
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
      <li class="nav-item">
        <a class="nav-link" href="?logout=1" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="wow.php" class="brand-link" style="height: 70px !important;">
      <img src="../img/logo_dgg.png" alt="DogeGarden" style="max-width: 50px">
      <span class="brand-text font-weight-light"><?php echo $lang["admin_logo"]; ?></span>
<?php if ($config["demo"] == 1){ ?>
      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="margin-left:-50px;margin-top:-10px">
        Demo!
      </span>
<?php }; ?>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="padding-top: 20px">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item <?php if ($_GET["d"] == "main" or $_GET["d"] == "pos"){ ?>menu-open<?php }; ?>">
            <a href="?d=pos" class="nav-link <?php if ($_GET["d"] == "pos"){ ?>active<?php }; ?>">
              <i class="nav-icon fas fa fa-mobile nav-icon"></i>
              <p>
               PoS Terminal
                <i class="right fas fa fa-angle-left"></i>
              </p>
            </a>
          </li>

          <li class="nav-item <?php if ($_GET["d"] == "main" or $_GET["d"] == "banners" or $_GET["d"] == "pages" or !isset($_GET["d"])){ ?>menu-open<?php }; ?>">
            <a href="?d=main" class="nav-link <?php if ($_GET["d"] == "main" or $_GET["d"] == "banners" or $_GET["d"] == "pages" or !isset($_GET["d"])){ ?>active<?php }; ?>">
              <i class="nav-icon far fa fa-store nav-icon"></i>
              <p>
                <?php echo $lang["admin_manage_store"]; ?>
                <i class="right fas fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?d=pages" class="nav-link <?php if ($_GET["d"] == "pages"){ ?>active<?php }; ?>">
                  <i class="far fa fa-file-alt nav-icon"></i>
                  <p><?php echo $lang["admin_manage_pages"]; ?></p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?d=banners" class="nav-link <?php if ($_GET["d"] == "banners"){ ?>active<?php }; ?>">
                  <i class="far fa fa-images nav-icon"></i>
                  <p><?php echo $lang["admin_manage_banners"]; ?></p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php if ($_GET["d"] == "categories"){ ?>menu-open<?php }; ?>">
            <a href="#" class="nav-link <?php if ($_GET["d"] == "categories"){ ?>active<?php }; ?>">
              <i class="nav-icon fa fa-th-list nav-icon"></i>
              <p>
                <?php echo $lang["admin_categories"]; ?>
                <i class="right fas fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?d=categories" class="nav-link <?php if ($_GET["d"] == "categories"){ ?>active<?php }; ?>">
                  <i class="far fa fa-stream nav-icon"></i>
                  <p><?php echo $lang["admin_manage_categories"]; ?></p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php if ($_GET["d"] == "products"){ ?>menu-open<?php }; ?>">
            <a href="#" class="nav-link <?php if ($_GET["d"] == "products"){ ?>active<?php }; ?>">
              <i class="nav-icon far fa fa-boxes nav-icon"></i>
              <p>
                <?php echo $lang["admin_products"]; ?>
                <i class="right fas fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?d=products" class="nav-link <?php if ($_GET["d"] == "products"){ ?>active<?php }; ?>">
                  <i class="far fa fa-tags nav-icon"></i>
                  <p><?php echo $lang["admin_manage_products"]; ?></p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php if ($_GET["d"] == "orders" or $_GET["d"] == "shibes"){ ?>menu-open<?php }; ?>">
            <a href="#" class="nav-link <?php if ($_GET["d"] == "orders" or $_GET["d"] == "shibes"){ ?>active<?php }; ?>">
              <i class="nav-icon far fa fa-cart-arrow-down nav-icon"></i>
              <p>
                <?php echo $lang["admin_orders"]; ?>
                <i class="right fas fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?d=orders" class="nav-link <?php if ($_GET["d"] == "orders"){ ?>active<?php }; ?>">
                  <i class="far fas fa-file-invoice nav-icon"></i>
                  <p><?php echo $lang["admin_manage_orders"]; ?></p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?d=shibes" class="nav-link <?php if ($_GET["d"] == "shibes"){ ?>active<?php }; ?>">
                  <i class="far fas fa-users nav-icon"></i>
                  <p><?php echo $lang["admin_manage_shibes"]; ?></p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?d=shipping" class="nav-link <?php if ($_GET["d"] == "shipping"){ ?>active<?php }; ?>">
                  <i class="far fas fa-dolly nav-icon"></i>
                  <p><?php echo $lang["admin_manage_shipping"]; ?></p>
                </a>
              </li>
            </ul>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <?php if (isset($config["fiat"]) and $config["fiat"] != ""){ ?>
        <span class="brand-text font-weight-light">
          <div style="color: #666666; padding: 10px; position: absolute; bottom: 20px;" id="fiat">
          1 &ETH; = <?php echo $d->DogeFiatRates($config["fiat"]); ?> <?php echo strtoupper($config["fiat"]);?><br>
          1 <?php echo strtoupper($config["fiat"]);?> = <?php echo $d->FiatDogeRates("1.00", $config["fiat"]); ?> &ETH;
          </div>
        </span>
    <?php };?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content">
      <div class="container-fluid">
    <?php
    // we check if the file exists befor importing
    if (isset($_GET["d"])){
      $p = $d->CleanString($_GET["d"]);

      if (!file_exists("inc/".$p.".php")) {
          include("inc/main.php");
      }else{
          include("inc/".$p.".php");
      };
    }else{
        include("inc/main.php");
    };

    ?>
    <!-- /.content -->
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <?php echo $lang["copyrigh"]; ?>
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <?php echo $lang["version"]; ?>
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../inc/vendors/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../inc/vendors/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../inc/vendors/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../inc/vendors/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../inc/vendors/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../inc/vendors/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../inc/vendors/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../inc/vendors/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../inc/vendors/AdminLTE/plugins/jszip/jszip.min.js"></script>
<script src="../inc/vendors/AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../inc/vendors/AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../inc/vendors/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../inc/vendors/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../inc/vendors/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Summernote -->
<script src="../inc/vendors/AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE App -->
<script src="../inc/vendors/AdminLTE/dist/js/adminlte.min.js"></script>
<script>
  $(function () {
    $("#tabled").DataTable({
        "language": {
            "paginate": {
              "previous": "<?php echo $lang["previous"];?>",
              "next": "<?php echo $lang["next"];?>"
            },
            "lengthMenu": "<?php echo $lang["lengthMenu"];?>",
            "zeroRecords": "<?php echo $lang["zeroRecords"];?>",
            "info": "<?php echo $lang["data_info"];?>",
            "infoEmpty": "<?php echo $lang["infoEmpty"];?>",
            "infoFiltered": "<?php echo $lang["infoFiltered"];?>"
        },
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "pdf", "print"],
      "order": [[ 0, "desc" ]],
    }).buttons().container().appendTo('#tabled_wrapper .col-md-6:eq(0)');

    // Summernote
    $('#summernote').summernote();

    $("#tabled").on('click','.remove', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        return swal.fire({
        title: "<?php echo $lang["areusure"]; ?>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#CC0000',
        cancelButtonColor: '#666666',
        confirmButtonText: '<?php echo $lang["confirm"]; ?>',
        cancelButtonText: '<?php echo $lang["cancel"]; ?>'
    })
    .then((result) => {
      if (result.isConfirmed) {
        window.location.href = href;
      }
    });

    });



  });
</script>
</body>
</html>