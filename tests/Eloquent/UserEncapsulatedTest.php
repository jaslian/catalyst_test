<?php

namespace Tests\Unit\Eloquent;

use App\Config\DbUserConfig;
use App\Eloquent\UserEncapsulated;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

/**
 * Class UserEncapsulatedTest.
 *
 * @covers \App\Eloquent\UserEncapsulated
 */
class UserEncapsulatedTest extends TestCase
{
    /**
     * @var UserEncapsulated
     */
    protected UserEncapsulated $userEncapsulated;

    /**
     * @var array
     */
    protected array $attributes;

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

        $this->attributes = [];
        $this->config = Mockery::mock(DbUserConfig::class);
        $this->userEncapsulated = new UserEncapsulated($this->attributes, $this->config);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->userEncapsulated);
        unset($this->attributes);
        unset($this->config);
    }

    public function testSetNameAttribute(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSetSurnameAttribute(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSetEmailAttribute(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTitleCase(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
