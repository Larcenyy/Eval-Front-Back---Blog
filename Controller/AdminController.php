<?php

namespace App\Controller;

use App\Model\DB;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\CommentManager;

class AdminController extends AbstractController
{
    /**
     * Permet le listing de tous les utilisateurs.
     * @return void
     */
    public function index()
    {
        $this->display('admin/index');
    }

    public function pageCreateArticle()
    {
        $this->display('admin/article/create');
    }

    public function pageDeleteArticle()
    {
        $manager = new ArticleManager();
        $this->display('admin/article/delete', [
            'articles' => $manager->getAll(),
        ]);
    }

    public function viewModify($id)
    {
        $manager = new ArticleManager();
        $comment = new CommentManager();

        $article = $manager->getArticleById($id);
        $comments = $comment->getCommentById($id);

        $this->display('admin/article/modify', [
            'article' => $article,
            'comment' => $comments,
        ]);
    }

    public function createArticle() {
        if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
            // Vérifier que le formulaire a été soumis
            if(isset($_POST['create_content'])) {
                // Vérifier que tous les champs sont remplis
                if(isset($_POST['title_create']) && isset($_POST['content']) && isset($_FILES['image'])) {
                    $title = $_POST['title_create'];
                    $content = $_POST['content'];
                    $image = $_FILES['image'];
                    $user_id = $_SESSION["user"]["id_user"];

                    // Vérifier que l'image est au bon format et qu'il n'y a pas d'erreur lors de l'upload
                    if($image['type'] === 'image/gif' || $image['type'] === 'image/png' || $image['type'] === 'image/jpeg' && $image['error'] === 0) {

                        // Créer un dossier s'il n'existe pas déjà
                        $folder = './assets/images/upload_image';
                        if(!is_dir($folder)) {
                            mkdir($folder);
                        }

                        $filename = $_FILES['image']['name'];
                        $extension = pathinfo($filename, PATHINFO_EXTENSION);
                        $files = glob($folder . '/*');
                        $num = count($files);

                        // Récupérer le nouveau nom de fichier avec le numéro incrémenté
                        $newfilename = 'image_' . ($num + 1) . '.' . $extension;

                        // Extraire le numéro de l'image à partir de son nom de fichier
                        preg_match('/image_(\d+)\./', $newfilename, $matches);
                        $image_id = $matches[1];

                        // Déplacer le fichier téléchargé vers le dossier de destination en le renommant
                        if(move_uploaded_file($_FILES['image']['tmp_name'], $folder . '/' . $newfilename)) {
                            // Ajouter l'article dans la base de données avec le numéro d'image
                            $sql = "INSERT INTO pop_article (title, content, user_id, image_id) VALUES (:title, :content, :user_id, :image_id)";
                            $req = DB::getInstance()->prepare($sql);

                            $req->bindParam(':title', $title);
                            $req->bindParam(':content', $content);
                            $req->bindParam(':user_id', $user_id);
                            $req->bindParam(':image_id', $image_id);

                            $req->execute();
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                        } else {
                            echo "Erreur lors du téléchargement de l'image";
                        }

                    }
                    else
                    {
                        echo "Type d'image incorrect";
                    }

                }
                else
                {
                    echo "erreur 2";
                }
            }
            else
            {
                echo "erreur 1";
            }
        }
        header('Location: /connect');
    }

    public function modifyArticle($id)
    {
        if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
            $article_id = $id;
            $article_content = $_POST['areaText'];

            $sql = "UPDATE pop_article SET content = :article_content WHERE id= :article_id";
            $req = DB::getInstance()->prepare($sql);

            $req->bindParam(':article_id', $article_id);
            $req->bindParam(':article_content', $article_content);

            $req->execute();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else {
            echo "<div class='warning'>Vous n'êtes pas login..</div>";
            echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 4000);</script>";
            $this->display('connect/login');
        }
    }


    public function deleteComment($id)
    {
        if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
            $comment_id = $id;

            $sql = "DELETE FROM pop_commentaire WHERE id= :comment_id";
            $req = DB::getInstance()->prepare($sql);

            $req->bindParam(':comment_id', $comment_id);

            $req->execute();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else {
            echo "<div class='warning'>Vous n'êtes pas login..</div>";
            echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 4000);</script>";
            $this->display('connect/login');
        }
    }

    public function deleteArticle($id)
    {
        if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
            $article_id = $id;

            $sql = "DELETE FROM pop_article WHERE id= :article_id";
            $req = DB::getInstance()->prepare($sql);

            $req->bindParam(':article_id', $article_id);

            $req->execute();
            header('Location: /admin');

        }
        else {

            //Utiliser JavaScript pour masquer le message d'avertissement après quelques secondes
            echo '<script>setTimeout(function(){ document.querySelector(".warning").style.display = "none"; }, 4000);</script>';
            // Afficher le formulaire de connexion
            $this->display("connect/login");
        }
    }
}

