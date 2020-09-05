<?php

declare(strict_types = 1);

namespace Hschulz\ServiceLoader\Tests\Unit;

use Hschulz\ServiceLoader\AbstractService;
use PHPUnit\Framework\TestCase;

final class AbstractServiceTest extends TestCase
{
    /**
     *
     * @var AbstractService
     */
    protected ?AbstractService $mockService = null;

    protected function setUp(): void
    {
        $this->mockService = $this->getMockForAbstractClass(
            AbstractService::class, ['Testing']
        );

        $this->mockService->setName('TestService');
    }

    protected function tearDown(): void
    {
        $this->mockService = null;
    }

    public function testCanCreateServiceWithType(): void
    {
        $this->assertEquals('Testing', $this->mockService->getType());
    }

    public function testCanSetName(): void
    {
        $this->assertEquals('TestService', $this->mockService->getName());
    }

    public function testCanOverwriteServiceType(): void
    {
        $this->mockService->setType('UnitTest');

        $this->assertEquals('UnitTest', $this->mockService->getType());
    }

    public function testCanOverwriteServiceName(): void
    {
        $this->mockService->setName('UnitTest');

        $this->assertEquals('UnitTest', $this->mockService->getName());
    }
}
