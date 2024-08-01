<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$menu = array(
    0 => Array(
        'parent_menu' => 'global_menu_settings',
        'sort' => 10,
        'text' => 'Base',
        'title' => 'Base',
        'url' => 'base_homepage.php',
        'icon' => 'sys_menu_icon',
    ),
);

return $menu;
