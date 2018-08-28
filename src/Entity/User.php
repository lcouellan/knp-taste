<?php

namespace App\Entity;

use Knp\Rad\User\HasPassword;

class User implements HasPassword
{

    use HasPassword\HasPassword;

    private $id;

    private $email;

    private $password;

    private $username;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return HasPassword
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}