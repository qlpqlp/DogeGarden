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

// we check if the Dogecoin Node is working before generating the order and payment details
if ($DogePHPbridgeCommand->getconnectioncount() == "" and $DogePHPbridgeCommand->getconnectioncount() < 1){
?>
    <script>
            window.location.href = "//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>?d=error";
    </script>
<?php
exit();
}
?>
<div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $lang["payindoge"]; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

<?php
    // we initialize some vars
    $cartqty = 0; // default cart qty
    $cartweight = 0; // default cart weight
    $carttax = 0; // default cart tax
    $carttotaltax = 0; // default cart tax
    $cartmoon = 0; // default cart moon discount
    $carttotal = 0; // default cart total
    $i = 0; //&nbsp;initialize count var
        if (isset($_SESSION["shibe"]) and $_SESSION["shibe"] > 0){  // if Shib loged in we get the shibe session cart
                      // we update the cart session with the sib ID
                      $pdo->query("UPDATE cart SET id_shibe = '".$_SESSION["shibe"]."' WHERE id_shibe = '0' and session = '".session_id()."'");
                      // we get the cart products
                      $db = $pdo->query("SELECT id,product_id,qty FROM cart where id_shibe = '".$_SESSION["shibe"]."'");
        //}else{  // if Shib is not loged in we get the session cart
                      // we get the cart products
          //            $db = $pdo->query("SELECT id,product_id,qty FROM cart where session = '".session_id()."'");
        };
                      while ($row = $db->fetch())
                      {
                       $moon = ""; // we initialize the moon phase to every product to check discounts

                      // we get the updated product Doge price, tax etc
                       $product = $pdo->query("SELECT * FROM products where id = '".$row["product_id"]."' and active = 1 limit 1")->fetch();

                        $product["doge_new"] = $product["doge"] * $row["qty"]; // we calculate the amount of Doge to pay for each product
                        $product['qty'] = $row["qty"];

                        // we verify and calculate the Moon discounts
                        if ($d->moon() == "new" and $product["moon_new"] > 0){ $moon = "moon_new"; };
                        if ($d->moon() == "full" and $product["moon_full"] > 0){ $moon = "moon_full"; };
                        if ($moon != ""){ $cartmoon = $cartmoon + ($product["doge"] / 100) * $product[$moon]; $product["doge"] = ($product["doge"] / 100) * $product[$moon]; };

                         $rowt["tax"] = 0; // we set default to zero
                         if (isset($_SESSION["country"])){ // we check if Shibe is logged in and we get only shipping from all countries or his own country
                            $rowt = $pdo->query("SELECT * FROM tax where category = '".$product["cat_tax"]."' and country = '".$_SESSION["country"]."' limit 1")->fetch();
                         }else{
                            $rowt = $pdo->query("SELECT * FROM tax where category = '".$product["cat_tax"]."' limit 1")->fetch();
                         }
                       $product["tax"] = $rowt["tax"];
                       $product["doge"] = $product["doge"] * $row["qty"]; // we calculate the amount of Doge to pay for each product
                       $cartqty = $cartqty + $row["qty"]; // we calculate the product qty
                       $carttax = (number_format((float)($product["doge"] + ($product["doge"] * $product["tax"] / 100)), 8, '.', '') - $product["doge"]);  // we calculate the product tax
                       $carttotaltax = $carttotaltax + $carttax;
                       $carttotal = $carttotal + $product["doge"] + $carttax; // we calculate the total Doge
                       $cartweight = $cartweight + $product["weight"];  // we calculate the product weight

                       $products_json[$i] = $product; // we add all product details to an array to insert in the order as JSON

                       $d->RemoveCart($row["id"]); // we remove the product from the cart
                       $i ++; // we continue the array count for each product
                      };
?>
<?php if ($cartqty > 0){ // if cart not empty
    if (isset($_SESSION["country"])){ // we checj if Shibe is logged in and we get only shipping from all countries or his own country
        $shipping = $pdo->query("SELECT id,doge,country FROM shipping where weight >= '".$cartweight."' and (country = '' or country = '".$_SESSION["country"]."') order by weight ASC limit 1")->fetch();
   // }else{
   //     $shipping = $pdo->query("SELECT id,doge FROM shipping where weight >= '".$cartweight."' order by weight ASC limit 1")->fetch();
    };

    // we make sure there is a shipping method to send/sell to that country
    if (!isset($shipping["id"])){
?>
    <script>
            window.location.href = "//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>?d=shipping";
    </script>
<?php
    exit();
    };

    if (!isset($shipping["doge"])){ $shipping["doge"] = 0; };
    if ($cartweight == 0 ){ $shipping["doge"] = 0; };  // offer free shipping if weight is zero

      $total_doge = number_format((float)(($carttotal + $shipping["doge"])), 8, '.', '');

      $d->InsertOrder($_SESSION["shibe"],0,0,$carttotaltax,$total_doge,0,0,date("Y-m-d H:i:s"),$shipping["doge"],json_encode($products_json),0);
      $order = $pdo->query("SELECT * FROM orders where id_shibe = '".$_SESSION["shibe"]."' order by id DESC limit 1")->fetch();


      $products = json_decode(html_entity_decode($order["products_json"]));

      $products_email = "Products/Services details<br>";
      foreach($products as $product)

      {
        $products_email .= "____________________<br>";
        $products_email .= $product->title." [Id: ".$product->id."]<br>";
        $products_email .= "Ð ".$lang["doge"].": ".$product->doge."<br>";
        if (isset($product->tax)){ $products_email .= $lang["tax"]." %".": ".$product->tax."<br>"; };
        if (isset($product->qty)){ $products_email .= $lang["qty"].": ".$product->qty."<br>"; };
        if (isset($product->moon_new)){ $products_email .= $lang["moon_new"]." ".$lang["discount"].": ".$product->moon_new."<br>"; };
        if (isset($product->moon_full)){ $products_email .= $lang["moon_full"]." ".$lang["discount"].": ".$product->moon_full."<br>"; };
        if (isset($product->weight)){ $products_email .= $lang["weight"]. ": ".$product->weight."<br>"; };
        $products_email .= "____________________<br>";
      }

      $doge_in_address = $DogePHPbridgeCommand->getnewaddress("DogeGarden->".$_SESSION["shibe"]."->".$order["id"]."->".time());

      $d->UpdateOrderDogeInAddress($doge_in_address,$order["id"]);

                $shibe = $pdo->query("SELECT * FROM shibes where id = '".$_SESSION["shibe"]."' limit 1")->fetch();
              // we send an email to the Shibe confirming the payment recived
              $mail_subject = "Much Wow! Such Doge Payment Waiting!";
              $mail_message = "Hello ".$shibe["name"].",<br><br>Thank you for your recent purchase. Please make the an total payment of<br><br>Ð ".$total_doge." <br><br>to the address<br><br> ".$doge_in_address."<br><br> After payment you will recive a confirmation by email.<br><br>".$products_email."<br><br>Much Thanks!";
              $d->SendEmail($config["mail_name_from"],$config["email_from"],$shibe["email"],$mail_subject,$mail_message);

              // send copy to the Admin
              $mail_subject = "Much Congrats Owner! Such New Order Recived!";
              $mail_message = "Hello Owner,<br><br>The Shibe ".$shibe["name"]." (Id: ".$shibe["id"].")<br>>Has made an new order!<br><br>Total:<br><br>Ð ".$total_doge." <br><br>".$products_email."<br><br>You can check on the Backoffice of your DogeGarden Store<br><br>Much Thanks!";
              $d->SendEmail($config["mail_name_from"],$config["email_from"],$config["mail_name_from"],$mail_subject,$mail_message);

?>
<div class="row">
<div class="col-lg-3" style="float:none;margin:auto; text-align: center">
                      <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h5 class="m-0">Ð <?php echo $total_doge; ?></h5>
                        </div>
                        <div class="card-body" style="text-align: center">
                            <img id="qrcode" src="//api.qrserver.com/v1/create-qr-code/?data=<?php echo $doge_in_address; ?>&amp;size=400x400" alt="" title="Such QR Code!" class="card-img-top" style="max-width: 400px"/>
                        </div>
                      </div>
                      <?php echo $doge_in_address; ?>
                      <a href="?d=orders&do=update&id=<?php echo $order["id"]; ?>" class="btn btn-warning" style="margin-top: 10px; margin-bottom: 10px; width: inherit">View Order Details</a>
                    </div>
</div>
    <div class="callout callout-warning">
                  <p><?php echo $lang["correct_amount"]; ?></p>
    </div>
    <script>
        $(document).ready(function(){
            $("#cartqty").html("<?php echo $cartqty; ?>");
        });
    </script>
<?php
}else{ // if there is no products in cart and someone tries to access this page it redirects to main page
?>
    <script>
            window.location.href = "//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>";
    </script>
<?php
};?>
              </div>
            </div>