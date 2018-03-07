<?php

use Kanboard\Core\Controller\Runner;

// BEGIN: boot

require __DIR__.'/app/common.php';

$runner = new Runner($container);
$r = new ReflectionMethod($runner, 'executeMiddleware');
$r->setAccessible(true);
$r->invoke($runner);

// END: boot

// BEGIN: auth

function accessDenied($msg = '') {
    global $container;
    $container['response']->withoutCache()->text('Access denied'.($msg?': '.$msg:''), 403);
    die();
}

if (!$container['userSession']->isLogged()) {
    session_set('redirectAfterLogin', $container['request']->getUri());
    $container['response']->redirect($container['helper']->url->to('AuthController', 'login'));
    die();
}
if (!$container['userSession']->isAdmin()) {
    $container['response']->withoutCache()->text("Access denied: You're not admin", 403);
}

// END: auth

// BEGIN: check adminer

if (!is_readable(ADMINER_PATH)) {
    $container['response']->withoutCache()->text('ADMINER_PATH is not a readable file ("'.ADMINER_PATH.'")', 500);
    die();
}

// END: check adminer


// BEGIN: set up adminer

function getDbName() {
    if (DB_DRIVER == 'sqlite') {
        return DATA_DIR . DIRECTORY_SEPARATOR . 'db.sqlite';
    } else {
        return DB_NAME;
    }
}

// autologin + auto db select

$_GET['username']='';
$_GET['db'] = getDbName();
switch (DB_DRIVER) {
    case 'sqlite':
        $_GET['sqlite'] = '';
        break;
    case 'mysql':
        break;
    case 'postgres':
        $_GET['pgsql']='';
        break;
}


/* https://www.adminer.org/en/extension/ */
function adminer_object() {

    class AdminerExt extends Adminer {

        function css() {
            $return = [];
            $filename = dirname(ADMINER_PATH) . DIRECTORY_SEPARATOR . "adminer.css";
            if (file_exists($filename)) {
                $return[] = $filename;
            }
            return $return;
        }

        function navigation($missing) {
            global $container;

            echo '<h2><a href="'.$container['helper']->url->base().'">Kanboard</a><br /></h2>';
            return parent::navigation($missing);
        }

        function name() {
            return '<a href="'.strtok($_SERVER["REQUEST_URI"],'?').'" id="h1">Adminer</a>';
        }

        /** Get SSL connection options
        * @return array array("key" => filename, "cert" => filename, "ca" => filename) or null
        */
        function connectSsl() {
            $return = [];
            if (!empty(DB_SSL_KEY))  $return += ['key'  => DB_SSL_KEY];
            if (!empty(DB_SSL_CERT)) $return += ['cert' => DB_SSL_CERT];
            if (!empty(DB_SSL_CA))   $return += ['ca'   => DB_SSL_CA];
            return $return ? $return : parent::connectSsl();
        }

        /** Connection parameters
        * @return array ($server, $username, $password)
        */
        function credentials() {
            return [
                DB_HOSTNAME . (empty(DB_PORT)?'':':'.DB_PORT),
                DB_NAME,
                DB_PASSWORD
            ];
        }

        /* custom login handling, for default return true */
        function login($login, $password) {
            return true;
        }

        function database() {
            return getDbName();
        }

        function databases() {
            return [ $this->database() ];
        }

    }

    return new AdminerExt;
}

// END: set up adminer

// BEGIN: run adminer

require(ADMINER_PATH);