<?php
declare(strict_types=1);

use App\Config\DbConfig;
use App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

/**
 * Class InitUserMigration
 */
final class InitUserMigration extends Migration
{
    public function up(): void
    {
        $this->schema->dropIfExists(DbConfig::DB_USER_TABLE);
        $this->schema->create(
            DbConfig::DB_USER_TABLE,
            function (Blueprint $table) {
                // Auto-increment id
                $table->increments('id');
                $table->string('name');
                $table->string('surname');
                $table->string('email')->unique();
                // Required for Eloquent's created_at and updated_at columns
                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        $this->schema->drop(DbConfig::DB_USER_TABLE);
    }
}
