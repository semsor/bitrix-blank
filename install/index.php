<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;

Loc::loadMessages(__FILE__);

class module_base extends CModule
{
    /**
     * @var string
     */
    public $MODULE_ID = 'base';

    /**
     * @var string
     */
    public $MODULE_VERSION;

    /**
     * @var string
     */
    public $MODULE_VERSION_DATE;

    /**
     * @var string
     */
    public $MODULE_NAME;

    /**
     * @var string
     */
    public $MODULE_DESCRIPTION;

    /**
     * @var string
     */
    public $PARTNER_NAME;

    /**
     * @var string
     */
    public $PARTNER_URI;

    /**
     * @var Bitrix\Main\DB\ConnectionPool
     */
    private $connection;


    /**
     * Construct object
     */
    public function __construct()
    {
        $this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('PARTNER_NAME');
        $this->PARTNER_URI = Loc::getMessage('PARTNER_NAME');
        $this->MODULE_PATH = $this->getModulePath();

        $arModuleVersion = array();
        include $this->MODULE_PATH . '/install/version.php';

        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];

        $this->connection = Application::getConnection();
    }

    /**
     * Return path module
     *
     * @return string
     */
    protected function getModulePath(): string
    {
        $modulePath = explode('/', __FILE__);
        $modulePath = array_slice($modulePath, 0, array_search($this->MODULE_ID, $modulePath) + 1);

        return join('/', $modulePath);
    }

    /**
     * Install module
     *
     * @return void
     */
    public function doInstall()
    {
        RegisterModule($this->MODULE_ID);
        $this->installFiles();
    }



    /**
     * Remove module
     *
     * @return void
     */
    public function doUninstall()
    {
        $this->unInstallFiles();
        UnRegisterModule($this->MODULE_ID);
    }

    /**
     * Copy files module
     *
     * @return bool
     */
    public function installFiles(): bool
    {
        CopyDirFiles($this->MODULE_PATH . '/install/admin', getenv('DOCUMENT_ROOT') . '/bitrix/admin', true, true);
        return true;
    }

    /**
     * Remove files module
     *
     * @return bool
     */
    public function unInstallFiles(): bool
    {
        DeleteDirFiles($this->MODULE_PATH . '/install/admin', getenv('DOCUMENT_ROOT') . '/bitrix/admin');
        return true;
    }
}
