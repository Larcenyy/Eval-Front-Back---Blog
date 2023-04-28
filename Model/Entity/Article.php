<?php

namespace App\Model\Entity;

class Article
{
    private int $id;
    private int $image_id;

    private string $title;
    private ?string $content;


    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return "/assets/images/upload_image/image_" . $this->image_id . ".jpg";
    }

    /**
     * @param int $imageId
     * @return Article
     */
    public function setImageId(int $imageId): self
    {
        $this->image_id = $imageId;
        return $this;
    }

    private User $author;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Article
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;
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


}
