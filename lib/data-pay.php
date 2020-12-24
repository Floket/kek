<?php

namespace Evelpay;

class SendPay extends \CModule
{

    public function data($arr, $tk) {
//        $arr = [
//            [
//                "name" => "pan",
//                "col" => 2,
//                "const" => 25,
//            ],
//            [
//                "name" => "pan",
//                "col" => 1,
//                "const" => 25,
//            ],
//            [
//                "name" => "book",
//                "col" => 1,
//                "const" => 25,
//            ],
//        ];

         $token = $tk;




        $redirectUrl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
        if($_SERVER['HTTPS']){
            $redirectUrl = 'https://' . $redirectUrl;
        }else{
            $redirectUrl = 'http://' . $redirectUrl;
        }

        $data =[
            "amount" => 100,
//            "amount" => self::sum($arr),
            "data" => "url,qr:100",
            'redirect_success' => $redirectUrl,
            "product_data" => self::basket($arr),
        ];



        $curl = curl_init();


        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.evolpay.ru/v1/lite/payment?token=' . $token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>  json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        return $response;

    }

    public static function basket($arr){
        $newArr = [];
         self::optionArr('title');
         foreach ($arr as $val){
            array_push($newArr, [
                'title'  => $val[self::optionArr('title')],
                'quantity'  => $val[self::optionArr('quantity')],
                'amount'  => $val[self::optionArr('amount')],

            ]);

         }
         return $newArr;

    }

    public static function sum($arr) {
        $col = self::optionArr('quantity');
        $amo = self::optionArr('amount');
        $sum = 0;
        foreach ($arr as $val){
            $sum = $sum + $val[$amo] * $val[$col];
        }
        return $sum;
    }

    public static function optionArr($key) {
        $arrOpt = [
            'title' => 'name',
            'quantity' => 'col',
            'amount' => 'const',
        ];
        return $arrOpt[$key];
    }
}
?>