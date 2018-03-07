<li <?= $this->app->checkMenuSelection('AdminerController', 'redirect', 'Adminer') ?>>
    <?= $this->url->link('Adminer', 'AdminerController', 'redirect', ['plugin' => 'Adminer']) ?>
</li>
