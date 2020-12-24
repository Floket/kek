<?
$module_id = "evolgrup.elolpay";

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/options.php");
IncludeModuleLangFile(__FILE__);

$mid = $_REQUEST["mid"];
var_dump($mid);
$STAS_RIGHT = $APPLICATION->GetGroupRight($module_id);

if ($STAS_RIGHT >= "R")
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && check_bitrix_sessid() && $STAS_RIGHT >= "W")
    {
        $errorMessage = "";
        COption::SetOptionString($module_id, "token", (strlen($_POST["token"]) > 0 ? trim($_POST["token"]) : ""));

        if (!$errorMessage)
            LocalRedirect($APPLICATION->GetCurPage()."?lang=".LANG."&mid=".urlencode($mid));
    }

    $partnerName = COption::GetOptionString($module_id, "token", "");
    var_dump($partnerName);
    $aTabs = array(
        array("DIV" => "edit1", "TAB" => 'Настройки', "ICON" => "currency_settings", "TITLE" => 'Настройки'),
    );
    $tabControl = new CAdminTabControl("tabControl", $aTabs);

    $tabControl->Begin();
    ?>
    <form method="POST" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialcharsbx($mid)?>&lang=<?echo LANG?>" name="ara">
        <?=bitrix_sessid_post();?>
        <?
        $tabControl->BeginNextTab();
        ?>
        <tr>
            <td valign="top" width="50%">
                <label for="partnet_name">Ваш токен: </label>
            </td>
            <td valign="middle" width="50%">
                <input type="text" name="token" id="token" size="35" value="<?=(isset($_POST["partner_name"]) ? htmlspecialcharsbx($_POST["partner_name"]) : htmlspecialcharsbx($partnerName))?>"/>
            </td>
        </tr>

        <?$tabControl->Buttons();?>

        <input type="submit" <?if ($STAS_RIGHT < "W") echo "disabled" ?> name="Update" value="<?echo GetMessage("MAIN_SAVE")?>">
        <input type="hidden" name="Update" value="Y">

        <?$tabControl->End();?>
    </form>
    <?
}
?>