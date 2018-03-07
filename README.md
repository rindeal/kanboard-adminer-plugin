Adminer Plugin For Kanboard
==============================

Installation
------------

### 1. Install base files

You have the choice between 3 methods:
  1. Install the plugin from the Kanboard plugin manager in one click
  2. Download the zip file and decompress everything under the directory `plugins/Adminer`
  3. Clone this repository into the folder `plugins/Adminer`

Note: Plugin folder is case-sensitive.

### 2. Install `adminer.php`

In the root directory of this plugin there is a file called `adminer.php`, move it to the root directory of your Kanboard installation. This step is required because Adminer must be called from the PHP's global scope and won't work if called from a method in a controller.

### 3. Download `adminer-*.php` and configure path

Go to https://www.adminer.org/ and download it. Then place it somewhere and define `ADMINER_PATH` in you `config.php` to the path where you placed it. By default it's `<DATA_DIR>/adminer/adminer.php`.

Documentation
-------------

Only a logged user with admin role can run it. To run Adminer visit app settings and in the sidebar you should see _Adminer_ link. If ou click on it you will be redirected to _Adminer_.
