<?php
class DataPay{
    public static function getDataPay(){
       // var_dump($_GET['operationId']);


        $curl = curl_init();
        $domen = 'https://api.evolgrup.elolpay.ru/v1/lite/paymentStatus?';
        $token = 'token=' . 'S7LLp2bxIm5OuixRGOwTwYG7wpKMoI4B';
        $id_oper = '&operation_id=' . '61d9eb3c-b4ee-41d9-a34a-c98ab7189404';
        $url = $domen . $token . $id_oper;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);
        echo '<br>';
        return $response;
       // var_dump($response);
    }
}


?>