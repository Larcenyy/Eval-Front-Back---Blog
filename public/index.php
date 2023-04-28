<?php

// Inclusion des classes autres.
use App\Controller\RootController;

require_once dirname(__FILE__) . '/../Model/DB.php';
require_once dirname(__FILE__) . '/../Controller/AbstractController.php';
require_once dirname(__FILE__) . '/../Controller/RootController.php';

// Inclusion des entités.
require_once dirname(__FILE__) . '/../Model/Entity/User.php';
require_once dirname(__FILE__) . '/../Model/Entity/Article.php';
require_once dirname(__FILE__) . '/../Model/Entity/Comment.php';

// Inclusion des managers.
require_once dirname(__FILE__) . '/../Model/Manager/ArticleManager.php';
require_once dirname(__FILE__) . '/../Model/Manager/UserManager.php';
require_once dirname(__FILE__) . '/../Model/Manager/CommentManager.php';


require_once dirname(__FILE__) . '/router.php';
