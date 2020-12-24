<?

use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ModuleManager;
//include_once ('../lid/epay.php');

Loc::loadMessages(__FILE__);

Class evolgrup_elolpay extends CModule
{
    var $MODULE_ID = "evolgrup.elolpay";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function __construct()
    {
        //$arModuleVersion = array();
        $this->MODULE_VERSION = "1.0.3";
        $this->MODULE_VERSION_DATE = "20.03.2016";
        $this->MODULE_NAME = "Модуль EPay";
        $this->MODULE_DESCRIPTION = "Тестовый модуль для разработчиков, можно использовать как основу для разработки новых модулей для 1С:Битрикс";
    }


    function evelpay()
    {
        $arModuleVersion = array();
        include(__DIR__.'/version.php');
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = 'Модуль EPay';
        $this->MODULE_DESCRIPTION = 'Иновационая система платижей';
        var_dump($this->$this->MODULE_NAME );
    }

    function DoInstall()
    {
        $this->InstallDB();
        $this->InstallEvents();
        $this->InstallFiles();
        \Bitrix\Main\ModuleManager::RegisterModule($this->MODULE_ID);
        return true;
    }

    function DoUninstall()
    {
        \Bitrix\Main\ModuleManager::UnRegisterModule($this->MODULE_ID);
        $this->UnInstallFiles();
        $this->UnInstallEvents();
        $this->UnInstallDB();
        return true;

    }

    function InstallDB($install_wizard = true)
    {
        global $DB;
        $this->errors = false;
        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/evolgrup.elolpay/install/db/install.sql");
        var_dump($this->errors);
        if (!$this->errors) {
            return true;
        } else
            return $this->errors;
    }

    function UnInstallDB()
    {
        echo  'echo hz' . $_SERVER['DOCUMENT_ROOT'];

        global $DB;
        $this->errors = false;
        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/evolgrup.elolpay/install/db/uninstall.sql");
        var_dump($this->errors);
        if (!$this->errors) {
            return true;
        } else
            return $this->errors;
    }

    function InstallEvents()
    {
        return true;

    }

    function UnInstallEvents()
    {
        return true;
    }

    function InstallFiles()
    {
        CopyDirFiles(
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/sale_payment/",
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/sale_payment",
            true, true
        );
        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFilesEx("/bitrix/php_interface/include/sale_payment/.$this->MODULE_ID.");
        return true;
    }


}
?>