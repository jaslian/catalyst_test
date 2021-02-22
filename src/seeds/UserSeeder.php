<?php
declare(strict_types=1);

use App\Config\DbConfig;
use Phinx\Seed\AbstractSeed;
use Faker\Factory;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [];
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'email' => $faker->email(),
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        $users = $this->table(DbConfig::DB_USER_TABLE);
        $users->insert($data)
            ->saveData();
    }
}
