<?php
// if Shibe not loged in, redirect to login
if (!isset($_SESSION["shibe"])){
?>
    <script>
            window.location.href = "//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>?d=login";
    </script>
<?php
exit();
};
?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["admin_manage_orders"]; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<?php
// we check if there is a variable defined
if(isset($_GET["do"])){
  // we check are going to insert a new record or update
    if ($_GET["do"] == "insert" or $_GET["do"] == "update"){

      // if we are goin to update will get only one record
      if ( $_GET["do"] == "update"){
            $row = $pdo->query("SELECT * FROM orders where id = '".$_GET["id"]."' limit 1")->fetch();
            $shibe = $pdo->query("SELECT * FROM shibes where id = '".$row["id_shibe"]."' limit 1")->fetch();
      };


?>

<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["admin_orders_title"]; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" action="?d=<?php echo $_GET["d"]; ?>&do=<?php echo $_GET["do"]; ?>">
                  <input type="hidden" name="action" value="save" />
                  <?php if (isset($_GET["id"])){ ?><input type="hidden" name="id" value="<?php echo $_GET["id"];?>" /><?php }; ?>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["doge_in_address"]; ?></label>
                        <?php if (isset($row["doge_in_address"])){ echo $row["doge_in_address"]; }; ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["doge_out_address"]; ?></label>
                        <?php if (isset($row["doge_out_address"])){ echo $row["doge_out_address"]; }; ?>
                      </div>
                    </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["tax"]; ?></label>
                        <?php if (isset($row["tax"])){ echo $row["tax"]; }; ?>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["admin_orders_total_doge"]; ?></label>
                        <?php if (isset($row["total_doge"])){ echo $row["total_doge"]; }; ?>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["admin_orders_tx_id"]; ?></label>
                        <?php if (isset($row["doge_transaction_id"])){ echo $row["doge_transaction_id"]; }; ?>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["admin_orders_confirmations"]; ?></label>
                        <?php if (isset($row["confirmations"])){ echo $row["confirmations"]; }; ?>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["admin_orders_date"]; ?></label>
                        <?php if (isset($row["date"])){ echo $row["date"]; }; ?>
                      </div>
                  </div>
                 <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["shipping"]; ?></label>
                        <?php if (isset($row["shipping_json"])){ echo $row["shipping_json"]; }; ?>
                      </div>
                  </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["admin_orders_status"]; ?></label>
                          <?php if (isset($row["status"])){ ?>
                            <?php if ($row["status"] == 0 ){ echo $lang["pending"]; }; ?>
                            <?php if ($row["status"] == 1 ){ echo $lang["sended"]; }; ?>
                            <?php if ($row["status"] == 2 ){ echo $lang["finish"]; }; ?>
                            <?php if ($row["status"] == 3 ){ echo $lang["cancel"]; }; ?>
                            <?php if ($row["status"] == 4 ){ echo $lang["refunded"]; }; ?>
                          <?php };?>
                      </div>
                    </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                        <label><?php echo $lang["products_json"]; ?></label>
                          <?php if (isset($row["products_json"])){ echo $row["products_json"]; }; ?>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>


<?php
    };
};
?>




<?php
// we list all records
if (!isset($_GET["do"])){
?>
                <table id="tabled" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th><?php echo $lang["admin_orders_id"]; ?></th>
                    <th><?php echo $lang["doge_in_address"]; ?></th>
                    <th><?php echo $lang["admin_orders_total_doge"]; ?></th>
                    <th><?php echo $lang["admin_orders_confirmations"]; ?></th>
                    <th><?php echo $lang["admin_orders_tx_id"]; ?></th>
                    <th><?php echo $lang["admin_orders_date"]; ?></th>
                    <th><?php echo $lang["admin_orders_status"]; ?></th>
                    <th><?php echo $lang["options"]; ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $db = $pdo->query("SELECT * FROM orders where id_shibe = '".$_SESSION["shibe"]."'");
                      while ($row = $db->fetch()) {

                        if ($row["confirmations"] < 3){ $status_btn = $lang["admin_orders_status_almost"]; $status_color = "warning"; };
                        if ($row["confirmations"] == 0){ $status_btn = $lang["admin_orders_status_pending"]; $status_color = "secondary"; };
                        if ($row["confirmations"] > 3){ $status_btn = $lang["admin_orders_status_verified"]; $status_color = "success"; };

                        if (isset($row["status"]) and $row["status"] > 0){ $status_btn = $row["status"];
                            if ($row["status"] == 0 ){ $status_btn = $lang["pending"]; };
                            if ($row["status"] == 1 ){ $status_btn = $lang["sended"]; };
                            if ($row["status"] == 2 ){ $status_btn =  $lang["finish"]; };
                            if ($row["status"] == 3 ){ $status_btn =  $lang["cancel"]; };
                            if ($row["status"] == 4 ){ $status_btn =  $lang["refunded"]; };
                        };
                                              $shibe = $pdo->query("SELECT name FROM shibes where id = '".$row["id_shibe"]."' limit 1")->fetch();
                                              $shibe["name"] = explode(" ",$shibe["name"]);
                  ?>
                  <tr>
                    <td><?php echo $row["id"];?></td>
                    <td style="word-break: break-word;"><?php echo $row["doge_in_address"];?></td>
                    <td>&ETH; <?php echo $row["total_doge"];?></td>
                    <td><?php echo $row["confirmations"];?></td>
                    <td style="word-break: break-word;"><?php echo $row["doge_transaction_id"];?></td>
                    <td><?php echo $row["date"];?></td>
                    <td><span class="btn btn-block btn-<?php echo $status_color; ?>"><?php echo $status_btn; ?></span></td>
                   <td>
                    <div class="btn-group">
                    <button type="button" class="btn btn-warning" data-toggle="dropdown" ><i class="far fa fa-edit nav-icon"></i> <?php echo $lang["options"]; ?></button>
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only"><?php echo $lang["options"]; ?></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item" href="?d=<?php echo $_GET["d"]; ?>&do=update&id=<?php echo $row["id"];?>"><i class="far fa fa-eye nav-icon"></i> <?php echo $lang["view"]; ?></a>
                    </div>
                  </div>

                    </td>
                  </tr>
                  <?php
                  };
                  ?>
                  </tbody>
              </table>
<?php
    };
?>
              </div>
            </div>