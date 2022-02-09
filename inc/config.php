<?php
/**
*   File: Default Configuration of Doge Garden
*   Author: https://twitter.com/inevitable360 and all #Dogecoin friends and familly helped will try to find a way to put all names eheh!
*   Description: Real use case of the dogecoin.com CORE Wallet connected by RPC Calls using Old School PHP Coding with easy to learn steps (I hope lol)
*   License: Well, do what you want with this, be creative, you have the wheel, just reenvent and do it better! Do Only Good Everyday
*/

session_start();
    //ini_set('display_errors', 1);

    // Add your Data Base credentials here!
    $config["dbhost"] = "localhost";  // put here you database adress
    $config["dbname"] = "XXXXX"; // your DB name
    $config["dbuser"] = "XXXXX"; // your DB username
    $config["dbpass"] = "XXXXX"; // your DB password

    $config["mail_name_from"] = "XXXXX"; //name to show on all emails sent
    $config["email_from"] = "XXXXX"; // email to show and reply on all emails sent

    $config["admin_user"] = "wow"; // your admin user
    $config["admin_pass"] = "dogecoin"; // your admin password

    $lang["default"] = "EN"; // Default Language

    // Add your Dogecoin Core Node credentials here!
    $config["rpcuser"] = "XXXXX";
    $config["rpcpassword"] = "XXXXX";
    $config["dogecoinCoreProtocol"] = "http://";
    $config["dogecoinCoreServer"] = "XXXXX";
    //$config["dogecoinCoreServerPort"] = 44555; //testnet
     $config["dogecoinCoreServerPort"] = 22555; //mainnet
    // DANGER |||| DANGER |||| DANGER |||| DANGER
    //$config["UnlockDogecoinWalletPassword"] = "XXXXX"; // only used to actually send $DOGE, if you have your Dogecoin Core Wallet Encrypted like you should have :)
    // DANGER |||| DANGER |||| DANGER |||| DANGER

    define('ROOTPATH', __DIR__);
    // include functions
    include("functions.php");
    // we include the DogeGarden version
    include("v.php");
?>