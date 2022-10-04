<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/vendor/autoload.php';

use AmoCRM\Client\AmoCRMApiClient;

$clientId = 'e820dadf-afd4-4959-ab28-39b106514440';
$clientSecret = 'Ppy3pwyqBJJWeSKQLi14jjLFZp5KmKd59HbMtHyGYP6pj38z6A6yIJ4reusOKyJa';
$redirectUri = 'def50200da6a6d751e7cddcf6d9de2e40f950341536ea5f3814b0d31430d1d43196a198211b8fd1b2ea5087a2da74872024ed39a268c0cc19e3eecc0e2332ba114f1a1ff5c64a88bf98a5d800637a0eeb323a75a8adab7896ec41e3511ef487621f22242c05e8c0c5930b41c3893989495a4e09f77b20e87124d694225e5f1a3e3e810d22159bcd7e14b62744c404c5116424e8301520c1b417f18d6430d72ea1cda9a3a241ad117ba0dce6db073fe5800584ea906c84aeb68ca57089eceda5d274476a691d91377407d0db21b41c100a6dcfa68e709ccc92291174937e0fde47091da02bbb22f01e198e5b22d664c3264a340fcd135df1225106984a2c889a649af6662722167d7514c162dc09431122db1d2d0bbbda9d87746a60869f5ef23fffd1de34dc064df5b75c6fd3697b507443935dd60f8ddf0712eae98fa40a4949a0acfd55f9cb7e8162cb5fadbcfc9b5767d6b4024a25bdfa7f5066458599347a43f8a40e2e5c005b56eb8e8ff4521fcd5682a3c75d81d68919aaac15469375ba8b9093a600a5a14554c8fa137e0fe8338a6510b6d8a80457953b22477717917466a1e76215b23f2f72242e122a5a9815040662febdf9ca273a2a2d77e150a6c833a8f61f2a1515557b85505f8cf4adfb94cd713';

$apiClient = new AmoCRMApiClient($clientId, $clientSecret, $redirectUri);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="script.js"></script>
</body>
</html>