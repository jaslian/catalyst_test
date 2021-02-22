<?php

namespace Tests\Unit\Migration;

use App\Migration\InitUserMigration;
use PHPUnit\Framework\TestCase;

/**
 * Class InitUserMigrationTest.
 *
 * @covers \App\Migration\InitUserMigration
 */
class InitUserMigrationTest extends TestCase
{
    /**
     * @var InitUserMigration
     */
    protected InitUserMigration $initUserMigration;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->initUserMigration = new InitUserMigration();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->initUserMigration);
    }

    public function testUp(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testDown(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
