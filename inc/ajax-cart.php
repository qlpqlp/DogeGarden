<?php
// include the configuration and functions
include("config.php");
?>
    <div class="p-3" style="overflow: auto; height: 100%">
      <h5><?php echo $lang["muchincart"]; ?></h5>

<table cellspacing="1" class="table table-striped table-sm table-dark" style="width:100%;">
<tbody>
<?php

// remove products from cart
if (isset($_GET["remove"])){
    $d->RemoveCart($_GET["remove"]);
}


// insere products to cart
if (isset($_GET["insert"])){
  $id_shibe = 0;
  if (isset($_SESSION["shibe"]) and $_SESSION["shibe"] > 0){
      $id_shibe = $_SESSION["shibe"];
  }
  if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $ip = $_SERVER['REMOTE_ADDR'].";".$_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
      $ip = $_SERVER['REMOTE_ADDR'];
  }

  $d->InsertCart($id_shibe,$ip,session_id(),$_GET["insert"],$_GET["qty"],date("Y-m-d H:i:s"));
}
?>

<?php
    // we initialize some vars
    $cartqty = 0; // default cart qty
    $cartweight = 0; // default cart weight
    $carttax = 0; // default cart tax
    $carttotaltax = 0; // default cart tax
    $cartmoon = 0; // default cart moon discount
    $carttotal = 0; // default cart total
        if (isset($_SESSION["shibe"]) and $_SESSION["shibe"] > 0){  // if Shib loged in we get the shibe session cart
                      // we update the cart session with the sib ID
                      $pdo->query("UPDATE cart SET id_shibe = '".$_SESSION["shibe"]."' WHERE id_shibe = '0' and session = '".session_id()."'");
                      // we get the cart products
                      $db = $pdo->query("SELECT id,product_id,qty FROM cart where id_shibe = '".$_SESSION["shibe"]."'");
        }else{  // if Shib is not loged in we get the session cart
                      // we get the cart products
                      $db = $pdo->query("SELECT id,product_id,qty FROM cart where session = '".session_id()."'");
        };
                      while ($row = $db->fetch())
                      {
                       $moon = ""; // we initialize the moon phase to every product to check discounts

                      // we get the updated product Doge price, tax etc
                       $product = $pdo->query("SELECT * FROM products where id = '".$row["product_id"]."' and active = 1 limit 1")->fetch();

                        $product["doge_new"] = $product["doge"] * $row["qty"]; // we calculate the amount of Doge to pay for each product

                        // we verify and calculate the Moon discounts
                        if ($d->moon() == "new" and $product["moon_new"] > 0){ $moon = "moon_new"; };
                        if ($d->moon() == "full" and $product["moon_full"] > 0){ $moon = "moon_full"; };
                        if ($moon != ""){ $cartmoon = $cartmoon + ($product["doge"] / 100) * $product[$moon]; $product["doge"] = ($product["doge"] / 100) * $product[$moon]; };


                       $product["doge"] = $product["doge"] * $row["qty"]; // we calculate the amount of Doge to pay for each product
                       $cartqty = $cartqty + $row["qty"]; // we calculate the product qty
                       $carttax = (number_format((float)($product["doge"] + ($product["doge"] * $product["tax"] / 100)), 8, '.', '') - $product["doge"]);  // we calculate the product tax
                       $carttotaltax = $carttotaltax + $carttax;
                       $carttotal = $carttotal + $product["doge"] + $carttax; // we calculate the total Doge
                       $cartweight = $cartweight + $product["weight"];  // we calculate the product weight
?>
  <tr>
    <td><?php echo $product["title"]; ?></td>
    <td><li class="far fa fa-times"></li> <?php echo $row["qty"]; ?> </td>
  </tr>
  <tr>
    <td>Ð <?php echo number_format((float)($product["doge_new"] + ($product["doge_new"] * $product["tax"] / 100)), 8, '.', '');?></td>
    <td><a href="javascript:removecart('<?php echo $row["id"];?>');" class="btn-xs btn-danger"><li class="far fa fa-times"></li></a></td>
  </tr>
<?php
                      };
?>
    </table>
<?php if ($cartqty > 0){ // if cart not empty
    if (isset($_SESSION["country"])){ // we checj if Shibe is logged in and we get only shipping from all countries or his own country
        $db = $pdo->query("SELECT id,doge,country FROM shipping where weight >= '".$cartweight."' and (country = '' or country = '".$_SESSION["country"]."') order by weight ASC limit 1")->fetch();
    }else{
        $db = $pdo->query("SELECT id,doge FROM shipping where weight <= '".$cartweight."' order by weight ASC limit 1")->fetch();
    }
    if (!isset($db["doge"])){ $db["doge"] = 0; };
?>
    <table cellspacing="1" class="table table-striped table-sm table-dark" style="width:100%;">
    <tbody>
      <tr>
        <td><?php echo $lang["shipping"]; ?></td>
      </tr>
      <tr>
        <td>Ð <?php echo $db["doge"]; ?></td>
      </tr>
      <tr>
        <td><?php echo $lang["tax"]; ?></td>
      </tr>
      <tr>
        <td>Ð <?php echo $carttotaltax; ?></td>
      </tr>
<?php if ($cartmoon > 0){ //&nbsp;we only display the moon discount if there is any ?>
      <tr>
        <td><?php echo $lang["moon"]; ?></td>
      </tr>
      <tr>
        <td>Ð <?php echo number_format((float)(($cartmoon)), 8, '.', '');?></td>
      </tr>
<?php }; ?>
      <tr>
        <td><?php echo $lang["total"]; ?></td>
      </tr>
      <tr>
        <td>Ð <?php echo number_format((float)(($carttotal + $db["doge"])), 8, '.', '');?></td>
      </tr>
    </tbody>
    </table>
    <a href="?d=pay-in-doge" class="btn btn-success" style="width: 100%; color: #FFFFFF">
        <i><img class="img-circle elevation-2" src="img/dogecoin.png" style="max-width: 25px; margin-top: -5px"></i>
        <?php echo $lang["payindoge"]; ?>
     </a>
<?php
    }else{  // if cart empty
?>
    <button type="button" class="btn btn-block btn-light btn-sm"><?php echo $lang["empty"]; ?></button>
<?php
    };
?>
    <script>
        $(document).ready(function(){
            $("#cartqty").html("<?php echo $cartqty; ?>");
        });
    </script>
</div>