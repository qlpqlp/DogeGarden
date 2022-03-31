<?php
// include the configuration and functions
include("../inc/config.php");
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
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../inc/vendors/AdminLTE/dist/css/adminlte.css">

  <style type="text/css">
    .container, .container-fluid, .container-sm, .container-md, .container-lg, .container-xl {
        padding: 20px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center" style="margin-top: -20px">
    <img class="animation__shake" src="../img/loading_screen.gif" alt="DogeGardeen" height="161">
    <?php echo $lang["loading"]; ?>
  </div>
    <!-- Content Header (Page header) -->
    <div class="content">
      <div class="container-fluid">


        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">DogeGarden Easy Install</h3>
              </div>
              <div class="card-body p-0">
        <div class="col-md-12 mt-5">
          <div id="stepper1" class="bs-stepper">
            <div class="bs-stepper-header">
              <div class="step" data-target="#test-l-1">
                <button type="button" class="btn step-trigger">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">First step</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#test-l-2">
                <button type="button" class="btn step-trigger">
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">Second step</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#test-l-3">
                <button type="button" class="btn step-trigger">
                  <span class="bs-stepper-circle">3</span>
                  <span class="bs-stepper-label">Third step</span>
                </button>
              </div>
            </div>
            <div class="bs-stepper-content">
              <div id="test-l-1" class="content">
<div class="callout callout-warning">
    <p>Lets install<a href="https://dogecoin.com/#wallets" target="_blank" style="color: #DFA800; text-decoration: none"> DogeCoin Core Wallet</a> on your computer. After install, close Dogecoin Core Wallet.</p>
</div>
<div class="callout callout-warning">
    <p>Now we will generate for you the "dogecoin.conf" file for you to upload to the folder C:\Users\YOUR-USERNAME\AppData\Roaming\Dogecoin</p>
                <form method="post" action="inc/dogecoinconf.php" target="_blank">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>RPC User</label>
                        <input type="text" name="rpcuser" class="form-control" value="<?php if (isset($_POST["rpcuser"])) { echo $_POST["rpcuser"]; }; ?>" placeholder="" required="required">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>RPC Password</label>
                        <input type="password" name="rpcpassword" class="form-control" value="<?php if (isset($_POST["rpcpassword"])) { echo $_POST["rpcpassword"]; }; ?>" placeholder="" required="required">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Your Local Newtwork Computer IP Address</label>
                        <input type="text" name="rpclip" class="form-control" value="192.168.1.1" placeholder="" required="required">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Your Hosting / Server Public IP Address</label>
                        <input type="text" name="rpcdip" class="form-control" value="<?php if (isset($_POST["rpcdip"])) { echo $_POST["rpcdip"]; }else{ echo $_SERVER['SERVER_ADDR']; }; ?>" placeholder="" required="required">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <button class="btn btn-block btn-success" onclick="">Generate dogecoin.conf file!</button>
                      </div>
                    </div>
                  </div>
                </form>
</div>

<div class="callout callout-warning">
    <p>Now, open Dogecoin Core Wallet and let it finish sincronize all Blockchain (can take a couple of hours to finish and will occuppy ~50Gb of data space, today), after finish sincronize it should start the RPC connections and you can check it on the next step.</p>
</div>
<div class="callout callout-warning">
    <p>More information about setup a DogeCoin Node with RPC enable using the Core Wallet, <a href="https://github.com/dogecoin/dogecoin/blob/master/doc/getting-started.md#node-configuration" target="_blank" style="color: #DFA800; text-decoration: none">here</a>!</p>
</div>

<div class="callout callout-warning">
    <p>Now on Windows Firewall add the TCP ports 22555, 22556, 44555, 44556, In and Out ! <a href="https://www.google.com/search?q=windows+configure+ports+fireall&oq=windows+configure+ports+fireall" target="_blank" style="color: #DFA800; text-decoration: none">Google</a></p>
</div>

<div class="callout callout-warning">
    <p>Because most of you have Dynamic IP's you should get an No-IP hostname, create one for free, for exemple here <a href="https://www.noip.com/" target="_blank" style="color: #DFA800; text-decoration: none">noip.com</a>
    <br>Then add your hostname with your username and password on your routher configurations of DynDNS (Dynamic DNS), ask you ISP how (Internet Service Provider)
    </p>
</div>

<div class="callout callout-warning">
    <p>Now you have to PortFoward on your router the ports 22555, 22556, 44555, 44556 follow this exemple here <a href="https://dogecoinisawesome.com/full-node#enabling-connections" target="_blank" style="color: #DFA800; text-decoration: none">dogecoinisawesome.com</a>.
    <br>Note: Some Web Hosting companies dont allow connections to Dogecoin ports, if so add an extra port foward from internal 22555 to external 3306 or the port 80 if the 3306 is blocked on your Internet Service Provider
    </p>
</div>
<br>

                <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
              </div>
              <div id="test-l-2" class="content">


<div class="callout callout-warning">
    <p>On your Hosting/Server account, create and email address for your online store and an MySQL/MariaDB DataBase with an Username and Password!</p>
</div>


<div class="callout callout-warning">
    <p>Now we will generate for you the "config.php" file for your store to connect to your Dogecoin Node and also import your DataBase</p>
                <form method="post" action="inc/configfile.php" target="_blank">
                  <input type="hidden" name="configfile" value="1" />
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Dogecoin RPC User</label>
                        <input type="text" name="rpcuser" class="form-control" value="<?php if (isset($_POST["rpcuser"])) { echo $_POST["rpcuser"]; }; ?>" placeholder="Dogecoin RPC Node Username" required="required">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Dogecoin RPC Password</label>
                        <input type="password" name="rpcpassword" class="form-control" value="<?php if (isset($_POST["rpcpassword"])) { echo $_POST["rpcpassword"]; }; ?>" placeholder="Dogecoin RPC Node Password" required="required">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Dogecoin RPC Hostname</label>
                        <input type="password" name="dogecoinCoreServer" class="form-control" value="<?php if (isset($_POST["dogecoinCoreServer"])) { echo $_POST["dogecoinCoreServer"]; }; ?>" placeholder="No-IP Hostname or Node/Computer External IP" required="required">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Dogecoin RPC Port</label>
                        <input type="number" name="dogecoinCoreServerPort" class="form-control" value="<?php if (isset($_POST["dogecoinCoreServerPort"])) { echo $_POST["dogecoinCoreServerPort"]; }else{ echo "22555"; }; ?>" placeholder="22555" required="required">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>MySQL/MariaDB Hostname</label>
                        <input type="text" name="dbhost" class="form-control" value="<?php if (isset($_POST["dbhost"])) { echo $_POST["dbhost"]; }else{ echo "localhost"; }; ?>" placeholder="The hostname of your Data Base" required="required">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>MySQL/MariaDB Database Name</label>
                        <input type="text" name="dbname" class="form-control" value="<?php if (isset($_POST["dbname"])) { echo $_POST["dbname"]; }else{ echo ""; }; ?>" placeholder="The name of your Data Base" required="required">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>MySQL/MariaDB Username</label>
                        <input type="text" name="dbuser" class="form-control" value="<?php if (isset($_POST["dbuser"])) { echo $_POST["dbuser"]; }else{ echo ""; }; ?>" placeholder="The username of your Data Base" required="required">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>MySQL/MariaDB Password</label>
                        <input type="password" name="dbpass" class="form-control" value="<?php if (isset($_POST["dbpass"])) { echo $_POST["dbpass"]; }else{ echo ""; }; ?>" placeholder="The password of your Data Base" required="required">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Default Fiat/Doge</label>
                        <input type="text" name="fiat" class="form-control" value="<?php if (isset($_POST["fiat"])) { echo $_POST["fiat"]; }else{ echo "usd"; }; ?>" placeholder="Insert a fiat currency like usd or eur" required="required">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Default Sore Language</label>
                        <select class="form-control" name="default">
                          <option value="EN">EN</option>
                          <option value="DE">DE</option>
                          <option value="FR">FR</option>
                          <option value="ES">ES</option>
                          <option value="PT">PT</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Store Email Name From</label>
                        <input type="text" name="mail_name_from" class="form-control" value="<?php if (isset($_POST["mail_name_from"])) { echo $_POST["mail_name_from"]; }else{ echo ""; }; ?>" placeholder="Insert an name to show on emails sent from" required="required">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Store Email Address</label>
                        <input type="email" name="email_from" class="form-control" value="<?php if (isset($_POST["email_from"])) { echo $_POST["mail_name_from"]; }else{ echo ""; }; ?>" placeholder="Insert an email address" required="required">
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Store Admin Username</label>
                        <input type="text" name="admin_user" class="form-control" value="<?php if (isset($_POST["admin_user"])) { echo $_POST["admin_user"]; }else{ echo ""; }; ?>" placeholder="Insert an username to login to the Backoffice of the store" required="required">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Store Admin Password</label>
                        <input type="password" name="admin_pass" class="form-control" value="<?php if (isset($_POST["admin_pass"])) { echo $_POST["admin_pass"]; }else{ echo ""; }; ?>" placeholder="Insert an password to login to the Backoffice of the store" required="required">
                      </div>
                    </div>



                    <div class="col-sm-12">
                      <div class="form-group">
                        <button class="btn btn-block btn-success" onclick="$(this).css('background-color', '#666666');" >Generate config.php file!</button>
                      </div>
                    </div>
                  </div>
                </form>
</div>

                <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                <button class="btn btn-secondary" onclick="stepper1.previous()">Previous</button>
              </div>
              <div id="test-l-3" class="content">
<div class="callout callout-warning">
    <p>Now, you have to import the database dogegarden.sql into your hosting/server using for exemple <b>phpMYAdmin</b>!</p>
</div>
<div class="callout callout-warning">
    <p>Add an <b>CRON</b> job running in every minute, and point to <b>inc/cron.php</b></p>
</div>
<div class="callout callout-warning">
    <p>To test if your Dogecoin Core Node is runnning correctly and connected to your DogeGarden Online Store, <a id="node" href="#" style="color: #DFA800; text-decoration: none">click here</a> ! <span id="noderesults"></span></p>
</div>
<div class="callout callout-warning">
    <p>If all is OK, you can remove/delete the folder "install" from your Hosting/Server!</p>
</div>
                <button class="btn btn-secondary" onclick="stepper1.previous()">Previous</button>
              </div>
            </div>
          </div>
        </div>
       </div>
      </div>
      </div>
      </div>
      </div>
      </div>



<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../inc/vendors/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../inc/vendors/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- BS-Stepper -->
<script src="../inc/vendors/AdminLTE/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- AdminLTE App -->
<script src="../inc/vendors/AdminLTE/dist/js/adminlte.min.js"></script>
    <script>
      var stepper1Node = document.querySelector('#stepper1')
      var stepper1 = new Stepper(document.querySelector('#stepper1'))

      stepper1Node.addEventListener('show.bs-stepper', function (event) {
        console.warn('show.bs-stepper', event)
      })

$(document).ready(function(){
    // we get the search results and dispaly
$( "#node" ).click(function() {
              $.ajax({
                  url: "inc/node.php", // path to myphp file which returns the price
                  method: "post", // POST request
                  data: "run=1", // I retrieve this data in my$_POST variable in ajax.php : $_POST[id]
                  success: function(response) { // The function to execute if the request is a -success-, response will be the price
                            //var datashow = response;
                      if (response > 1){
                          $("#noderesults").html('<li class="fas fa-check" style="color:#99CC00; font-size:20px"></li>');
                      }else{
                        $("#noderesults").html('<li class="fas fa-times" style="color:#FF3300; font-size:20px"></li>');
                      }
                  },
                  error: function(){
                    $("#noderesults").html('<li class="fas fa-times" style="color:#FF3300; font-size:20px"></li>');
                  }
              });
    });
});
    </script>
</body>
</html>