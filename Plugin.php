<?php

namespace Kanboard\Plugin\Adminer;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Security\Role;

class Plugin extends Base
{
    public function initialize()
    {
        $this->applicationAccessMap->add('AdminerController', '*', Role::APP_ADMIN);

        $this->template->hook->attach('template:config:sidebar', 'Adminer:config/sidebar');
    }

    public function onStartup()
    {
    }

    public function getPluginName()
    {
        return 'Adminer';
    }

    public function getPluginDescription()
    {
        return t('Adminer');
    }

    public function getPluginAuthor()
    {
        return 'Jan Chren (rindeal)';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/rindeal/kanboard-adminer-plugin';
    }
}

