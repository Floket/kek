<?php
namespace Evelpay\EpayTable;

use Bitrix\Main\Entity;

class EpayTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'epay_token';
    }

    public static function getMap()
    {
        return array(
        new Entity\IntegerField('ID'),
        new Entity\StringField('TOKEN'),
        );
    }
}
?>

<!--CREATE TABLE epay_option (-->
<!--ID INT PRIMARY KEY,-->
<!--TOKEN  VARCHAR(50)-->
<!--);-->
