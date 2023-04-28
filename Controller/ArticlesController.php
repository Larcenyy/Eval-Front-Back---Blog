<?php

namespace App\Controller;

use App\Model\DB;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\CommentManager;
use App\Model\Manager\UserManager;

class ArticlesController extends AbstractController
{
    /**
     * Permet le listing de tous les utilisateurs.
     * @return void
     */

    public function view($id)
    {
        $manager = new ArticleManager();
        $comment = new CommentManager();

        $article = $manager->getArticleById($id);
        $comments = $comment->getCommentById($id);

        $this->display('articles/index', [
            'article' => $article,
            'comment' => $comments,
        ]);
    }

    public function sendMessage($id)
    {
        if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
            if (isset($_POST['comment'])) {
                $message = htmlspecialchars($_POST['comment']);

                $date = new \DateTime();
                $newDate = $date->format('Y-m-d H:i:s');

                $user_id = $_SESSION["user"]["id_user"];

                $article_id = $id;

                $sql = "INSERT INTO pop_commentaire (user_id, message, date, article_id) VALUES (:pseudo, :message, :date, :article_id)";
                $req = DB::getInstance()->prepare($sql);

                $req->bindParam(':pseudo', $user_id);
                $req->bindParam(':message', $message);
                $req->bindParam(':date', $newDate);
                $req->bindParam(':article_id', $article_id);

                $req->execute();
                header('Location: ' . $_SERVER['HTTP_REFERER']);



            } else {
                echo "<div class='warning'> Mot de passe non identique. </div>";
                echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 8000);</script>";
                $this->display('connect/login');
            }
        }
        else {
            echo "<div class='warning'> PAS CONNECTER </div>";
            echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 8000);</script>";
            $this->display('connect/login');
        }
    }
}
