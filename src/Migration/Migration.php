<?php

declare(strict_types=1);

namespace App\Migration;

use App\Config\DbUserConfig;
use App\Eloquent\Encapsulator;
use Phinx\Migration\AbstractMigration;

/**
 * Class Migration
 * @package App\Migration
 */
class Migration extends AbstractMigration
{
    /** @var Illuminate\Database\Capsule\Manager $capsule */
    public $capsule;
    /** @var Illuminate\Database\Schema\Builder $capsule */
    public $schema;

    /**
     * Proxy init from Encapsulator to use Eloquent.
     *
     * @param DbUserConfig|null $config
     */
    public function init(DbUserConfig $config = null) {
        if ($config === null) {
            $config = new DbUserConfig();
        }

        $this->capsule = Encapsulator::init($config);
        $this->schema = $this->capsule->schema();
    }
}
