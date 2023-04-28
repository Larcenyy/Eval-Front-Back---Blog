<?php

namespace App\Model\Entity;

class Comment
{
    private int $id;
    private string $message;
    private $date;
    private User $author;
    private Article $article;



    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }


    /**
     * @param string $message
     * @return Article
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }



    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return Article
     */
    public function setAuthor(User $author): self
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Article
     */
    public function getArticleId(): Article
    {
        return $this->article;
    }

    /**
     * @param Article $article
     * @return Article
     */
    public function setArticleId(Article $article): self
    {
        $this->article = $article;
        return $this;
    }


}
