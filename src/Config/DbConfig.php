<?php

declare(strict_types=1);

namespace App\Config;

/**
 * The config settings.
 *
 * Class DbConfig
 * @package App\Config
 */
class DbConfig
{
    /**
     * Database host address.
     */
    public const DB_HOST = '127.0.0.1';

    /**
     * Database name.
     */
    public const DB_NAME = 'catalyst_it_test';

    /**
     * Database table name for user.
     */
    public const DB_USER_TABLE = 'users';

    /**
     * Database username.
     */
    public const DB_USER = 'root';

    /**
     * Database user password.
     */
    public const DB_PASSWORD = 'root';

    /**
     * Database port.
     */
    public const DB_PORT = 3306;

    /**
     * Database default charset.
     */
    public const DB_CHARSET = 'utf8mb4';

    /**
     * Database default collation.
     */
    public const DB_COLLATION = 'utf8mb4_unicode_ci';

    /**
     * Database default driver.
     */
    public const DB_DEFAULT_DRIVER = 'mysql';
}
