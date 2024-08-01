<?php
$bitrixpath = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/base/admin/base_homepage.php";
$localpath = $_SERVER["DOCUMENT_ROOT"] . "/local/modules/base/admin/base_homepage.php";

if (file_exists($bitrixpath)) {
    require($bitrixpath);
} else if (file_exists($localpath)) {
    require($localpath);
}
