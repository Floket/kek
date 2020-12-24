<?php

//
//    $classes = array(
//        "Evelpay\Evelpay" => "/bitrix/modules/evelpay/lib/data-pay.php",
//    );
//
//Bitrix\Main\Loader::registerAutoLoadClasses(null, array(
//    '\Olegpro\Helpers\MobileDetect' => '/local/php_interface/classes/helpers/mobiledetect.php',
//));

Bitrix\Main\Loader::registerAutoloadClasses(
    "evolgrup.elolpay",
    array(
        "My\\Space\\SendPay" => "/bitrix/modules/evelpay/lib/data-pay.php",
    )
);
?>