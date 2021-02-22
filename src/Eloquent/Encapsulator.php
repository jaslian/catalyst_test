<?php

declare(strict_types=1);

namespace App\Eloquent;

use App\Config\DbConfig;
use App\Config\DbUserConfig;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

/**
 * Class Encapsulator
 *
 * @package App\Eloquent
 */
class Encapsulator
{
    private static $conn;

    public function __construct()
    {
    }

    /**
     * Initialize capsule and store reference to connection
     *
     * @param DbUserConfig $config
     * @return Capsule
     */
    public static function init(DbUserConfig $config): Capsule {
        $host = $config->getHost();
        $user = $config->getUsername();
        $password = $config->getPassword();

        if (is_null(self::$conn)) {
            $capsule = new Capsule();

            $capsule->addConnection(
                [
                    'driver' => DbConfig::DB_DEFAULT_DRIVER,
                    'host' => $host,
                    'port' => DbConfig::DB_PORT,
                    'database' => DbConfig::DB_NAME,
                    'username' => $user,
                    'password' => $password,
                    'charset' => DbConfig::DB_CHARSET,
                    'collation' => DbConfig::DB_COLLATION,
                    'prefix' => '',
                ]
            );

            $capsule->setEventDispatcher(new Dispatcher(new Container()));

            // Make this Capsule instance available globally via static methods... (optional)
            $capsule->setAsGlobal();

            // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
            $capsule->bootEloquent();

            return $capsule;
        }
    }
}
