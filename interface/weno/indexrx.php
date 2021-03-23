<?php

/*
 *  @package OpenEMR
 *  @link    http://www.open-emr.org
 *  @author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  @copyright Copyright (c) 2021 Sherwin Gaddis <sherwingaddis@gmail.com>
 *  @license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../globals.php");

use OpenEMR\Rx\Weno\Container;

$container = new Container();

$wenoProperties = $container->getTransmitproperties();
//var_dump($wenoProperties);die;
$provider_info = $wenoProperties->getProviderEmail();
$urlParam = $wenoProperties->cipherpayload();          //lets encrypt the data

$newRxUrl = "https://online.wenoexchange.com/en/NewRx/ComposeRx?useremail=";
if ($urlParam == 'error') {   //check to make sure there were no errors
    echo xlt("Cipher failure check encryption key");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title><?php echo xlt('Weno eRx') ?></title>
</head>
<body >
<?php
    $urlOut = $newRxUrl.$provider_info['email']."&data=".urlencode($urlParam);
    //echo $urlOut; die;  //troubleshooting
    header("Location: ". $urlOut);

?>
</body>
</html>
