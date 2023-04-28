<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Article;
use App\Model\Entity\Comment;
use DateTime;
class ArticleManager
{
    public function getAll(): array
    {
        $articles = [];
        $sql = "SELECT * FROM pop_article";
        $request = DB::getInstance()->query($sql);
        if($request) {
            $data = $request->fetchAll();
            foreach ($data as $articleData) {
                $author = (new UserManager())->getUserById($articleData['user_id']);

                $articles[] = (new Article())
                    ->setId($articleData['id'])
                    ->setContent($articleData['content'])
                    ->setTitle($articleData['title'])
                    ->setAuthor($author)
                    ->setImageId($articleData['image_id'])
                ;
            }
        }
        return $articles;
    }

    public function getArticleById(int $id): ?Article
    {
        $sql = "SELECT * FROM pop_article WHERE id = :id";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            $data = $stmt->fetchAll();
            foreach ($data as $articleData) {
                $author = (new UserManager())->getUserById($articleData['user_id']);
                return (new Article())
                    ->setId($articleData['id'])
                    ->setContent($articleData['content'])
                    ->setTitle($articleData['title'])
                    ->setAuthor($author)
                    ->setImageId($articleData['image_id'])
                    ;
            }
        }

        return null;
    }
}
