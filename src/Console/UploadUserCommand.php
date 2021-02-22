<?php

declare(strict_types=1);

namespace App\Console;

use App\Config\DbUserConfig;
use App\Import\Csv;
use App\Import\Importer;
use App\Migration\InitUserMigration;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\MissingInputException;

final class UploadUserCommand extends SymfonyCommand
{
    /**
     * Override the default command the console is running when no command name is passed.
     *
     * @var string
     */
    protected static $defaultName = 'upload:user';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add the command options and their descriptions.
     */
    protected function configure(): void
    {
        // General descriptions.
        $this->setDescription('Upload user data from CSV.')
            ->setHelp('This command allows you to upload user data stored in a CSV file to the MySQL database.');

        // Add --file CSV file path option.
        $this->addOption(
            'file',
            'f',
            InputOption::VALUE_REQUIRED,
            'The user CSV file path for import.'
        );

        // Add create_table option This option will cause the MySQL users table to be built.
        $this->addOption(
            'create_table',
            null,
            InputOption::VALUE_NONE,
            'This option will allow the MySQL users table to be built and no further action will be taken.'
        );

        // Add dry-run option.
        $this->addOption(
            'dry-run',
            null,
            InputOption::VALUE_NONE,
            'Executes a dry run without the database update.'
        );

        // Add user option to specify the MySQL DB username.
        $this->addOption(
            'mysql_user',
            'u',
            InputOption::VALUE_REQUIRED,
            'Specify the MySQL DB username.'
        );

        // Add password option to specify the MySQL DB password.
        $this->addOption(
            'mysql_password',
            'p',
            InputOption::VALUE_REQUIRED,
            'Specify the MySQL DB password.'
        );

        // Add host option to specify the MySQL DB host.
        // This shortcut will have to be '-t', since '-h' conflicts with symfony/console's default -h option.
        $this->addOption(
            'mysql_host',
            't',
            InputOption::VALUE_REQUIRED,
            'Specify the MySQL DB host.'
        );
    }

    /**
     * Execute based on the input options.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $isDryRun = (bool) $input->getOption('dry-run');

        if ($isDryRun) {
            $output->writeln("--dry-run option detected, starting dry run.");
        }

        $filePath = (string) $input->getOption('file');

        $mysqlHost = (string) $input->getOption('mysql_host');
        $mysqlUser = (string) $input->getOption('mysql_user');
        $mysqlPassword = (string) $input->getOption('mysql_password');

        $config = new DbUserConfig($mysqlHost, $mysqlUser, $mysqlPassword);

        // If one of the MySQL command options is present, the other two options will be required.
        $isValidDbConfig = $this->validateDbConfigOptions($input);
        if (!$isValidDbConfig) {
            throw new MissingInputException('Invalid or missing MySQL config values');
        }

        // Create table if create_table option is found, command should terminate no matter success or fail.
        try {
            $willCreateTable = $input->getOption('create_table');

            if ($willCreateTable) {
                $output->writeln("Creating users table.");

                if (!$isDryRun) {
                    // Set up a new migration instance, 20210222144746 is the migration version number.
                    $userMigration = new InitUserMigration('dev', '20210223144746');
                    $userMigration->init($config);
                    $userMigration->up();
                }

                return SymfonyCommand::SUCCESS;
            }
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            return SymfonyCommand::FAILURE;
        }

        try {
            if (!$filePath || !file_exists($filePath)) {
                $output->writeln("Please specify the valid file path using te option --f [csv file name].");
                return SymfonyCommand::FAILURE;
            }

            $csvSource = new Csv($filePath);
            $importer = new Importer($csvSource, $config);
            $resultErrText = $importer->saveDb($isDryRun) ? ' with error(s)' : ' without error';
            $output->writeln("CSV to MySQL import is complete$resultErrText.");
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            return SymfonyCommand::FAILURE;
        }

        return SymfonyCommand::SUCCESS;
    }

    /**
     * Check if all DB config values 'mysql_user', 'mysql_password' and 'mysql_host' are present.
     *
     * @param InputInterface $input
     * @return bool
     */
    protected function validateDbConfigOptions(InputInterface $input): bool
    {
        $mySqlConfigValues = ['mysql_user', 'mysql_password', 'mysql_host'];

        // If one of these options is present, we'll need to check if the other two options are present.
        $hasMysqlConfig = function () use ($input, $mySqlConfigValues) {
            foreach ($mySqlConfigValues as $value) {
                if ($input->hasOption($value)) {
                    return true;
                }
            }

            return false;
        };

        if ($hasMysqlConfig()) {
            foreach ($mySqlConfigValues as $value) {
                if (!$input->getOption($value)) {
                    return false;
                }
            }

            return true;
        }

        return true;
    }
}
