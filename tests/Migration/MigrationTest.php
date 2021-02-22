<?php

namespace Tests\Unit\Migration;

use App\Migration\Migration;
use PHPUnit\Framework\TestCase;

/**
 * Class MigrationTest.
 *
 * @covers \App\Migration\Migration
 */
class MigrationTest extends TestCase
{
    /**
     * @var Migration
     */
    protected Migration $migration;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->migration = new Migration();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->migration);
    }

    public function testInit(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
