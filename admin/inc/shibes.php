<?php
  // make sure there is no atempt to access this file
  if (!isset($_SESSION["admin"])){ exit(); };
?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["admin_manage_shibes"]; ?></h3>
                <div style="float: right"><a class="btn btn-block btn-success" href="?d=<?php echo $_GET["d"]; ?>&do=insert"><i class="far fa fa-plus-square nav-icon"></i> <?php echo $lang["insert"]; ?></a></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<?php
// we check if there is a variable defined
if(isset($_GET["do"])){


if(isset($_POST["action"])){
    if ( $_GET["do"] == "insert"){
        $d->InsertShibe($d->CleanString($_POST["name"]),$d->CleanEmail($_POST["email"]),$_POST["password"],$d->CleanString($_POST["tax_id"]),$d->CleanString($_POST["address"]),$d->CleanString($_POST["postal_code"]),$d->CleanString($_POST["country"]),$d->CleanString($_POST["city"]),$d->CleanString($_POST["phone"]),$d->CleanString($_POST["doge_address"]),$d->CleanString($_POST["active"]),date("Y-m-d H:i:s"));
    }
    if ( $_GET["do"] == "update"){
        $d->UpdateShibe($d->CleanString($_POST["name"]),$d->CleanEmail($_POST["email"]),$_POST["password"],$d->CleanString($_POST["tax_id"]),$d->CleanString($_POST["address"]),$d->CleanString($_POST["postal_code"]),$d->CleanString($_POST["country"]),$d->CleanString($_POST["city"]),$d->CleanString($_POST["phone"]),$d->CleanString($_POST["doge_address"]),$d->CleanString($_POST["active"]),date("Y-m-d H:i:s"),$_POST["id"]);
    };
    $_GET["id"] = null; $_GET["do"] = null; $_GET["action"] = null;
};

    if ( $_GET["do"] == "remove"){
        $d->RemoveShibe($_GET["id"]);
        $_GET["id"] = null; $_GET["do"] = null;
    };
  // we check are going to insert a new record or update
    if ($_GET["do"] == "insert" or $_GET["do"] == "update"){

      // if we are goin to update will get only one record
      if ( $_GET["do"] == "update"){
                      $row = $pdo->query("SELECT * FROM shibes where id = '".$_GET["id"]."' limit 1")->fetch();
      };
?>

<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["admin_shibes_title"]; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" action="?d=<?php echo $_GET["d"]; ?>&do=<?php echo $_GET["do"]; ?>">
                  <input type="hidden" name="action" value="save" />
                  <?php if (isset($_GET["id"])){ ?><input type="hidden" name="id" value="<?php echo $_GET["id"];?>" /><?php }; ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label><?php echo $lang["doge_address"]; ?></label>
                        <input type="text" name="doge_address" class="form-control" value="<?php if (isset($row["doge_address"])){ echo $row["doge_address"]; }; ?>" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["name"]; ?></label>
                        <input type="text" name="name" class="form-control" value="<?php if (isset($row["name"])){ echo $row["name"]; }; ?>" placeholder="" required="required">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["email"]; ?></label>
                        <input type="email" name="email" class="form-control" value="<?php if (isset($row["email"])){ echo $row["email"]; }; ?>" placeholder="" required="required">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["password"]; ?></label>
                        <input type="password" name="password" class="form-control" value="" placeholder="" <?php if (!isset($_GET["id"])){ ?>required="required"<?php }; ?>>
                      </div>
                    </div>
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["tax_id"]; ?></label>
                        <input type="text" name="tax_id" class="form-control" value="<?php if (isset($row["tax_id"])){ echo $row["tax_id"]; }; ?>" placeholder="" >
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["country"]; ?></label>
                        <select class="form-control" name="country" required="required">
                          <option value="">----</option>
                            <?php echo $lang["countries"]; ?>
                          <?php if (isset($row["country"])){ ?> <option value="<?php echo $row["country"];?>" selected="selected"><?php if ($row["country"] == ""){ echo "----"; }else{ echo $row["country"]; }; ?></option><?php }; ?>
                        </select>
                      </div>
                    </div>
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["city"]; ?></label>
                        <input type="text" name="city" class="form-control" value="<?php if (isset($row["city"])){ echo $row["city"]; }; ?>" placeholder="" required="required">
                      </div>
                    </div>
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["address"]; ?></label>
                        <input type="text" name="address" class="form-control" value="<?php if (isset($row["address"])){ echo $row["address"]; }; ?>" placeholder="" required="required">
                      </div>
                    </div>
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["postal_code"]; ?></label>
                        <input type="text" name="postal_code" class="form-control" value="<?php if (isset($row["postal_code"])){ echo $row["postal_code"]; }; ?>" placeholder="" required="required">
                      </div>
                    </div>
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["phone"]; ?></label>
                        <input type="number" name="phone" class="form-control" value="<?php if (isset($row["phone"])){ echo $row["phone"]; }; ?>" placeholder="" required="required">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["active"]; ?></label>
                        <select class="form-control" name="active">
                          <option value="1" ><?php echo $lang["active"]; ?></option>
                          <option value="0" ><?php echo $lang["disable"]; ?></option>
                          <?php if (isset($row["active"])){ ?>
                          <option value="<?php echo $row["active"]; ?>" selected="selected" >
                            <?php if ($row["active"] == 0 ){ echo $lang["disable"]; }; ?>
                            <?php if ($row["active"] == 1 ){ echo $lang["active"]; }; ?>
                          </option>
                          <?php };?>
                        </select>
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
                    <th><?php echo $lang["id"]; ?></th>
                    <th><?php echo $lang["name"]; ?></th>
                    <th><?php echo $lang["email"]; ?></th>
                    <th><?php echo $lang["phone"]; ?></th>
                    <th><?php echo $lang["country"]; ?></th>
                    <th><?php echo $lang["city"]; ?></th>
                    <th><?php echo $lang["date"]; ?></th>
                    <th><?php echo $lang["active"]; ?></th>
                    <th><?php echo $lang["options"]; ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $db = $pdo->query("SELECT * FROM shibes");
                      while ($row = $db->fetch()) {
                  ?>
                  <tr>
                    <td><?php echo $row["id"];?></td>
                    <td><?php echo $row["name"];?></td>
                    <td><?php echo $row["email"];?></td>
                    <td><?php echo $row["phone"];?></td>
                    <td><?php echo $row["country"];?></td>
                    <td><?php echo $row["city"];?></td>
                    <td><?php echo $row["date"];?></td>
                    <td>
                            <?php if ($row["active"] == 0 ){ echo $lang["disable"]; }; ?>
                            <?php if ($row["active"] == 1 ){ echo $lang["active"]; }; ?>
                    </td>
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