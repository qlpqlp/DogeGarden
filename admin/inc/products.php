<?php
  // make sure there is no atempt to access this file
  if (!isset($_SESSION["admin"])){ exit(); };
?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["admin_manage_products"]; ?></h3>
                <div style="float: right"><a class="btn btn-block btn-success" href="?d=<?php echo $_GET["d"]; ?>&do=insert"><i class="far fa fa-plus-square nav-icon"></i> <?php echo $lang["insert"]; ?></a></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<?php
// we check if there is a variable defined
if(isset($_GET["do"])){


if(isset($_POST["action"])){
    if (isset($_FILES['imgs']['name'][0])){
      $_POST["imgs"] = $d->UploadFiles($_FILES['imgs']);
    };
    if (!isset($_POST["imgs"]) or $_POST["imgs"] == ""){
      echo "ok";
      if (isset($_POST["imgsh"])){
          $_POST["imgs"] = $_POST["imgsh"];
      }else{
          $_POST["imgs"] = "";
      };
    };

    if ( $_GET["do"] == "insert"){
        $d->InsertProduct($_POST["id_cat"],$_POST["cat_tax"],$_POST["doge"],$_POST["fiat"],$_POST["moon_new"],$_POST["moon_full"],$_POST["qty"],$_POST["weight"],$_POST["highlighted"],$_POST["title"],$_POST["text"],$_POST["imgs"],$_POST["ord"],date('Y-m-d H:i:s'),$_POST["active"]);
    }
    if ( $_GET["do"] == "update"){
        $d->UpdateProduct($_POST["id_cat"],$_POST["cat_tax"],$_POST["doge"],$_POST["fiat"],$_POST["moon_new"],$_POST["moon_full"],$_POST["qty"],$_POST["weight"],$_POST["highlighted"],$_POST["title"],$_POST["text"],$_POST["imgs"],$_POST["ord"],date('Y-m-d H:i:s'),$_POST["active"],$_POST["id"]);
    };
    $_GET["id"] = null; $_GET["do"] = null; $_GET["action"] = null;
};

    if ( $_GET["do"] == "remove"){
        $d->RemoveProduct($_GET["id"]);
        $_GET["id"] = null; $_GET["do"] = null;
    };
  // we check are going to insert a new record or update
    if ($_GET["do"] == "insert" or $_GET["do"] == "update"){

      // if we are goin to update will get only one record
      if ( $_GET["do"] == "update"){
                      $row = $pdo->query("SELECT * FROM products where id = '".$_GET["id"]."' limit 1")->fetch();
      };
?>

<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["admin_products_title"]; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" action="?d=<?php echo $_GET["d"]; ?>&do=<?php echo $_GET["do"]; ?>" ENCTYPE="multipart/form-data">
                  <input type="hidden" name="action" value="save" />
                  <?php if (isset($_GET["id"])){ ?><input type="hidden" name="id" value="<?php echo $_GET["id"];?>" /><?php }; ?>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["cat"]; ?></label>
                        <select class="form-control" name="id_cat" required="required">
                        <?php
                            $dbsub = $pdo->query("SELECT * FROM categories");
                            while ($rowsub = $dbsub->fetch()) {
                        ?>
                                <option value="<?php echo  $rowsub["id"];?>" ><?php echo $rowsub["lang"]."->".$rowsub["title"];?></option>
                        <?php
                        };
                        ?>
                        <?php
                        if ($row["id_cat"] > 0 ){
                            $dbsub = $pdo->query("SELECT * FROM categories where id = '".$row["id_cat"]."' limit 1");
                            while ($rowsub = $dbsub->fetch()) {
                        ?>
                                <option value="<?php echo  $rowsub["id"];?>" selected="selected" ><?php echo $rowsub["lang"]." -> ".$rowsub["title"];?></option>
                        <?php
                            };
                        }else{
                          ?>
                                <option value="0" selected="selected" >---</option>
                          <?php
                        }
                        ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["title"]; ?></label>
                        <input type="text" name="title" class="form-control" value="<?php if (isset($row["title"])){ echo $row["title"]; }; ?>" placeholder="" required="required">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label><?php echo $lang["text"]; ?></label>
                        <textarea id="summernote" name="text" required="required">
                          <?php if (isset($row["text"])){ echo $row["text"]; }; ?>
                        </textarea>
                      </div>
                    </div>


                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Ð <?php echo $lang["doge"]; ?></label>
                        <input type="number" step="any" name="doge" class="form-control" min="0" value="<?php if (isset($row["doge"])){ echo $row["doge"]; }; ?>" placeholder="0" required="required">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo strtoupper($config["fiat"]); ?></label>
                        <input type="number" step="any" name="fiat" class="form-control" min="0" value="<?php if (isset($row["fiat"])){ echo $row["fiat"]; }; ?>" placeholder="0">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["tax"]; ?> %</label>
                        <select class="form-control" name="cat_tax" required="required">
                        <?php
                            $dbsub = $pdo->query("SELECT DISTINCT category FROM tax order by category ASC");
                            while ($rowsub = $dbsub->fetch()) {
                        ?>
                                <option value="<?php echo $rowsub["category"];?>" ><?php echo $rowsub["category"];?></option>
                        <?php
                        };
                        ?>
                        <?php
                        if (isset($row["cat_tax"])){
                        ?>
                                <option value="<?php echo $row["cat_tax"];?>" selected="selected" ><?php echo $row["cat_tax"];?></option>
                        <?php
                        }else{
                          ?>
                                <option value="" selected="selected" >---</option>
                          <?php
                        }
                        ?>
                                <option value="" >0</option>                        
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["qty"]; ?></label>
                        <input type="number" name="qty" class="form-control" min="0" value="<?php if (isset($row["qty"])){ echo $row["qty"]; }else{ echo "0"; }; ?>" placeholder="0" required="required">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><li class="fas fa-circle"></li> <?php echo $lang["moon_new"]; ?> <?php echo $lang["discount"]; ?></label>
                        <input type="number" step="any" name="moon_new" class="form-control" min="0" value="<?php if (isset($row["moon_new"])){ echo $row["moon_new"]; }else{ echo "0.00"; }; ?>" placeholder="0">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><li class="far fa-circle"></li> <?php echo $lang["moon_full"]; ?> <?php echo $lang["discount"]; ?></label>
                        <input type="number" step="any" name="moon_full" class="form-control" min="0" value="<?php if (isset($row["moon_full"])){ echo $row["moon_full"]; }else{ echo "0.00"; }; ?>" placeholder="0">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["weight"]; ?></label>
                        <input type="number" step="any" name="weight" class="form-control" min="0" value="<?php if (isset($row["weight"])){ echo $row["weight"]; }else{ echo "0"; }; ?>" placeholder="0" required="required">
                      </div>
                    </div>


                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["highlighted"]; ?></label>
                        <select class="form-control" name="highlighted">
                          <option value="1" ><?php echo $lang["active"]; ?></option>
                          <option value="0" ><?php echo $lang["disable"]; ?></option>
                          <?php if (isset($row["highlighted"])){ ?>
                          <option value="<?php echo $row["highlighted"]; ?>" selected="selected" >
                            <?php if ($row["active"] == 0 ){ echo $lang["disable"]; }; ?>
                            <?php if ($row["active"] == 1 ){ echo $lang["active"]; }; ?>
                          </option>
                          <?php };?>
                        </select>
                      </div>
                    </div>


                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["ord"]; ?></label>
                        <input type="number" name="ord" class="form-control" min="0" value="<?php if (isset($row["ord"])){ echo $row["ord"]; }else{ echo "0"; }; ?>" placeholder="0">
                      </div>
                    </div>

                    <div class="col-sm-4">
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
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label><?php echo $lang["img"]; ?></label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="imgs" name="imgs[]" multiple="multiple" <?php if (!isset($row["imgs"])){ ?> required="required"<?php }; ?>>
                          <label class="custom-file-label" for="img"><?php echo $lang["img"]; ?></label>
                        </div>
                          <?php if (isset($row["imgs"]) and $row["imgs"] != ""){ ?>
                            <input type="hidden" name="imgsh" value="<?php echo $row["imgs"];?>" /> <br>
                            <?php
                            $imgs = explode(",", $row["imgs"]);
                            $total = count($imgs);
                            for( $i=0 ; $i < $total ; $i++ ) {
                              if ($imgs[$i] != ""){
                              ?>
                               <img src="../fl/<?php echo $imgs[$i];?>" style="max-width: 200px; padding: 3px">
                              <?php
                                };
                            };
                            ?>
                          <?php }; ?>
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
                    <th><?php echo $lang["cat"]; ?></th>
                    <th><?php echo $lang["title"]; ?></th>
                    <th>Ð <?php echo $lang["doge"]; ?></th>
                    <th><?php echo strtoupper($config["fiat"]); ?></th>
                    <th><?php echo $lang["tax"]; ?> %</th>
                    <th><?php echo $lang["moon_new"]; ?></th>
                    <th><?php echo $lang["moon_full"]; ?></th>
                    <th><?php echo $lang["qty"]; ?></th>
                    <th><?php echo $lang["img"]; ?></th>
                    <th><?php echo $lang["highlighted"]; ?></th>
                    <th><?php echo $lang["ord"]; ?></th>
                    <th><?php echo $lang["active"]; ?></th>
                    <th><?php echo $lang["options"]; ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $db = $pdo->query("SELECT * FROM products");
                      while ($row = $db->fetch()) {
                  ?>
                  <tr>
                    <td><?php echo $row["id"];?></td>
                    <td>
                    <?php
                      if ($row["id_cat"] > 0 ){
                              $dbsub = $pdo->query("SELECT * FROM categories where id = '".$row["id_cat"]."' limit 1");
                              while ($rowsub = $dbsub->fetch()) {
                          ?>
                                  <?php echo $rowsub["lang"]." -> ".$rowsub["title"];?>
                          <?php
                              };
                          }else{
                            echo "---";
                          }
                        ?>
                    </td>
                    <td><?php echo $row["title"];?></td>
                    <td>Ð <?php echo $row["doge"];?></td>
                    <td><?php echo $row["fiat"];?></td>
                    <td><?php echo $row["cat_tax"];?></td>
                    <td><?php echo $row["moon_new"];?></td>
                    <td><?php echo $row["moon_full"];?></td>
                    <td><?php echo $row["qty"];?></td>
                    <td>
                      <?php if (isset($row["imgs"]) and $row["imgs"] != ""){ $imgs = explode(",", $row["imgs"]); ?><img src="../fl/<?php echo $imgs[0]; ?>" style="max-width: 50px"><?php }; ?>
                    </td>
                    <td>
                            <?php if ($row["highlighted"] == 0 ){ echo $lang["disable"]; }; ?>
                            <?php if ($row["highlighted"] == 1 ){ echo $lang["active"]; }; ?>
                    </td>
                    <td><?php echo $row["ord"];?></td>
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