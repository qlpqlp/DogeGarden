<?php
// include the configuration and functions
include("config.php");

                      $db = $pdo->query("SELECT * FROM orders where status = 0"); // we get all orders with no status changed by the admin
                      while ($row = $db->fetch()) {


// we check if the order have less then 2 confirmations to update the order

if ($row["doge_in_address"] != "0"){ // if there is any error on creating a Doge Address we allow to continue
if ($row["confirmations"] < 3){ // we check all orders below 2 confirmations

    $confirmation = $DogePHPbridgeCommand->listunspent(-1,999999,[$row["doge_in_address"]]); // we get all unpent transactions recived to check if the Shibe have payed


if (isset($confirmation[0]["amount"]) and $row["total_doge"] == $confirmation[0]["amount"]){ // we check if the amount od Doge recived is correct


if ($row["doge_transaction_id"] == 0){ // if still there is no transaction ID we try to get the transaction of the payment

        // we update the transaction number
        $pdo->query("UPDATE orders SET
        doge_transaction_id = '".$confirmation[0]["txid"]."'
        WHERE id = '".$row["id"]."' limit 1");

};

        // we update the number of confirmations
        $pdo->query("UPDATE orders SET
        confirmations = '".$confirmation[0]["confirmations"]."'
        WHERE id = '".$row["id"]."' limit 1");

};

}else{

        if ($row["email_sent"] != 1){
          $shibe = $pdo->query("SELECT * FROM shibes where id = '".$row["id_shibe"]."' limit 1")->fetch();
              // we send an email to the Shibe confirming the payment recived
              $mail_subject = "Much Wow! Payment in Doge Confirmed!!";
              $mail_message = "Hello ".$shibe["name"].",<br><br>Thank you for your recent purchase. Your payment is now confirmed.<br><br>Order Number:".$row["id"]." <br><br>We will update your order shortly. Any questions, just ask.<br><br>Much Thanks!";
              $d->SendEmail($config["mail_name_from"],$config["email_from"],$shibe["email"],$mail_subject,$mail_message);

          // we update the order to check that the email was alredy sent
          $pdo->query("UPDATE orders SET
          email_sent = '1'
          WHERE id = '".$row["id"]."' limit 1");
        };
}

};
                      };

?>