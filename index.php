<?php
// include the configuration and functions
include("inc/config.php");

// check if its installed and configured
if(isset($config["rpcuser"]) and $config["rpcuser"] == "" ){
    $url = 'http'.(isset($_SERVER['HTTPS'])?'s':'').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $url_details = parse_url($url);
    header('Location: http'.(isset($_SERVER['HTTPS'])?'s':'').'://'.$_SERVER['HTTP_HOST'].$url_details['path'].'install');
    exit;
};

// check if shibe is loged in
if(isset($_SESSION["shibe"]) and $_SESSION["shibe"] > 0){
    $row = $pdo->query("SELECT name,email,country FROM shibes where id = '".$_SESSION["shibe"]."' and active = 1 limit 1")->fetch();
    $shibe["name"] = explode(" ",$row["name"]);
    $shibe["name"] = $shibe["name"][0];
    $shibe["email"] = $row["email"];
    $shibe["country"] = $row["country"];
}

?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $lang["store_title"]; ?></title>
  <meta name="description" content="<?php echo $lang["store_description"]; ?>">
  <meta name="author" content="<?php echo $lang["author"]; ?>">
  <meta name="generator" content="<?php echo $lang["generator"]; ?>">
  <link href="img/logo_dg.png" rel="icon" />

  <link rel="stylesheet" href="inc/vendors/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="inc/vendors/AdminLTE/plugins/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="inc/vendors/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="inc/vendors/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="inc/vendors/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="inc/vendors/AdminLTE/plugins/summernote/summernote-bs4.min.css">
    <!-- Theme style -->
  <link rel="stylesheet" href="inc/vendors/AdminLTE/dist/css/adminlte.css">
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
    <img class="animation__shake" src="img/loading_screen.gif" alt="DogeGardeen" height="161">
    <?php echo $lang["loading"]; ?>
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
                  <?php
                      $db = $pdo->query("SELECT * FROM pages where type = 0 and id_page = 0 and lang = '".$_SESSION["l"]."' and active = 1 order by ord ASC");
                      while ($row = $db->fetch()) {
                  ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="?d=page&page=<?php echo $row["id"]; ?>" class="nav-link"><?php echo $row["title"]; ?></a>
      </li>
                  <?php
                  };
                  ?>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown dogeh">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa fa-ellipsis-h"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                  <?php
                      $db = $pdo->query("SELECT * FROM pages where type = 0 and id_page = 0 and lang = '".$_SESSION["l"]."' and active = 1 order by ord ASC");
                      while ($row = $db->fetch()) {
                  ?>
                    <a href="?d=page&page=<?php echo $row["id"]; ?>" class="dropdown-item">
                      <i class="fas fa fa-angle-right mr-2"></i> <?php echo $row["title"]; ?>
                    </a>
                    <div class="dropdown-divider"></div>
                  <?php
                  };
                  ?>
        </div>
      </li>

      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" id="fetch" type="search" placeholder="<?php echo $lang["fetch"]; ?>" aria-label="<?php echo $lang["fetch"]; ?>">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search" onclick='$("#fetchresultscard").hide();'>
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

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
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa fa-shopping-cart"></i><span class="badge badge-danger navbar-badge" id="cartqty">0</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
    <a href="index.php" class="brand-link" style="height: 70px !important">
      <img src="img/logo_dgg.png" alt="DogeGarden" style="max-width: 50px">
      <span class="brand-text font-weight-light"><?php echo $lang["store_logo"]; ?></span>
<?php if ($config["demo"] == 1){ ?>
      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="padding-top:-10px">
        Demo!
      </span>
<?php }; ?>
      <!-- <span class="brand-text font-weight-light" style="font-size: 10px"><?php echo $lang["store_slogan"]; ?></span> -->
    </a>
    <!-- Sidebar -->
    <div class="sidebar" style="padding-top: 20px">
      <!-- Sidebar user panel (optional) -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<?php if(!isset($_SESSION["shibe"])){ ?>
          <li class="nav-item" style="border-bottom: 1px solid #666666">
            <a href="#" class="nav-link btn-light" style="color: #333333">
              <i class="nav-icon far fa fa-user-lock nav-icon"></i>
              <p>
                <?php echo $lang["login"]; ?>
                <i class="right fas fa fa-angle-left"></i>
              </p>
            </a>
        <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?d=login" class="nav-link active">
                  <i class="nav-icon far fa fa-user-lock"></i>
                  <p><?php echo $lang["login"]; ?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?d=shibe&do=insert" class="nav-link active">
                  <i class="nav-icon far fa fa-id-card"></i>
                  <p><?php echo $lang["register"]; ?></p>
                </a>
              </li>
          </li>
        </ul>
        </li>
<?php }else{ ?>
          <li class="nav-item" style="border-bottom: 1px solid #666666">
            <a href="#" class="nav-link btn-light" style="color: #333333">
              <i class="nav-icon far fa fa-user-lock nav-icon"></i>
              <p>
                Such, <?php echo $shibe["name"]; ?>
                <i class="right fas fa fa-angle-left"></i>
              </p>
            </a>
        <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?d=shibe&do=update" class="nav-link active">
                  <i class="nav-icon far fa fa-id-card"></i>
                  <p><?php echo $lang["manage"]; ?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?d=orders" class="nav-link active">
                  <i class="far fas fa-file-invoice nav-icon"></i>
                  <p><?php echo $lang["orders"]; ?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?d=shibe&do=logout" class="nav-link active">
                  <i class="nav-icon far fa fa-user-lock"></i>
                  <p><?php echo $lang["logout"]; ?></p>
                </a>
              </li>
          </li>
        </ul>
        </li>
<?php }; ?>


                  <?php
                      $db = $pdo->query("SELECT id,icon,title FROM categories where id_cat = 0 and lang = '".$_SESSION["l"]."' and active = 1 order by ord ASC");
                      while ($row = $db->fetch()) {
                        $active = "";
                        // we find the category associeted with the product
                        if (isset($_GET["product"])){
                          $dbmp = $pdo->query("SELECT id_cat FROM products where id = '".$d->CleanString($_GET["product"])."' and active = 1 limit 1")->fetch();
                          $dbm = $pdo->query("SELECT id FROM categories where id = '".$dbmp["id_cat"]."' and id_cat = '".$row["id"]."' and lang = '".$_SESSION["l"]."' and active = 1 limit 1")->fetch();
                          if ($dbm["id"] > 0){
                            $active = "active";
                          };
                        }else{
                            // we find the category associeted with the sub category
                            if (isset($_GET["c"])){
                              $dbm = $pdo->query("SELECT id FROM categories where id = '".$d->CleanString($_GET["c"])."' and id_cat = '".$row["id"]."' and lang = '".$_SESSION["l"]."' and active = 1 limit 1")->fetch();
                              if ($dbm["id"] > 0){
                                $active = "active";
                              };
                            };
                        };

                  ?>

          <li class="nav-item">
            <a href="?d=products&c=<?php echo $row["id"]; ?>" class="nav-link <?php echo $active; ?>" >
              <i class="nav-icon far fa fa-<?php echo $row["icon"]; ?> nav-icon"></i>
              <p>
                <?php echo $row["title"]; ?>
                <i class="right fas fa fa-angle-left"></i>
              </p>
            </a>
                  <?php
                      $dbs = $pdo->query("SELECT id,icon,title FROM categories where id_cat = '".$row["id"]."' and lang = '".$_SESSION["l"]."' and active = 1 order by ord ASC");
                      while ($rows = $dbs->fetch()) {
                        $active = "";
                        // we find the category associeted with the product
                        if (isset($_GET["product"])){
                          if ($dbmp["id_cat"] == $rows["id"]){
                            $active = "active";
                          };
                        }else{
                            // we find the category associeted with the sub category
                            if (isset($_GET["c"])){
                            if ($_GET["c"] == $rows["id"]){
                                $active = "active";
                              };
                            };
                        };
                  ?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?d=products&c=<?php echo $rows["id"]; ?>" class="nav-link  <?php echo $active; ?>">
                  <i class="far fa fa-<?php echo $rows["icon"]; ?> nav-icon"></i>
                  <p>
                <?php echo $rows["title"]; ?>
                  </p>
                </a>
              </li>
            </ul>
                  <?php }; ?>
          </li>
                  <?php }; ?>



          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa fa-wallet nav-icon"></i>
              <p>
                <?php echo $lang["wallets"]; ?>
                <i class="right fas fa fa-angle-left"></i>
              </p>
            </a>
        <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="https://dogecoin.com/" target="_blank" class="nav-link">
                  <i class="nav-icon far fa fa-dog"></i>
                  <p><?php echo $lang["corewallet"]; ?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="https://mydoge.com/" target="_blank" class="nav-link">
                  <i><img class="img-circle elevation-2" src="img/mydoge.png" style="max-width: 25px">&nbsp;&nbsp;</i>
                  <p><?php echo $lang["mydogewallet"]; ?></p>
                </a>
              </li>
          </li>
        </ul>
          </li>
                  <?php
                      $db = $pdo->query("SELECT * FROM pages where type = 1 and id_page = 0 and lang = '".$_SESSION["l"]."' and active = 1 order by ord ASC");
                      while ($row = $db->fetch()) {
                  ?>
                   <li class="nav-item">
                      <a href="?d=page&page=<?php echo $row["id"]; ?>" class="nav-link <?php if ($_GET["page"] == $row["id"]){ echo "active"; }; ?>">
                        <i class="nav-icon far fa fa-angle-right"></i>
                        <p>
                          <?php echo $row["title"]; ?>
                        </p>
                      </a>
                    </li>
                  <?php
                  };
                  ?>


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
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
            <div class="card" style="display: none" id="fetchresultscard">
              <div class="card-header">
                <h3 class="card-title"><li class="far fa fa-dog"></li> <?php echo $lang["fetch"]; ?> <li class="fa fas fa-search"></li> </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row" id="fetchresults">
                </div>
              </div>
            </div>


        <?php

            $filter = "id_cat = 0 and id_prod = 0 and id_page = 0";
            if (isset($_GET["c"])){ $filter = "id_cat = ".$d->CleanString($_GET["c"]); };
            if (isset($_GET["product"])){ $filter = "id_prod = ".$d->CleanString($_GET["product"]); };
            if (isset($_GET["page"])){ $filter = "id_page = ".$d->CleanString($_GET["page"]); };

            $bd = $pdo->query("SELECT * FROM banners where lang = '".$_SESSION["l"]."' and ".$filter." and active = 1")->fetch();
            if (isset($bd["id"])){
         ?>
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="carouselDogeIndicators" class="carousel slide pointer-event" data-ride="carousel">
                    <ol class="carousel-indicators">
                  <?php
                      $i = 0;
                      $db = $pdo->query("SELECT * FROM banners where lang = '".$_SESSION["l"]."' and ".$filter." and active = 1");
                      while ($row = $db->fetch()) {
                  ?>
                      <li data-target="#carouselDogeIndicators" data-slide-to="<?php echo $i; ?>" class="<?php if ($i == 0){ ?>active<?php };?>"></li>
                  <?php
                  $i++;
                  };
                  ?>
                    </ol>
                    <div class="carousel-inner" style="max-height: 300px;">

                  <?php
                      $i = 0;
                      $db = $pdo->query("SELECT * FROM banners where lang = '".$_SESSION["l"]."' and ".$filter." and active = 1");
                      while ($row = $db->fetch()) {
                  ?>
                      <div class="carousel-item <?php if ($i == 0){ ?>active<?php };?>" style="background-image: url(fl/<?php echo $row["img"]; ?>); background-size: cover; background-position: center; background-repeat: no-repeat">
                      <?php
                      if ($row["video"] != ""){
                      ?>
                      <div style="position: absolute; width: 100%;height: 56.25vw !important;margin-top: -5.9vw;">
                        <div data-video="data-video" data-autoplay="true" data-hide-controls="true" data-loop="true" class="video-block" style="position: absolute;height: 100%;width: 100%;margin: 0;padding: 0;">
                            <iframe src="<?php echo $row["video"];?>?rel=0&controls=0&showinfo=0&wmode=opaque&autoplay=1&modestbranding=1&loop=1&mute=1" width="100%" height="100%" class="video-block__media" style="opacity: 1; transition: opacity 0.5s ease-in-out 0s;" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture; playlist; loop" ></iframe>
                        </div>
                      </div>
                      <div style=" width: 100%; min-height: 300px;">&nbsp;</div>
                        <?php
                        }else{
                        ?>
                        <img src="fl/<?php echo $row["img"]; ?>" style="width: 100%">
<!--                        <div style=" width: 100%; min-height: 300px;">&nbsp;</div>-->
                        <?php
                        };
                        ?>
                      </div>
                  <?php
                  $i++;
                  };
                  ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselDogeIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-custom-icon" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                      </span>
                      <span class="sr-only"><?php echo $lang["previous"]; ?></span>
                    </a>
                    <a class="carousel-control-next" href="#carouselDogeIndicators" role="button" data-slide="next">
                      <span class="carousel-control-custom-icon" aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                      </span>
                      <span class="sr-only"><?php echo $lang["next"]; ?></span>
                    </a>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            <!-- /.card -->
          </div>
        </div>
        <?php }; ?>

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
    </div>
  </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" id="cartright">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <?php echo $lang["version"]; ?>
    </div>
    <!-- Default to the left -->
    <strong><?php echo $lang["copyrigh"]; ?></strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="inc/vendors/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="inc/vendors/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="inc/vendors/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="inc/vendors/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="inc/vendors/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="inc/vendors/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="inc/vendors/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="inc/vendors/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="inc/vendors/AdminLTE/plugins/jszip/jszip.min.js"></script>
<script src="inc/vendors/AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
<script src="inc/vendors/AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
<script src="inc/vendors/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="inc/vendors/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="inc/vendors/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Summernote -->
<script src="inc/vendors/AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE App -->
<script src="inc/vendors/AdminLTE/dist/js/adminlte.min.js"></script>
<script>
$(document).ready(function(){
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

	
    // we get the cart contents and inject the code on the right sidebar
    $("#cartright").load("inc/ajax-cart.php");

    // we get the search results and dispaly
    $( "#fetch" ).on('keyup', function () {
      var fetch = this.value;
      if ($(this).val().length > 2){
              $.ajax({
                  url: "inc/ajax-fetch.php", // path to myphp file which returns the price
                  method: "post", // POST request
                  data: "fetch=" + fetch, // I retrieve this data in my$_POST variable in ajax.php : $_POST[id]
                  success: function(response) { // The function to execute if the request is a -success-, response will be the price
                            //var datashow = response;
                      if (response == null){
                           //alert('No records');
                      }else{
                          $("#fetchresultscard").show();
                          $("#fetchresults").html(response);

                      }
                  },
                  error: function(){
                  //alert('Error!');
                  }
              });
              };
    });

// wen we a shibe is registered
<?php if (isset($_GET["shibe"]) and $_GET["shibe"] == "verify"){ ?>
                  swal.fire({
                    icon: 'success',
                    title: '<?php echo $lang["wow"]; ?>',
                    showConfirmButton: true,
                    confirmButtonColor: '#666666',
                    html:
                      '<?php echo $lang["verify_account"]; ?>',
                  })
<?php }; ?>
// wen we verify that the Dogecoin Node is not running!
<?php if (isset($_GET["d"]) and $_GET["d"] == "error"){ ?>
                  swal.fire({
                    icon: 'warning',
                    title: '<?php echo $lang["sad"]; ?>',
                    showConfirmButton: true,
                    confirmButtonColor: '#666666',
                    html:
                      '<img src="img/sad_doge.gif"><br><br>' +
                      '<?php echo $lang["error_node"]; ?>',
                  })
<?php }; ?>
// wen we verify that the Dogecoin Node is not running!
<?php if (isset($_GET["d"]) and $_GET["d"] == "shipping"){ ?>
                  swal.fire({
                    icon: 'warning',
                    title: '<?php echo $lang["sad"]; ?>',
                    showConfirmButton: true,
                    confirmButtonColor: '#666666',
                    html:
                      '<img src="img/sad_doge.gif"><br><br>' +
                      'Sorry there is no active shipping for your country!',
                  })
<?php }; ?>
// wen we a shibe is registered
<?php if (isset($_GET["shibe"]) and $_GET["shibe"] == "exists"){ ?>
                  swal.fire({
                    icon: 'warning',
                    title: '<?php echo $lang["sad"]; ?>',
                    showConfirmButton: true,
                    confirmButtonColor: '#666666',
                    html:
                      '<?php echo $lang["exists_account"]; ?>',
                  })
<?php }; ?>
// wen we a shibe is loged in
<?php if (isset($_GET["shibe"]) and $_GET["shibe"] == "login"){ ?>
                  swal.fire({
                    icon: 'success',
                    title: '<?php echo $lang["wow"]; ?>',
                    showConfirmButton: false,
                    timer: 1500,
                    html:
                      '<img src="img/loading_screen.gif">',
                  })
<?php }; ?>
// wen we a shibe is loged out
<?php if (isset($_GET["shibe"]) and $_GET["shibe"] == "logout"){ ?>
                  swal.fire({
                    icon: 'success',
                    title: '<?php echo $lang["sad"]; ?>',
                    showConfirmButton: false,
                    timer: 1500,
                    html:
                      '<img src="img/sad_doge.gif">',
                  })
<?php }; ?>
// wen we a shibe is verified
<?php if (isset($_GET["shibe"]) and isset($_GET["hash"]) and isset($_GET["email"]) and $_GET["shibe"] == "activate"){

$d->ActivateShibe($_GET["hash"],$_GET["email"]);

 ?>
                  swal.fire({
                    icon: 'success',
                    title: '<?php echo $lang["wow"]; ?>',
                    showConfirmButton: false,
                    timer: 1500,
                    html:
                      '<img src="img/loading_screen.gif">',
                  })
<?php }; ?>
// wen we recover a shibe password
<?php if (isset($_GET["shibe"]) and $_GET["shibe"] == "recover"){
if (isset($_GET["hash"]) and isset($_GET["email"])){
    $d->RecoverShibe($_GET["hash"],$_GET["email"]);
};

 ?>
                  swal.fire({
                    icon: 'success',
                    title: 'Much check your email!',
                    showConfirmButton: true,
                    confirmButtonColor: '#666666',
                    html:
                      '<img src="img/loading_screen.gif">',
                  })
<?php }; ?>
});
// wen we click on Buy a product it adds to your cart
function insertcart(id, qty) {
  $("#cartright").load("inc/ajax-cart.php?insert=" + id + "&qty=" + qty);

                  swal.fire({
                    icon: 'success',
                    title: '<?php echo $lang["wow"]; ?>',
                    showConfirmButton: false,
                    timer: 1500,
                    html:
                      '<img src="img/loading_screen.gif">',
                  });
  $('#cartright').ControlSidebar('toggle');                  

};

// wen we click on X button on the Cart it removes from the cart
function removecart(id) {
  $("#cartright").load("inc/ajax-cart.php?remove=" + id);

                  swal.fire({
                    icon: 'success',
                    title: '<?php echo $lang["sad"]; ?>',
                    showConfirmButton: false,
                    timer: 1500,
                    html:
                      '<img src="img/sad_doge.gif">',
                  });

};
</script>
</body>
</html>