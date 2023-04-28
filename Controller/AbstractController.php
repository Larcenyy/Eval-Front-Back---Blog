<?php

namespace App\Controller;

use App\Model\Manager\UserManager;

abstract class AbstractController
{
    public function display(string $view, array $params = [])
    {
        ob_start();
        require_once dirname(__FILE__) . "/../View/$view.php";
        $html = ob_get_clean();

        require_once dirname(__FILE__) . '/../View/layout.php';
        exit();
    }


    /**
     * Display any error type.
     * @param int $type
     * @return void
     */

    public function displayError(int $type)
    {
        $this->display("error/$type");
    }
}
