<?php
if (isset($_POST["configfile"])){
  $path_to_file = '../../inc/config.php';
  $file_contents = file_get_contents($path_to_file);

  $file_contents = str_replace('$config["dbhost"] = "localhost"', '$config["dbhost"] = "'.$_POST["dbhost"].'"', $file_contents);
  $file_contents = str_replace('$config["dbname"] = ""', '$config["dbname"] = "'.$_POST["dbname"].'"', $file_contents);
  $file_contents = str_replace('$config["dbuser"] = ""', '$config["dbuser"] = "'.$_POST["dbuser"].'"', $file_contents);
  $file_contents = str_replace('$config["dbpass"] = ""', '$config["dbpass"] = "'.$_POST["dbpass"].'"', $file_contents);

  $file_contents = str_replace('$config["mail_name_from"] = "DogeGarden"', '$config["mail_name_from"] = "'.$_POST["mail_name_from"].'"', $file_contents);
  $file_contents = str_replace('$config["email_from"] = "demo@localhost"', '$config["email_from"] = "'.$_POST["email_from"].'"', $file_contents);

  $file_contents = str_replace('$config["admin_user"] = "wow"', '$config["admin_user"] = "'.$_POST["admin_user"].'"', $file_contents);
  $file_contents = str_replace('$config["admin_pass"] = "dogecoin"', '$config["admin_pass"] = "'.$_POST["admin_pass"].'"', $file_contents);

  $file_contents = str_replace('$config["fiat"] = "usd"', '$config["fiat"] = "'.$_POST["fiat"].'"', $file_contents);
  $file_contents = str_replace('$lang["default"] = "EN"', '$lang["default"] = "'.$_POST["default"].'"', $file_contents);

  $file_contents = str_replace('$config["rpcuser"] = ""', '$config["rpcuser"] = "'.$_POST["rpcuser"].'"', $file_contents);
  $file_contents = str_replace('$config["rpcpassword"] = ""', '$config["rpcpassword"] = "'.$_POST["rpcpassword"].'"', $file_contents);
  $file_contents = str_replace('$config["dogecoinCoreServer"] = ""', '$config["dogecoinCoreServer"] = "'.$_POST["dogecoinCoreServer"].'"', $file_contents);
  $file_contents = str_replace('$config["dogecoinCoreServerPort"] = "22555"', '$config["dogecoinCoreServerPort"] = "'.$_POST["dogecoinCoreServerPort"].'"', $file_contents);

  file_put_contents($path_to_file, $file_contents);
};
?>
<script type="text/javascript">
window.print();
window.onfocus=function(){ window.close();}
</script>