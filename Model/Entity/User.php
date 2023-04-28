<?php

namespace App\Model\Entity;

class User
{
    private int $id;
    private string $email;
    private string $pseudo;
    private string $password;
    private bool $is_admin = false;


    /**
     * @return bool
     */
    public function getIsAdmin(): bool {
        return $this->is_admin;
    }

    public function setIsAdmin(bool $is_admin): self {
        $this->is_admin = $is_admin;
        return $this;
    }

    /**
     * @param bool $is_admin
     */
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     * @return User
     */
    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
}
