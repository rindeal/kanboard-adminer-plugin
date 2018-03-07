<?php
/**
 * kanboard-adminer-plugin
 * Copyright (C) 2018  Jan Chren (rindeal)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

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

