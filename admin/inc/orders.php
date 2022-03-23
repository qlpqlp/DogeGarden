<?php
  // make sure there is no atempt to access this file
  if (!isset($_SESSION["admin"])){ exit(); };
?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["admin_manage_orders"]; ?></h3>
                <div style="float: right; display: none"><a class="btn btn-block btn-success" href="?d=<?php echo $_GET["d"]; ?>&do=insert"><i class="far fa fa-plus-square nav-icon"></i> <?php echo $lang["insert"]; ?></a></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<?php
// we check if there is a variable defined
if(isset($_GET["do"])){


if(isset($_POST["action"])){
    if ( $_GET["do"] == "insert"){
        $d->InsertOrder($_POST["shibe"],0,0,$_POST["tax"],$_POST["total_doge"],0,0,date("Y-m-d H:i:s"),$_POST["shipping"],$_POST["products_json"],0);
    }
    if ( $_GET["do"] == "update"){
        $d->UpdateOrder($_POST["id_shibe"],$_POST["doge_in_address"],$_POST["doge_out_address"],$_POST["tax"],$_POST["total_doge"],$_POST["doge_transaction_id"],$_POST["confirmations"],$_POST["date"],$_POST["status"],$_POST["shipping"],$_POST["products_json"],$_POST["id"]);
    };
    $_GET["id"] = null; $_GET["do"] = null; $_GET["action"] = null;
};

    if ( $_GET["do"] == "remove"){
        $d->RemoveOrder($_GET["id"]);
        $_GET["id"] = null; $_GET["do"] = null;
    };
  // we check are going to insert a new record or update
    if ($_GET["do"] == "insert" or $_GET["do"] == "update"){

      // if we are goin to update will get only one record
      if ( $_GET["do"] == "update"){
            $row = $pdo->query("SELECT * FROM orders where id = '".$_GET["id"]."' limit 1")->fetch();
            $shibe = $pdo->query("SELECT * FROM shibes where id = '".$row["id_shibe"]."' limit 1")->fetch();
            if ($row["doge_out_address"] == 0){$row["doge_out_address"] = $row["doge_out_address"] = $shibe["doge_address"];};
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
                        <label><?php echo $lang["name"]; ?></label>
                        <a href="?d=shibes&do=update&id=<?php echo $row["id_shibe"]; ?>"><?php if (isset($shibe["name"])){ echo $shibe["name"]; }; ?></a>
                        <input type="hidden" name="id_shibe" value="<?php echo $row["id_shibe"]; ?>" />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["doge_in_address"]; ?></label>
                        <input type="text" name="doge_in_address" class="form-control" value="<?php if (isset($row["doge_in_address"])){ echo $row["doge_in_address"]; }; ?>" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["doge_out_address"]; ?></label>
                        <input type="text" name="doge_out_address" class="form-control" value="<?php if (isset($row["doge_out_address"])){ echo $row["doge_out_address"]; }; ?>" placeholder="">
                      </div>
                    </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["tax"]; ?></label>
                        <input type="number" min="0" step="any" name="tax" class="form-control" value="<?php if (isset($row["tax"])){ echo $row["tax"]; }; ?>" placeholder="">
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["admin_orders_total_doge"]; ?></label>
                        <input type="number" min="0" step="any" name="total_doge" class="form-control" value="<?php if (isset($row["total_doge"])){ echo $row["total_doge"]; }; ?>" placeholder="">
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["admin_orders_tx_id"]; ?></label>
                        <input type="text" min="0" name="doge_transaction_id" class="form-control" value="<?php if (isset($row["doge_transaction_id"])){ echo $row["doge_transaction_id"]; }; ?>" placeholder="">
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["admin_orders_confirmations"]; ?></label>
                        <input type="number" min="0" name="confirmations" class="form-control" value="<?php if (isset($row["confirmations"])){ echo $row["confirmations"]; }; ?>" placeholder="">
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["admin_orders_date"]; ?></label>
                        <input type="text" name="date" class="form-control" value="<?php if (isset($row["date"])){ echo $row["date"]; }; ?>" placeholder="">
                      </div>
                  </div>
                 <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["shipping"]; ?></label>
                        <input type="number" min="0" step="any" name="shipping" class="form-control" value="<?php if (isset($row["shipping"])){ echo $row["shipping"]; }; ?>" placeholder="">
                      </div>
                  </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["admin_orders_status"]; ?></label>
                        <select class="form-control" name="status">
                          <option value="0" ><?php echo $lang["pending"]; ?></option>
                          <option value="1" ><?php echo $lang["sended"]; ?></option>
                          <option value="2" ><?php echo $lang["finish"]; ?></option>
                          <option value="3" ><?php echo $lang["cancel"]; ?></option>
                          <option value="4" ><?php echo $lang["refunded"]; ?></option>
                          <?php if (isset($row["status"])){ ?>
                          <option value="<?php echo $row["status"]; ?>" selected="selected" >
                            <?php if ($row["status"] == 0 ){ echo $lang["pending"]; }; ?>
                            <?php if ($row["status"] == 1 ){ echo $lang["sended"]; }; ?>
                            <?php if ($row["status"] == 2 ){ echo $lang["finish"]; }; ?>
                            <?php if ($row["status"] == 3 ){ echo $lang["cancel"]; }; ?>
                            <?php if ($row["status"] == 4 ){ echo $lang["refunded"]; }; ?>
                          </option>
                          <?php };?>
                        </select>
                      </div>
                    </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                        <label><?php echo $lang["products_json"]; ?></label>
                          <?php if (isset($row["products_json"])){  ?>

<?php
$products = json_decode(html_entity_decode($row["products_json"]));

foreach($products as $product)

    {

                      $row = $pdo->query("SELECT * FROM products where id = '".$product->id."' limit 1")->fetch();
?>

<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"><?php if (isset($row["title"])){ echo $row["title"]; }; ?> [Id: <?php echo $product->id;?>]</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Ð <?php echo $lang["doge"]; ?></label>
                        <input type="number" step="any" class="form-control" min="0" value="<?php if (isset($product->doge)){ echo $product->doge; }; ?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["tax"]; ?> %</label>
                        <input type="number" step="any" class="form-control" min="0" value="<?php if (isset($product->tax)){ echo $product->tax; }else{ echo "0"; }; ?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["qty"]; ?></label>
                        <input type="number" class="form-control" min="0" value="<?php if (isset($product->qty)){ echo $product->qty; }else{ echo "0"; }; ?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><li class="fas fa-circle"></li> <?php echo $lang["moon_new"]; ?> <?php echo $lang["discount"]; ?></label>
                        <input type="number" step="any" class="form-control" min="0" value="<?php if (isset($product->moon_new)){ echo $product->moon_new; }else{ echo "0.00"; }; ?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><li class="far fa-circle"></li> <?php echo $lang["moon_full"]; ?> <?php echo $lang["discount"]; ?></label>
                        <input type="number" step="any" class="form-control" min="0" value="<?php if (isset($product->moon_full)){ echo $product->moon_full; }else{ echo "0.00"; }; ?>" readonly="readonly">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["weight"]; ?></label>
                        <input type="number" step="any" class="form-control" min="0" value="<?php if (isset($product->weight)){ echo $product->weight; }else{ echo "0"; }; ?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label><?php echo $lang["img"]; ?></label>
                          <?php if (isset($row["imgs"]) and $row["imgs"] != ""){ ?>
                            <?php
                            $imgs = explode(",", $row["imgs"]);
                            $total = count($imgs);
                            for( $i=0 ; $i < $total ; $i++ ) {
                              if ($imgs[$i] != ""){
                              ?>
                               <img src="../fl/<?php echo $imgs[$i];?>" style="max-width: 50px; padding: 3px">
                              <?php
                                };
                            };
                            ?>
                          <?php }; ?>
                      </div>
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
<?php
    }; };
?>
                      </div>
                    </div>
                  </div>
                <div><button type="submit" class="btn btn-block btn-success" ><i class="far fa fa-save nav-icon"></i> <?php echo $lang["save"]; ?></button></div>
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
                    <th><?php echo $lang["admin_orders_shibe"]; ?></th>
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
                      $db = $pdo->query("SELECT * FROM orders");
                      while ($row = $db->fetch()) {

                        if ($row["confirmations"] <= 3){ $status_btn = $lang["admin_orders_status_almost"]; $status_color = "warning"; };
                        if ($row["confirmations"] == 0){ $status_btn = $lang["admin_orders_status_pending"]; $status_color = "secondary"; };
                        if ($row["confirmations"] >= 3){ $status_btn = $lang["admin_orders_status_verified"]; $status_color = "success"; };

                        if (isset($row["status"]) and $row["status"] > 0){
                            $status_btn = $row["status"];
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
                    <td><a href="?d=shibes&do=update&id=<?php echo $row["id_shibe"]; ?>"><?php echo $shibe["name"][0];?></a></td>
                    <td>&ETH; <?php echo $row["total_doge"];?></td>
                    <td><?php echo $row["confirmations"];?></td>
                    <td style="ord-break: break-word;"><?php echo $row["doge_transaction_id"];?></td>
                    <td><?php echo $row["date"];?></td>
                    <td><span class="btn btn-block btn-<?php echo $status_color; ?>"><?php echo $status_btn; ?></span></td>
                   <td>
                    <div class="btn-group">
                    <button type="button" class="btn btn-warning" data-toggle="dropdown" ><i class="far fa fa-edit nav-icon"></i> <?php echo $lang["options"]; ?></button>
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only"><?php echo $lang["options"]; ?></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item" href="?d=<?php echo $_GET["d"]; ?>&do=update&id=<?php echo $row["id"];?>"><i class="far fa fa-edit nav-icon"></i> <?php echo $lang["update"]; ?></a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item remove" href="?d=<?php echo $_GET["d"]; ?>&do=remove&id=<?php echo $row["id"];?>" ><i class="far fa fa-trash-alt nav-icon"></i> <?php echo $lang["remove"]; ?></a>
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