<?php
  // make sure there is no atempt to access this file
  if (!isset($_SESSION["admin"])){ exit(); };
?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["admin_manage_pages"]; ?></h3>
                <div style="float: right"><a class="btn btn-block btn-success" href="?d=<?php echo $_GET["d"]; ?>&do=insert"><i class="far fa fa-plus-square nav-icon"></i> <?php echo $lang["insert"]; ?></a></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<?php
// we check if there is a variable defined
if(isset($_GET["do"])){


if(isset($_POST["action"])){
    if ( $_GET["do"] == "insert"){
        $d->InsertPage($_POST["lang"],$_POST["id_page"],$_POST["type"],$_POST["title"],$_POST["text"],$_POST["ord"],$_POST["active"]);
    }
    if ( $_GET["do"] == "update"){
        $d->UpdatePage($_POST["lang"],$_POST["id_page"],$_POST["type"],$_POST["title"],$_POST["text"],$_POST["ord"],$_POST["active"],$_POST["id"]);
    };
    $_GET["id"] = null; $_GET["do"] = null; $_GET["action"] = null;
};

    if ( $_GET["do"] == "remove"){
        $d->RemovePage($_GET["id"]);
        $_GET["id"] = null; $_GET["do"] = null;
    };
  // we check are going to insert a new record or update
    if ($_GET["do"] == "insert" or $_GET["do"] == "update"){

      // if we are goin to update will get only one record
      if ( $_GET["do"] == "update"){
                      $row = $pdo->query("SELECT * FROM pages where id = '".$_GET["id"]."' limit 1")->fetch();
      };
?>

<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["admin_pages_title"]; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" action="?d=<?php echo $_GET["d"]; ?>&do=<?php echo $_GET["do"]; ?>">
                  <input type="hidden" name="action" value="save" />
                  <?php if (isset($_GET["id"])){ ?><input type="hidden" name="id" value="<?php echo $_GET["id"];?>" /><?php }; ?>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["lang"]; ?></label>
                        <select class="form-control" name="lang">
                          <option value="<?php echo $lang["default"]; ?>"><?php echo $lang["default"]; ?></option>
                          <option value="EN">EN</option>
                          <option value="DE">DE</option>
                          <option value="FR">FR</option>
                          <option value="ES">ES</option>
                          <option value="PT">PT</option>
                          <?php if (isset($row["lang"])){ ?> <option value="<?php echo $row["lang"];?>" selected="selected"><?php echo $row["lang"];?></option><?php }; ?>
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
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["sub_page"]; ?></label>
                        <select class="form-control" name="id_page">
                        <?php
                            $dbsub = $pdo->query("SELECT * FROM pages");
                            while ($rowsub = $dbsub->fetch()) {
                        ?>
                                <option value="<?php echo  $rowsub["id"];?>" ><?php echo $rowsub["lang"]."->".$rowsub["title"];?></option>
                        <?php
                        };
                        ?>
                        <?php
                        if ($row["id_page"] > 0 ){
                            $dbsub = $pdo->query("SELECT * FROM pages where id = '".$row["id_page"]."' limit 1");
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
                        <label><?php echo $lang["type"]; ?></label>
                        <select class="form-control" name="type">
                          <option value="0" ><?php echo $lang["admin_pages_type_top"]; ?></option>
                          <option value="1" ><?php echo $lang["admin_pages_type_left"]; ?></option>
                          <option value="2" ><?php echo $lang["admin_pages_type_hidden"]; ?></option>
                          <?php if (isset($row["type"])){ ?>
                          <option value="<?php echo $row["type"]; ?>" selected="selected" >
                            <?php if ($row["type"] == 0 ){ echo $lang["admin_pages_type_top"]; }; ?>
                            <?php if ($row["type"] == 1 ){ echo $lang["admin_pages_type_left"]; }; ?>
                            <?php if ($row["type"] == 2 ){ echo $lang["admin_pages_type_hidden"]; }; ?>
                          </option>
                          <?php };?>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["ord"]; ?></label>
                        <input type="number" name="ord" class="form-control" min="0" value="<?php if (isset($row["ord"])){ echo $row["ord"]; }else{ echo "0"; }; ?>" placeholder="0">
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
                    <th><?php echo $lang["lang"]; ?></th>
                    <th><?php echo $lang["sub_page"]; ?></th>
                    <th><?php echo $lang["type"]; ?></th>
                    <th><?php echo $lang["title"]; ?></th>
                    <th><?php echo $lang["ord"]; ?></th>
                    <th><?php echo $lang["active"]; ?></th>
                    <th><?php echo $lang["options"]; ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $db = $pdo->query("SELECT * FROM pages");
                      while ($row = $db->fetch()) {
                  ?>
                  <tr>
                    <td><?php echo $row["id"];?></td>
                    <td><?php echo $row["lang"];?></td>
                    <td>
                    <?php
                      if ($row["id_page"] > 0 ){
                              $dbsub = $pdo->query("SELECT * FROM pages where id = '".$row["id_page"]."' limit 1");
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
                    <td>
                            <?php if ($row["type"] == 0 ){ echo $lang["admin_pages_type_top"]; }; ?>
                            <?php if ($row["type"] == 1 ){ echo $lang["admin_pages_type_left"]; }; ?>
                            <?php if ($row["type"] == 2 ){ echo $lang["admin_pages_type_hidden"]; }; ?>
                    </td>
                    <td><?php echo $row["title"];?></td>
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