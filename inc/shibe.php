<?php
// we check if there is a variable defined
if(isset($_GET["do"])){

      // we verify and login the Sibe
      if ($_GET["do"] == "login" and isset($_POST["email"]) and isset($_POST["password"])){
                      $row = $pdo->query("SELECT id FROM shibes where email = '".$d->CleanEmail($_POST["email"])."' and password = '".hash('sha256', $_POST["password"])."' and active = 1 limit 1")->fetch();
                      if (isset($row["id"])){
                        $_SESSION["shibe"] = $row["id"];
?>
    <script>
            window.location.href = "//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>?shibe=login";
    </script>
<?php
                      }else{
// if the login is not valid we redirect to main page                        
?>
          <script>
                  window.location.href = "//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>";
          </script>
<?php
                      }
      }else{
// if the account is not activated we redirect to main page
        if ( $_GET["do"] == "logout"){
?>
          <script>
                  window.location.href = "//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>";
          </script>
<?php
        }
    };
      // we logout the shib
      if ( $_GET["do"] == "logout"){
            $_SESSION["shibe"] = NULL;
?>
    <script>
            window.location.href = "//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>?shibe=logout";
    </script>
<?php
      };

if(isset($_POST["action"])){
    if ( $_GET["do"] == "insert" and isset($_POST["email"])){

        // we verify if the Shibe email alredy exists
        $exists = $pdo->query("SELECT id FROM shibes where email = '".$d->CleanEmail($_POST["email"])."' limit 1")->fetch();

        if (!isset($exists["id"])){
            $d->InsertShibe($d->CleanString($_POST["name"]),$d->CleanEmail($_POST["email"]),$_POST["password"],$d->CleanString($_POST["tax_id"]),$d->CleanString($_POST["address"]),$d->CleanString($_POST["postal_code"]),$d->CleanString($_POST["country"]),$d->CleanString($_POST["city"]),$d->CleanString($_POST["phone"]),$d->CleanString($_POST["doge_address"]),0,date("Y-m-d H:i:s"));

            $mail_subject = "Much verify Shibe Account!";
            $mail_message = "Hello ".$d->CleanString($_POST["name"]).",<br><br>To activate your Shibe account please click on this link: https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?shibe=activate&hash=".hash('sha256', $_POST["password"])."&email=".$d->CleanEmail($_POST["email"])."<br><br>Much Thanks!";
            $d->SendEmail($config["mail_name_from"],$config["email_from"],$d->CleanEmail($_POST["email"]),$mail_subject,$mail_message);
?>
    <script>
            window.location.href = "//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>?shibe=verify";
    </script>
<?php
        }else{
?>
    <script>
            window.location.href = "//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>?shibe=exists";
    </script>
<?php
        };
    }
    if ( $_GET["do"] == "update" and iseet($_SESSION["shibe"]) and $_SESSION["shibe"] > 0){
        $d->UpdateShibe($d->CleanString($_POST["name"]),$d->CleanEmail($_POST["email"]),$_POST["password"],$d->CleanString($_POST["tax_id"]),$d->CleanString($_POST["address"]),$d->CleanString($_POST["postal_code"]),$d->CleanString($_POST["country"]),$d->CleanString($_POST["city"]),$d->CleanString($_POST["phone"]),$d->CleanString($_POST["doge_address"]),$d->CleanString($_POST["active"]),date("Y-m-d H:i:s"),$_POST["id"]);
    };

    $_GET["id"] = null; $_GET["do"] = null; $_GET["action"] = null;
};
    // add later for compilace with RGPD EU Laws
    //if ( $_GET["do"] == "remove"){
        //$d->RemoveShibe($d->CleanString($_GET["id"]));
        //$_GET["id"] = null; $_GET["do"] = null;
    //};
  // we check are going to insert a new record or update
    if ($_GET["do"] == "insert" or $_GET["do"] == "update"){

      // if we are goin to update will get only one record
      if ($_GET["do"] == "update" and isset($_SESSION["shibe"]) and $_SESSION["shibe"] > 0){
                      $row = $pdo->query("SELECT * FROM shibes where id = '".$_SESSION["shibe"]."' limit 1")->fetch();
      };
?>
<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["shibes_insert_title"]; ?></h3>
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