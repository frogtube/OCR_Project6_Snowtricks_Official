<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements AdvancedUserInterface, \Serializable
{
    private $id;
    private $username;
    private $email;
    private $firstname;
    private $lastname;
    private $plainPassword;
    private $password;
    private $avatar;
    private $roles = [];
    private $isActive;
    private $createdAt;
    private $resetPasswordToken;
    private $resetPasswordTokenTimestamp;
    private $activationToken;
    private $image;
    private $tricks;
    private $comments;

    public function __construct()
    {
        $this->isActive = true;
        $this->resetPasswordToken = null;
        $this->tricks = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    // SETTERS

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function setIsActive(bool $active): void
    {
        $this->isActive = $active;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setResetPasswordToken(?string $resetPasswordToken): void
    {
        $this->resetPasswordToken = $resetPasswordToken;
    }

    public function setResetPasswordTokenTimestamp(?\DateTime $resetPasswordTokenTimestamp): void
    {
        $this->resetPasswordTokenTimestamp = $resetPasswordTokenTimestamp;
    }

    public function setActivationToken(?string $activationToken): void
    {
        $this->activationToken = $activationToken;
    }

    public function setImage(Image $image = null): void
    {
        $this->image = $image;
    }

    // GETTERS
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getResetPasswordToken(): ?string
    {
        return $this->resetPasswordToken;
    }

    public function getResetPasswordTokenTimestamp(): ?\DateTime
    {
        return $this->resetPasswordTokenTimestamp;
    }

    public function getActivationToken(): ?string
    {
        return $this->activationToken;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function getTricks(): ?ArrayCollection
    {
        return $this->tricks;
    }

    public function getComments(): ?ArrayCollection
    {
        return $this->comments;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
        ));
    }
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            ) = unserialize($serialized);
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    public function createUser($password, User $user)
    {
        $user->setPassword($password);
        $user->setCreatedAt(new \DateTime('now'));
        $user->setRoles(array('ROLE_USER'));
    }


}