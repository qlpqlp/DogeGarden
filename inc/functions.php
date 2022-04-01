<?php
/**
*   File: Functions used on the Doge Garden
*   Author: https://twitter.com/inevitable360 and all #Dogecoin friends and familly helped will try to find a way to put all names eheh!
*   Description: Real use case of the dogecoin.com CORE Wallet connected by RPC Calls using Old School PHP Coding with easy to learn steps (I hope lol)
*   License: Well, do what you want with this, be creative, you have the wheel, just reenvent and do it better! Do Only Good Everyday
*/

    // if check if the config file is loaded
    If (!defined('ROOTPATH')){
        exit();
     };
     
    // Include the Dogecoin Core Bridge
    require_once ROOTPATH.'/vendors/dogecoinRPCBridge.php';
    $DogePHPbridgeCommand = new DogecoinRpc($config["rpcuser"], $config["rpcpassword"], $config["dogecoinCoreServer"], $config["dogecoinCoreServerPort"]);

    // Add the PDO DB Connection
    $db = 'mysql:host='.$config["dbhost"].';dbname='.$config["dbname"];
    $opt = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, ];
    try {
      $pdo = new PDO($db, $config["dbuser"], $config["dbpass"], $opt);
      }
    catch (PDOException $e) {
      if(isset($config["rpcuser"]) and $config["rpcuser"] != "" ){ /*echo '<br>DB Error: ' . $e->getMessage() . '<br><br>';*/ echo '<div style="top: 50%;;left: 50%; position: absolute;-webkit-transform: translate(-50%, -50%);transform: translate(-50%, -50%);font-family: Comic Sans MS;word-break: break-all;max-width:416px"><img src="img/sad_doge.gif"><br>Sorry Shibe, there is an temporary problem and we are working on it! I will try to check in 5 seconds.</div>'; header("Refresh:5"); exit();};
     };


// class DogeBridge to be able to interact beetwin DB and Dogecoin Core RPC
class DogeBridge {

    private $pdo;     // include PDO connections
    private $config;     // include PDO connections
    public function __construct($pdo,$config) {
        $this->pdo = $pdo;
        $this->config = $config;
    }

//// Pages /////////
  // Add page
  public function InsertPage($lang,$id_page,$type,$title,$text,$ord,$active)
    {

      $this->pdo->query("INSERT INTO `pages` (
      `lang`,
      `id_page`,
      `type`,
      `title`,
      `text`,
      `ord`,
      `active`
      ) VALUES (
      '".$lang."',
      '".$id_page."',
      '".$type."',
      '".filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES)."',
      '".filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES)."',
      '".$ord."',
      '".$active."'
      );");

      return null;
    }

  // update an existent page
  public function UpdatePage($lang,$id_page,$type,$title,$text,$ord,$active,$id)
    {

      $this->pdo->query("UPDATE pages SET
      lang = '".$lang."',
      id_page = '".$id_page."',
      type = '".$type."',
      title = '".filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES)."',
      text = '".filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES)."',
      ord = '".$ord."',
      active = '".$active."'
      WHERE id = '".$id."' limit 1");

      return null;
    }

  // Reemoves page
  public function RemovePage($id)
    {

      $this->pdo->query("DELETE FROM pages where id='".$id."' limit 1");

      return null;
    }
//// END Pages /////////

//// Banners /////////
  // Add Banner
  public function InsertBanner($lang,$id_cat,$id_prod,$id_page,$img,$video,$link,$ord,$active)
    {

      $this->pdo->query("INSERT INTO `banners` (
      `lang`,
      `id_cat`,
      `id_prod`,
      `id_page`,
      `img`,
      `video`,
      `link`,
      `ord`,
      `active`
      ) VALUES (
      '".$lang."',
      '".$id_cat."',
      '".$id_prod."',
      '".$id_page."',
      '".$img."',
      '".$video."',
      '".$link."',
      '".$ord."',
      '".$active."'
      );");

      return null;
    }

  // upload files
  public function UploadFile($file)
  {

    $uploaddir = "../fl";
    $random = date("mdyHis");
    if (isset($file['name'])){
      if(is_uploaded_file($file['tmp_name'])){
        $img = str_replace(' ', '',$random.$file['name']);
        move_uploaded_file($file['tmp_name'],$uploaddir.'/'.str_replace(' ', '',$random.$file['name']));
      };
    };
    if (!isset($img)){ $img = ""; };

    return $img;

  }

  // upload multi files
  public function UploadFiles($files)
  {

    $uploaddir = "../fl";
    $random = date("mdyHis");

    $total = count($files['name']);
    $imgs = "";

    for( $i=0 ; $i < $total ; $i++ ) {
      if(is_uploaded_file($files['tmp_name'][$i])){
          $imgs = $imgs . str_replace(' ', '',$random.$files['name'][$i]) . ",";
          move_uploaded_file($files['tmp_name'][$i],$uploaddir.'/'.str_replace(' ', '',$random.$files['name'][$i]));
      };
    };

    if (!isset($imgs)){ $imgs = ""; };

    return $imgs;

  }


  // update an existent banner
  public function UpdateBanner($lang,$id_cat,$id_prod,$id_page,$img,$video,$link,$ord,$active,$id)
    {

      $this->pdo->query("UPDATE banners SET
      lang = '".$lang."',
      id_cat = '".$id_cat."',
      id_prod = '".$id_prod."',
      id_page = '".$id_page."',
      img = '".$img."',
      video = '".$video."',
      link = '".$link."',
      ord = '".$ord."',
      active = '".$active."'
      WHERE id = '".$id."' limit 1");

      return null;
    }

  // Reemoves banner
  public function RemoveBanner($id)
    {

      $this->pdo->query("DELETE FROM banners where id='".$id."' limit 1");

      return null;
    }
//// END Banners /////////


//// Categories /////////
  // Add Category
  public function InsertCategory($lang,$id_cat,$icon,$title,$text,$img,$ord,$active)
    {
      $this->pdo->query("INSERT INTO `categories` (
      `lang`,
      `id_cat`,
      `icon`,
      `title`,
      `text`,
      `img`,
      `ord`,
      `active`
      ) VALUES (
      '".$lang."',
      '".$id_cat."',
      '".$icon."',
      '".filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES)."',
      '".filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES)."',
      '".$img."',
      '".$ord."',
      '".$active."'
      );");

      return null;
    }

  // update an existent category
  public function UpdateCategory($lang,$id_cat,$icon,$title,$text,$img,$ord,$active,$id)
    {

      $this->pdo->query("UPDATE categories SET
      lang = '".$lang."',
      id_cat = '".$id_cat."',
      icon = '".$icon."',
      title = '".filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES)."',
      text = '".filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES)."',
      img = '".$img."',
      ord = '".$ord."',
      active = '".$active."'
      WHERE id = '".$id."' limit 1");

      return null;
    }

  // Reemoves category
  public function RemoveCategory($id)
    {

     $this->pdo->query("DELETE FROM categories where id='".$id."' limit 1");

      return null;
    }
//// END Categories /////////


//// Products /////////
  // Add Product
  public function InsertProduct($id_cat,$tax,$doge,$fiat,$moon_new,$moon_full,$qty,$weight,$highlighted,$title,$text,$imgs,$ord,$date,$active)
    {

     $this->pdo->query("INSERT INTO `products` (
      `id_cat`,
      `tax`,
      `doge`,
      `fiat`,
      `moon_new`,
      `moon_full`,
      `qty`,
      `weight`,
      `highlighted`,
      `title`,
      `text`,
      `imgs`,
      `ord`,
      `date`,
      `active`
      ) VALUES (
      '".$id_cat."',
      '".$tax."',
      '".$doge."',
      '".$fiat."',
      '".$moon_new."',
      '".$moon_full."',
      '".$qty."',
      '".$weight."',
      '".$highlighted."',
      '".filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES)."',
      '".filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES)."',
      '".$imgs."',
      '".$ord."',
      '".$date."',
      '".$active."'
      );");

      return null;
    }

  // update an existent Product
  public function UpdateProduct($id_cat,$tax,$doge,$fiat,$moon_new,$moon_full,$qty,$weight,$highlighted,$title,$text,$imgs,$ord,$date,$active,$id)
    {

      $this->pdo->query("UPDATE products SET
      id_cat = '".$id_cat."',
      tax = '".$tax."',
      doge = '".$doge."',
      fiat = '".$fiat."',
      moon_new = '".$moon_new."',
      moon_full = '".$moon_full."',
      qty = '".$qty."',
      weight = '".$weight."',
      highlighted = '".$highlighted."',
      title = '".filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES)."',
      text = '".filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES)."',
      imgs = '".$imgs."',
      ord = '".$ord."',
      date = '".$date."',
      active = '".$active."'
      WHERE id = '".$id."' limit 1");

      return null;
    }

  // Reemoves Product
  public function RemoveProduct($id)
    {

      $this->pdo->query("DELETE FROM products where id='".$id."' limit 1");

      return null;
    }
//// END Products /////////

//// Shibes /////////
  // Add Shibe
  public function InsertShibe($name,$email,$password,$tax_id,$address,$postal_code,$country,$city,$phone,$doge_address,$active,$date)
    {
      // we encrypt the password
      $password = hash('sha256', $password);

      $this->pdo->query("INSERT INTO `shibes` (
      `name`,
      `email`,
      `password`,
      `tax_id`,
      `address`,
      `postal_code`,
      `country`,
      `city`,
      `phone`,
      `doge_address`,
      `active`,
      `date`
      ) VALUES (
      '".filter_var($name, FILTER_SANITIZE_STRING)."',
      '".$email."',
      '".$password."',
      '".$tax_id."',
      '".filter_var($address, FILTER_SANITIZE_STRING)."',
      '".$postal_code."',
      '".filter_var($country, FILTER_SANITIZE_STRING)."',
      '".filter_var($city, FILTER_SANITIZE_STRING)."',
      '".$phone."',
      '".$doge_address."',
      '".$active."',
      '".$date."'
      );");

      return null;
    }

  // update an existent Shibe
  public function UpdateShibe($name,$email,$password = null,$tax_id,$address,$postal_code,$country,$city,$phone,$doge_address,$active,$date,$id)
    {

      // we encrypt the password if submited new
      if (isset($password) and $password != ""){
        $password = hash('sha256', $password);
        $this->pdo->query("UPDATE shibes SET
        password = '".$password."'
        WHERE id = '".$id."' limit 1");
      };

      $this->pdo->query("UPDATE shibes SET
      name = '".filter_var($name, FILTER_SANITIZE_STRING)."',
      email = '".$email."',
      tax_id = '".$tax_id."',
      address = '".filter_var($address, FILTER_SANITIZE_STRING)."',
      postal_code = '".$postal_code."',
      country = '".filter_var($country, FILTER_SANITIZE_STRING)."',
      city = '".filter_var($city, FILTER_SANITIZE_STRING)."',
      phone = '".$phone."',
      doge_address = '".$doge_address."',
      active = '".$active."',
      date = '".$date."'
      WHERE id = '".$id."' limit 1");

      return null;
    }

  // update an existent Shibe
  public function ActivateShibe($hash,$email)
    {
      // we activate the Shibe account
        $this->pdo->query("UPDATE shibes SET
        active = '1'
        WHERE password = '".$this->CleanString($hash)."' and email = '".$this->CleanEmail($email)."' limit 1");

      return null;
    }

  // recover an existent Shibe
  public function RecoverShibe($hash,$email)
    {
        // we verify if the Shibe email alredy exists
        $row = $this->pdo->query("SELECT id,name,email,password FROM shibes where email = '".$this->CleanEmail($email)."' limit 1")->fetch();

        if (isset($row["password"])){

        $password_verify = hash('sha256', $row["password"]); // doble hash for security, the password the verify against the original

          if ($password_verify == $hash){ // we check if the doble hashed password is the same has on the email link

          $password_email = bin2hex(random_bytes(10)); // we randomly generate a new password
          $password = hash('sha256', $password_email); // we hash in sha256

        // we update the Shibe password
          $this->pdo->query("UPDATE shibes SET
          password = '".$password."'
          WHERE email = '".$this->CleanEmail($email)."' limit 1");

        // we send the email to the shibe with the new password
          $mail_subject = "Much recover Shibe Password!";
          $mail_message = "Hello ".$row["name"].",<br><br>Here it is you new generated password: ".$password_email." <br><br>https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?d=login<br><br>Much Thanks!";
          $this->SendEmail($this->config["mail_name_from"],$this->config["email_from"],$this->CleanEmail($row["email"]),$mail_subject,$mail_message);

          }
        }
      return null;
    }

  // Reemoves Product
  public function RemoveShibe($id)
    {

      $this->pdo->query("DELETE FROM shibes where id='".$id."' limit 1");

      return null;
    }
//// END Shibes /////////


//// shipping /////////
  // Add shipping
  public function InsertShipping($country,$title,$text,$weight,$doge,$fiat,$active)
    {

      $this->pdo->query("INSERT INTO `shipping` (
      `country`,
      `title`,
      `text`,
      `weight`,
      `doge`,
      `fiat`,
      `active`
      ) VALUES (
      '".$country."',
      '".filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES)."',
      '".filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES)."',
      '".$weight."',
      '".$doge."',
      '".$fiat."',
      '".$active."'
      );");

      return null;
    }

  // update an existent shipping
  public function UpdateShipping($country,$title,$text,$weight,$doge,$fiat,$active,$id)
    {

      $this->pdo->query("UPDATE shipping SET
      country = '".$country."',
      title = '".filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES)."',
      text = '".filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES)."',
      weight = '".$weight."',
      doge = '".$doge."',
      fiat = '".$fiat."',
      active = '".$active."'
      WHERE id = '".$id."' limit 1");

      return null;
    }

  // Reemoves shipping
  public function RemoveShipping($id)
    {

      $this->pdo->query("DELETE FROM shipping where id='".$id."' limit 1");

      return null;
    }
//// END shipping /////////



//// orders /////////
  // Add orders
  public function InsertOrder($id_shibe,$doge_in_address,$doge_out_address,$tax,$total_doge,$doge_transaction_id,$confirmations,$date,$shipping,$products_json,$status)
    {

      $this->pdo->query("INSERT INTO `orders` (
      `id_shibe`,
      `doge_in_address`,
      `doge_out_address`,
      `tax`,
      `total_doge`,
      `doge_transaction_id`,
      `confirmations`,
      `date`,
      `status`,
      `shipping`,
      `products_json`
      ) VALUES (
      '".$id_shibe."',
      '".$doge_in_address."',
      '".$doge_out_address."',
      '".$tax."',
      '".$total_doge."',
      '".$doge_transaction_id."',
      '".$confirmations."',
      '".$date."',
      '".$status."',
      '".$shipping."',
      '".filter_var($products_json, FILTER_SANITIZE_MAGIC_QUOTES)."'
      );");

      return null;
    }

  // update an existent orders
  public function UpdateOrder($id_shibe,$doge_in_address,$doge_out_address,$tax,$total_doge,$doge_transaction_id,$confirmations,$date,$status,$shipping,$products_json,$id)
    {

      $this->pdo->query("UPDATE orders SET
      id_shibe = '".$id_shibe."',
      doge_in_address = '".$doge_in_address."',
      doge_out_address = '".$doge_out_address."',
      tax = '".$tax."',
      total_doge = '".$total_doge."',
      doge_transaction_id = '".$doge_transaction_id."',
      confirmations = '".$confirmations."',
      date = '".$date."',
      status = '".$status."',
      shipping = '".$shipping."',
      products_json = '".filter_var($products_json, FILTER_SANITIZE_MAGIC_QUOTES)."'
      WHERE id = '".$id."' limit 1");

      return null;
    }

  // update an existent orders to add the Dogecoin Pay Address
  public function UpdateOrderDogeInAddress($doge_in_address,$id)
    {
        $this->pdo->query("UPDATE orders SET
        doge_in_address = '".$doge_in_address."'
        WHERE id = '".$id."' limit 1");

        return null;
    }

  // Reemoves orders
  public function RemoveOrder($id)
    {

      $this->pdo->query("DELETE FROM orders where id='".$id."' limit 1");

      return null;
    }
//// END orders /////////




//// cart /////////
  // Add cart session
  public function InsertCart($id_shibe,$ip,$session,$product_id,$qty,$date)
    {

      $this->pdo->query("INSERT INTO `cart` (
      `id_shibe`,
      `ip`,
      `session`,
      `product_id`,
      `qty`,
      `date`
      ) VALUES (
      '".$id_shibe."',
      '".$ip."',
      '".$session."',
      '".$product_id."',
      '".$qty."',
      '".$date."'
      );");

      return null;
    }

  // update an cart session
  public function UpdateCart($id_shibe,$ip,$session,$product_id,$qty,$date,$id)
    {

      $this->pdo->query("UPDATE cart SET
      id_shibe = '".$id_shibe."',
      ip = '".$ip."',
      session = '".$session."',
      product_id = '".$product_id."',
      qty = '".$qty."',
      date = '".$date."'
      WHERE id = '".$id."' limit 1");

      return null;
    }

  // Reemoves cart session
  public function RemoveCart($id)
    {

     $this->pdo->query("DELETE FROM cart where id='".$id."' limit 1");

      return null;
    }
//// END cart /////////

  // cleans the sting complitly to prevent injection attacks
    public function CleanString($string)
      {
        return filter_var(trim($string), FILTER_SANITIZE_STRING);// we clean the string
      }

  // cleans the email complitly to prevent injection attacks
    public function CleanEmail($string)
      {
        $string = str_replace(' ', '', $string); // removes all spaces
        return filter_var($string, FILTER_SANITIZE_EMAIL); // removes special characters from emails
      }

  // cleans the sting from tags to prevent injection attacks
    public function StripString($string)
      {
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
      }

  // we get the current moon fase to apply Doge discount on prices
    public function moon()
        {

        // Use current UTC date
        date_default_timezone_set('UTC');
        $thedate = date('Y-m-d H:i:s');
        $unixdate = strtotime($thedate);

        // The duration in days of a lunar cycle
        $lunardays = 29.53058770576;
        // Seconds in lunar cycle
        $lunarsecs = $lunardays * (24 * 60 *60);
        // Date time of first new moon in year 2000
        $new2000 = strtotime("2000-01-06 18:14");

        // Calculate seconds between date and new moon 2000
        $totalsecs = $unixdate - $new2000;

        // Calculate modulus to drop completed cycles
        // Note: for real numbers use fmod() instead of % operator
        $currentsecs = fmod($totalsecs, $lunarsecs);

        // If negative number (date before new moon 2000) add $lunarsecs
        if ( $currentsecs < 0 ) {
            $currentsecs += $lunarsecs;
        }

        // Calculate the fraction of the moon cycle
        $currentfrac = $currentsecs / $lunarsecs;

        // Calculate days in current cycle (moon age)
        $currentdays = $currentfrac * $lunardays;

        // Array with start and end of each phase
        // In this array 'new', 'first quarter', 'full' and
        // 'last quarter' each get a duration of 2 days.
        $phases = array
            (
            array("new", 0, 1),
            array("waxing_crescent", 1, 6.38264692644),
            array("first_quarter", 6.38264692644, 8.38264692644),
            array("waxing_gibbous", 8.38264692644, 13.76529385288),
            array("full", 13.76529385288, 15.76529385288),
            array("waning_gibbous", 15.76529385288, 21.14794077932),
            array("last_quarter", 21.14794077932, 23.14794077932),
            array("waning_crescent", 23.14794077932, 28.53058770576),
            array("new", 28.53058770576, 29.53058770576),
            );

        // Find current phase in the array
        for ( $i=0; $i<9; $i++ ){
            if ( ($currentdays >= $phases[$i][1]) && ($currentdays <= $phases[$i][2]) ) {
                $thephase = $phases[$i][0];
                break;
            }
        }
        if ($thephase == "new" or $thephase == "full"){ return $thephase; };
        // Spit it out
        /*
        echo "<h2>Moon Phaser Demo</h2>";
        echo "<p>Demo with date and time: ".date("l, j F Y H:i:s", $unixdate)." UTC</p>";

        echo "<h2>Constants used</h2>";
        echo "<p>Duration of Lunar Cycle is: $lunardays days</p>";
        echo "<p>Date time of first new moon in 2000 is: 2000-01-06 18:14 UTC</p>";

        echo "<h2>Calculated moon phase</h2>";
        echo "<p>Percentage of lunation: ".round((100*$currentfrac),3)."%</p>";
        echo "<p>The moon age is: ".round($currentdays,3)." days</p>";
        echo "<p>The moon phase is: $thephase</p>";
        */
        return null;
    }

    public function SendEmail($mail_name_from,$email_from,$email_to,$mail_subject,$mail_message)
      {
        // Create headres for mail() function
        $headers  = "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: $mail_name_from <$email_from>\r\n";
        $headers .= "Reply-To: $email_from\r\n";

        // Send mail
        mail($email_to, $mail_subject, $mail_message, $headers);
      }

    // This functions is to get the visitor real IP
    public function getIPAddress() {
     //whether ip is from the share internet
      if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
      }
      //whether ip is from the proxy
      elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
       }
      //whether ip is from the remote address
      else{
          $ip = $_SERVER['REMOTE_ADDR'];
      }
       return $ip;
    }

    // This function converts 1 Doge to Fiat
  public function DogeFiatRates($fiat) {

        $price = json_decode(file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=".$fiat."&ids=dogecoin&per_page=1&page=1&sparkline=false"));
        return $price[0]->current_price;
  }

    // This function converts current Fiat to Doge
  public function FiatDogeRates($price = 0, $fiat) {
        $price = $price / $this->DogeFiatRates($fiat);
        return $price;
  }


};

    $d = new DogeBridge($pdo,$config);



  // clean public vars to prevent injection attempts
  if(isset($_POST["fetch"])){ $_POST["fetch"] = $d->CleanString($_POST["fetch"]); };

  if(isset($_GET["insert"])){ $_GET["insert"] = $d->CleanString($_GET["insert"]); };
  if(isset($_GET["remove"])){ $_GET["remove"] = $d->CleanString($_GET["remove"]); };
  if(isset($_GET["c"])){ $_GET["c"] = $d->CleanString($_GET["c"]); };
  if(isset($_GET["product"])){ $_GET["product"] = $d->CleanString($_GET["product"]); };
  if(isset($_GET["page"])){ $_GET["page"] = $d->CleanString($_GET["page"]); };

  // check if the language was changed
  if(isset($_GET["l"])){
    $l = $d->CleanString($_GET["l"]);
    if (!file_exists(ROOTPATH."/lang/".$l.".php")) {
        $_SESSION["l"] = $lang["default"];
    }else{
        $_SESSION["l"] = $l;
    };
  };
  // check if the language is defined
  if (!isset($_SESSION["l"])){
      $_SESSION["l"] = $lang["default"];
  }

  // we include the language file
  include("lang/".$_SESSION["l"].".php");
  if ($_SESSION["l"] == "FR"){ $land = "French"; };
  if ($_SESSION["l"] == "DE"){ $land = "Deutch"; };
  if ($_SESSION["l"] == "ES"){ $land = "Spanish"; };
  if ($_SESSION["l"] == "PT"){ $land = "Portuguese"; };

    // if cron is runnin, we check pending orders
    If (isset($cron)){
    // check pending orders


    }else{

    };
?>