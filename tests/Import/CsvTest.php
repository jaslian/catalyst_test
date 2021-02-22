<?php

namespace Tests\Unit\Import;

use App\Import\Csv;
use PHPUnit\Framework\TestCase;

/**
 * Class CsvTest.
 *
 * @covers \App\Import\Csv
 */
class CsvTest extends TestCase
{
    /**
     * @var Csv
     */
    protected Csv $csv;

    /**
     * @var string
     */
    protected string $path;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->path = '42';
        $this->csv = new Csv($this->path);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->csv);
        unset($this->path);
    }

    public function testLoad(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testToCollection(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
