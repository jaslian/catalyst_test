#!/usr/bin/env php
<?php

namespace App\Console;

require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;

$composerContent = json_decode(file_get_contents('composer.json'), true);

$command = new UploadUserCommand();
$application = new Application('user_upload', $composerContent['version']);
$application->add($command);
$application->setDefaultCommand($command->getName());
try {
    $application->run();
} catch (\Exception $e) {
    echo sprintf("Error occurred: %s\n", $e->getMessage());
}
