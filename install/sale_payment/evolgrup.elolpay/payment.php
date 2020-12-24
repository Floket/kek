<?php
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Sale;
$hs = __FILE__ ;
$dir = mb_strimwidth(__FILE__, 0,strlen(__FILE__) - strripos($hs,'php_interface') - strlen('php_interface') - 1);
//echo $dir;
include_once ($dir .'/modules/evolgrup.elolpay/lib/data-pay.php');
include_once ($dir .'/modules/evolgrup.elolpay/lib/get-data-pay.php');
Loc::loadMessages(__FILE__);

//echo '<br>';



$module_id = "evolgrup.elolpay";
$order_id = $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["ID"];
$basket = Sale\Order::load($order_id)->getBasket();

$arrBasket = array();

foreach ($basket as $basketItem) {
    array_push($arrBasket, array(
        'name' => mb_strimwidth($basketItem->getField('NAME'),0, 20) . '...',
        'col' => $basketItem->getQuantity(),
        'const' =>$basketItem->getField('PRICE') * 100,
    ));
}
$token = COption::GetOptionString('evolgrup.elolpay', "token");

//echo '<br>';
//echo $token;
//echo '<br>';


//echo "<pre style='background: #222;color: #54ff00;padding: 20px;'>";
//    print_r($arrBasket);
//echo "</pre>";

$res = Evelpay\SendPay::data($arrBasket, $token);


//echo '<br>';
//var_dump($res);
//echo '<br>';


if(!isset($_GET['operationId'])) {
    // header('Location:'. $res['result']['data']['url']);
//    echo 'i tut glavnii';
}else{
//    echo '<h1>Как я попал сюда ??</h1>';
    $rez = DataPay::getDataPay($_GET['operation_id'], $token);
//    echo '<br>';
//    echo $rez['result']['amount'];
//    var_dump($rez);
//    if($rez['status']){
//        echo 'pay to pay';
//    }else{
//        echo 'pay to not pay';
//    }
    ;
    //CSaleOrder::PayOrder($order_id, "Y");
}