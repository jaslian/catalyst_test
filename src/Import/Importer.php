<?php

namespace App\Import;

use App\Config\DbUserConfig;
use App\Eloquent\UserEncapsulated;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Importer
{
    /**
     * @var Collection
     */
    protected $users;

    /**
     * @var DbUserConfig
     */
    protected $dbConfig;

    /**
     * Importer constructor.
     * @param ImportableInterface $source
     * @param DbUserConfig $config
     */
    public function __construct(ImportableInterface $source, DbUserConfig $config)
    {
        $this->dbConfig = $config;
        $source->load();
        $this->users = $source->toCollection();
    }

    /**
     * Save source data to DB.
     * @param bool $isDryRun
     * @return bool
     */
    public function saveDb(bool $isDryRun = false): bool
    {
        $config = $this->dbConfig;
        $users = $this->users;

        $hasError = false;

        /**
         * @var $key
         * @var User $user
         */
        foreach ($users as $key => $user) {
            try {
                $userModel = new UserEncapsulated([], $config);

                $name = trim($user->getName());
                $surname = trim($user->getSurname());
                $email = trim($user->getEmail());

                if (!self::isValidName($name)) {
                    throw new \Exception("First name $name is invalid. Skipping.");
                }

                if (!self::isValidName($surname)) {
                    throw new \Exception("Last name $surname is invalid. Skipping.");
                }

                if (!self::isValidEmail($email)) {
                    throw new \Exception("Email address $email is invalid. Skipping.");
                }

                // Check if duplicate email first.
                $foundEmail = UserEncapsulated::where('email', $email)->first();
                if ($foundEmail) {
                    throw new \Exception("Duplicate email $email found. Skipping.");
                }

                $userModel->name = $name;
                $userModel->surname = $surname;
                $userModel->email = $email;

                if (!$isDryRun) {
                    $userModel->save();
                }
            } catch (\Exception $e) {
                $hasError = true;
                // Show error and skipping.
                echo sprintf(
                    "Error occurred at row %d: %s \n",
                    $key + 2,
                    $e->getMessage()
                );
                continue;
            }
        }

        return $hasError;
    }

    /**
     * Validate the name using Regex.
     *
     * @param string $name
     * @return bool
     */
    public static function isValidName(string $name): bool
    {
        return preg_match("/^[a-z ,.'-]{1,254}$/iu", $name) === 1;
    }

    /**
     * Validate the email using filter_var and Regex match.
     *
     * @param string $email
     * @return bool
     */
    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false && preg_match('/(?!.*@.*@)/', $email);
    }
}
