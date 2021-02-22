<?php

namespace Tests\Unit\Config;

use App\Config\DbConfig;
use PHPUnit\Framework\TestCase;

/**
 * Class DbConfigTest.
 *
 * @covers \App\Config\DbConfig
 */
class DbConfigTest extends TestCase
{
    /**
     * @var DbConfig
     */
    protected $dbConfig;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->dbConfig = new DbConfig();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->dbConfig);
    }
}
