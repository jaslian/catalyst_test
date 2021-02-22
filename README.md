# CSV User Import Console App

## Summary

This is a command line tool that can be used to upload the user
data from a `users.csv` file to the specified MySQL database. This
can be executed directly using terminal with the working PHP cli, and
it can also be executed using docker.

## Project Structure

- `user_upload.php`: The console entry script under project root.

- `src/Config`: DB default config files.

- `src/Console`: The main command module backed by symfony/console.

- `src/Eloquent`: The ORM model module using Laravel Eloquent.

- `src/Import`: The CSV import and handler module.

- `src/Migration`: The DB initialisation and migration module.

## Requirements

* PHP: ~7.4.11
* MySQL: ~5.7.33
* Composer: ~1.9.3
* Docker(optional): ~20.10.2

## Setup Instructions
> Important note:
The commandline shortcut option `-h` specified
in the requirement documentation is conflicting with the project's
composer package `symfony/console`'s default `-h` option, which is
`--help` option's shortcut by default. This is replaced by `-t`
instead, see below usage examples for details.

- Under the project root, run `composer install` to install the
  dependencies.
- The `users.csv` should present under the project root.
- Locate your php binary file location. E.g. `/usr/bin/php`.

  Run `/usr/bin/php user_upload.php --help` to show all the command
  options.


## Commandline Usage Examples

Everytime, the MySQL database options are required:

`-u`: Specify the MySQL DB username.

`-p`: Specify the MySQL DB password.

`-t`: Specify the MySQL HOST address.

By default, the dev environment's MySQL DB username and password are both `root`.
The dev DB name is `catalyst_it_test`. Currently, the default
config value can be updated from `src/Config/DbConfig.php`.
The next update may consider adding `.env` file for holding these
DB environment values.

Eg. `php user_upload.php -uroot -proot -t127.0.0.1 [more options]`

**Note: There should be no space between the options and option values**

### Create/Rebuild the users table

The following command can be used to create/rebuild the `users`
table, this will drop the table if the table exists then crate
it again:

`php user_upload.php --create_table -uroot -proot -t127.0.0.1`

### Import users.csv file to MySQL DB

The following command can be used to import all the user data from
the specified CSV file to the database:

`php user_upload.php -fusers.csv -uroot -proot -t127.0.0.1`

`users.csv` can be any file with `.csv` extension.

If there are any invalid data detected during import process, it
will show the error message specifying the row that has the error
and error details. The script will keep running until all rows in
CSV files are traversed, inspected and imported if the row data
is valid.

### Rry Run option

The `--dry-run` option can be used to test the script execution.
If this option is present, it won't update any data in the DB,
however, it will execute all the other functions.

`php user_upload.php --dry-run --create-table -uroot -proot -t127.0.0.1`
`php user_upload.php --dry-run -fusers.csv -uroot -proot -t127.0.0.1`

## Running the console program using docker image

The following steps concluded how to run this console application
using docker container with docker command.

### Setting up the environment using `docker-Compose`

The project environment can be brought up using `docker-compose`
command with `docker-composer.yml` file.

Under the project root directory, run:

`docker-compose up -d`

### Bring down the environment

Under the project root directory, run:
`docker-compose down`

**Need to specify the host network for running PHP scripts inside docker container using MySQL DB.**

Require to have `--network host` for DB connection

### To set it up run `Composer install` first

`docker run --network host -it --rm -v "$PWD":/app composer composer install`

#### Check php version info:

docker run --network host -it --rm -v "$PWD":/app jaslian/php7.4:20210222-2 php -v

### Test the DB connection using docker container

`docker run --network host -it --rm -v "$PWD":/app jaslian/php7.4:20210222-2 php src/db-connect-test.php`

## Run Migration Script

The project comes with migration script for setup and test purposes.

### Run Migration File to set up the table

*** This is equivalent to using the `user_upload.php` script's
`--crate-table` option.***

`docker run --network host -it --rm -v "$PWD":/app jaslian/php7.4:20210222-2 php vendor/bin/phinx migrate -e dev -c src/config-phinx.php`

### Revert Migration

This command will clear up the DB and restore it to the initial state.

`docker run --network host -it --rm -v "$PWD":/app jaslian/php7.4:20210222-2 php vendor/bin/phinx migrate -t 0 -e dev -c src/config-phinx.php`

### Run Seeder

This will add dummy data to the users table for testing purpose.

`docker run --network host -it --rm -v "$PWD":/app jaslian/php7.4:20210222-2 php vendor/bin/phinx seed:run -e dev -c src/config-phinx.php`

## Run PHPUnit using docker container

(The tests are WIP)
`docker run --network host -it --rm -v "$PWD":/app jaslian/php7.4:20210222-2 php vendor/bin/phpunit`

## Git conventional commit

This project is following git conventional commit:

https://www.conventionalcommits.org/en/v1.0.0/

## TODOs

- [ ] Update tests
- [ ] Use `.env` to replace config file  
- [ ] Enforce Conventional Commits using Git hooks
- [ ] Implement Github CI/CD using Github actions
