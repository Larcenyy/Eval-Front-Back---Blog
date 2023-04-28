<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Article;
use App\Model\Entity\Comment;
use App\Model\Entity\User;
use DateTime;

class CommentManager
{
    public function getCommentById(int $id): array
    {
        $sql = "SELECT * FROM pop_commentaire WHERE article_id = :id";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $comments = [];
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
            foreach ($data as $commentData) {
                $author = (new UserManager())->getUserById($commentData['user_id']);
                $article = (new ArticleManager())->getArticleById($commentData['article_id']);
                $comment = (new Comment())
                    ->setId($commentData['id'])
                    ->setMessage($commentData['message'])
                    ->setDate(new DateTime($commentData['date']))
                    ->setAuthor($author)
                    ->setArticleId($article);
                $comments[] = $comment;
            }
        }
        return $comments;
    }
}
