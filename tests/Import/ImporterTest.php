<?php

namespace Tests\Unit\Import;

use App\Config\DbUserConfig;
use App\Import\ImportableInterface;
use App\Import\Importer;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

/**
 * Class ImporterTest.
 *
 * @covers \App\Import\Importer
 */
class ImporterTest extends TestCase
{
    /**
     * @var Importer
     */
    protected Importer $importer;

    /**
     * @var ImportableInterface|Mock
     */
    protected $source;

    /**
     * @var DbUserConfig|Mock
     */
    protected $config;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->source = Mockery::mock(ImportableInterface::class);
        $this->config = Mockery::mock(DbUserConfig::class);
        $this->importer = new Importer($this->source, $this->config);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->importer);
        unset($this->source);
        unset($this->config);
    }

    public function testSaveDb(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testIsValidName(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testIsValidEmail(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
