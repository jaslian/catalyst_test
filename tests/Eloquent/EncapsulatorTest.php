<?php

namespace Tests\Unit\Eloquent;

use App\Eloquent\Encapsulator;
use PHPUnit\Framework\TestCase;

/**
 * Class EncapsulatorTest.
 *
 * @covers \App\Eloquent\Encapsulator
 */
class EncapsulatorTest extends TestCase
{
    /**
     * @var Encapsulator
     */
    protected Encapsulator $encapsulator;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->encapsulator = new Encapsulator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->encapsulator);
    }

    public function testInit(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
