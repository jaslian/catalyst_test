<?php

namespace Tests\Unit\Console;

use App\Console\UploadUserCommand;
use PHPUnit\Framework\TestCase;

/**
 * Class UploadUserCommandTest.
 *
 * @covers \App\Console\UploadUserCommand
 */
class UploadUserCommandTest extends TestCase
{
    /**
     * @var UploadUserCommand
     */
    protected UploadUserCommand $uploadUserCommand;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->uploadUserCommand = new UploadUserCommand();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->uploadUserCommand);
    }
}
