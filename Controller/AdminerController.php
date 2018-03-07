<?php

namespace Kanboard\Plugin\Adminer\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Core\Controller\PageNotFoundException;


class AdminerController extends BaseController
{
    public function redirect()
    {
        $this->response->redirect($this->helper->url->base()."/adminer.php");
    }
}
