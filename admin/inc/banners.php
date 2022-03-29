<?php
  // make sure there is no atempt to access this file
  if (!isset($_SESSION["admin"])){ exit(); };
?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["admin_manage_banners"]; ?></h3>
                <div style="float: right"><a class="btn btn-block btn-success" href="?d=<?php echo $_GET["d"]; ?>&do=insert"><i class="far fa fa-plus-square nav-icon"></i> <?php echo $lang["insert"]; ?></a></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<?php
// we check if there is a variable defined
if(isset($_GET["do"])){


if(isset($_POST["action"])){
    if (isset($_FILES['img']['name'])){
      $_POST["img"] = $d->UploadFile($_FILES['img']);
    };
    if (!isset($_POST["img"]) or $_POST["img"] == ""){
      if (isset($_POST["imgh"])){
          $_POST["img"] = $_POST["imgh"];
      }else{
          $_POST["img"] = "";
      };
    };
    if ( $_GET["do"] == "insert"){
        $d->InsertBanner($_POST["lang"],$_POST["id_cat"],$_POST["id_prod"],$_POST["id_page"],$_POST["img"],$_POST["video"],$_POST["link"],$_POST["ord"],$_POST["active"]);
    }
    if ( $_GET["do"] == "update"){
        $d->UpdateBanner($_POST["lang"],$_POST["id_cat"],$_POST["id_prod"],$_POST["id_page"],$_POST["img"],$_POST["video"],$_POST["link"],$_POST["ord"],$_POST["active"],$_POST["id"]);
    };
    $_GET["id"] = null; $_GET["do"] = null; $_GET["action"] = null;
};

    if ( $_GET["do"] == "remove"){
        $d->RemoveBanner($_GET["id"]);
        $_GET["id"] = null; $_GET["do"] = null;
    };
  // we check are going to insert a new record or update
    if ($_GET["do"] == "insert" or $_GET["do"] == "update"){

      // if we are goin to update will get only one record
      if ( $_GET["do"] == "update"){
                      $row = $pdo->query("SELECT * FROM banners where id = '".$_GET["id"]."' limit 1")->fetch();
      };
?>

<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["admin_banners_title"]; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" action="?d=<?php echo $_GET["d"]; ?>&do=<?php echo $_GET["do"]; ?>" ENCTYPE="multipart/form-data">
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
                        <label><?php echo $lang["admin_cat"]; ?></label>
                        <select class="form-control" name="id_cat">
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
                        <label><?php echo $lang["admin_prod"]; ?></label>
                        <select class="form-control" name="id_prod">
                        <?php
                            $dbsub = $pdo->query("SELECT * FROM products");
                            while ($rowsub = $dbsub->fetch()) {
                        ?>
                                <option value="<?php echo  $rowsub["id"];?>" ><?php echo $rowsub["title"];?></option>
                        <?php
                        };
                        ?>
                        <?php
                        if ($row["id_prod"] > 0 ){
                            $dbsub = $pdo->query("SELECT * FROM products where id = '".$row["id_prod"]."' limit 1");
                            while ($rowsub = $dbsub->fetch()) {
                        ?>
                                <option value="<?php echo  $rowsub["id"];?>" selected="selected" ><?php echo $rowsub["title"];?></option>
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
                        <label><?php echo $lang["admin_page"]; ?></label>
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
                        <label><?php echo $lang["img"]; ?></label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="img" name="img">
                          <label class="custom-file-label" for="img"><?php echo $lang["img"]; ?></label>
                        </div>
                          <?php if (isset($row["img"])){ ?><img src="../fl/<?php echo $row["img"];?>" style="max-width: 200px"><input type="hidden" name="imgh" value="<?php echo $row["img"];?>" /> <br><?php }; ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label><?php echo $lang["video"]; ?></label>
                        <input type="text" name="video" class="form-control" value="<?php if (isset($row["video"])){ echo $row["video"]; }; ?>" placeholder="">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><?php echo $lang["link"]; ?></label>
                        <input type="text" name="link" class="form-control" value="<?php if (isset($row["link"])){ echo $row["link"]; }; ?>" placeholder="">
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
                    <th><?php echo $lang["admin_cat"]; ?></th>
                    <th><?php echo $lang["admin_prod"]; ?></th>
                    <th><?php echo $lang["admin_page"]; ?></th>
                    <th><?php echo $lang["img"]; ?> / <?php echo $lang["video"]; ?></th>
                    <th><?php echo $lang["ord"]; ?></th>
                    <th><?php echo $lang["active"]; ?></th>
                    <th><?php echo $lang["options"]; ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $db = $pdo->query("SELECT * FROM banners");
                      while ($row = $db->fetch()) {
                  ?>
                  <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["lang"]; ?></td>
                    <td>
                    <?php
                      if ($row["id_cat"] > 0 ){
                              $dbsub = $pdo->query("SELECT * FROM categories where id = '".$row["id_cat"]."' limit 1");
                              while ($rowsub = $dbsub->fetch()) {
                          ?>
                                  <?php echo $rowsub["lang"]." -> ".$rowsub["title"]; ?>
                          <?php
                              };
                          }else{
                            echo "---";
                          }
                        ?>
                    </td>
                    <td>
                    <?php
                      if ($row["id_prod"] > 0 ){
                              $dbsub = $pdo->query("SELECT * FROM products where id = '".$row["id_prod"]."' limit 1");
                              while ($rowsub = $dbsub->fetch()) {
                          ?>
                                  <?php echo $rowsub["title"]; ?>
                          <?php
                              };
                          }else{
                            echo "---";
                          }
                        ?>
                    </td>
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
                      <?php if ($row["img"] != ""){ ?><img src="../fl/<?php echo $row["img"];?>" style="max-width: 200px"><?php }; ?>
                      <?php if ($row["video"] != ""){ ?>
                        <div data-video="data-video" data-autoplay="true" data-hide-controls="true" data-loop="true" class="video-block" style="height: 100%;width: 100%;margin: 0;padding: 0;">
                            <iframe src="<?php echo $row["video"];?>?rel=0&controls=0&showinfo=0&wmode=opaque&autoplay=1&modestbranding=1&loop=1&mute=0" width="100%" height="100%" class="video-block__media" style="opacity: 1; transition: opacity 0.5s ease-in-out 0s;" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture; playlist; loop" ></iframe>
                        </div>
                      <?php }; ?>
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