<?php
setlocale(LC_ALL, 'ru_RU.utf8');
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
CModule::IncludeModule("iblock");
IncludeModuleLangFile(__FILE__);

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;

$request = Application::getInstance()->getContext()->getRequest();

if ($request->isPost()) {
    $inputValue = $request->getPost('input_value');

    if ($inputValue != '') {
        Option::set("base", "input_value", $inputValue);
    }
}

CJSCore::Init(array("jquery"));

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

$aTabs[] = ["DIV" => "settings", "TAB" => 'Настройки', "TITLE" => 'Настройки'];

$tabControl = new CAdminTabControl("tabControl", $aTabs);
?>

    <form method="post" action="<? echo $APPLICATION->GetCurPage() ?>" enctype="multipart/form-data" name="validation"
          id="validation">

        <? $tabControl->Begin(); ?>
        <? $tabControl->BeginNextTab(); ?>

        <label for="input_value">Настройки</label>
        <br/>
        <input type="text"
               name="input_value"
               id="input_value"
               value="<?= COption::getOptionString('base', 'input_value'); ?>"
               style="width: 100%"
        />
        <br/>

        <? $tabControl->Buttons(); ?>
        <input class="adm-btn" type="submit" name="Update_tab1"
               value="Применить"
               title="Применить">
        <? echo bitrix_sessid_post(); ?>
        <? $tabControl->End(); ?>
    </form>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");

