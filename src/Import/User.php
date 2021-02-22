<?php

namespace App\Import;

/**
 * Class User
 * @package App\Import
 */
class User
{
    /**
     * @var string First name.
     */
    private string $name;

    /**
     * @var string Last Name.
     */
    private string $surname;

    /**
     * @var string Email.
     */
    private string $email;

    /**
     * User constructor.
     * @param string $name
     * @param string $surname
     * @param string $email
     */
    public function __construct(string $name, string $surname, string $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string  $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string  $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string  $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
