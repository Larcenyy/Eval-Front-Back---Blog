<?php

namespace App\Controller;

use App\Model\Manager\ArticleManager;
use App\Model\Manager\UserManager;

class HomeController extends AbstractController
{
    /**
     * Permet le listing de tous les utilisateurs.
     * @return void
     */
    public function index()
    {
        $manager = new ArticleManager();
        $this->display('home/index', [
            'articles' => $manager->getAll(),
        ]);
    }

}
