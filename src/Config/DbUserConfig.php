<?php

declare(strict_types=1);

namespace App\Config;

/**
 * The config settings that has setters and can be updated.
 *
 * Class DbUserConfig
 * @package App\Config
 */
class DbUserConfig extends DbConfig
{
    protected string $host;
    protected string $username;
    protected string $password;

    /**
     * DbUserConfig constructor.
     * @param $host
     * @param $username
     * @param $password
     */
    public function __construct(
        string $host = parent::DB_HOST,
        string $username = parent::DB_USER,
        string $password = parent::DB_PASSWORD
    ) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
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
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
