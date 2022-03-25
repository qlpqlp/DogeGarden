<?php
if (isset($_POST["run"])){
    include("../../inc/config.php");
    $response = $DogePHPbridgeCommand->getinfo();
    if(isset($response["version"])){ echo $response["version"]; };
};
?>