<?php

declare(strict_types=1);

namespace Hschulz\ServiceLoader\Tests\Unit;

use Hschulz\ServiceLoader\AbstractService;
use Hschulz\ServiceLoader\CommonServiceLoader;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class CommonServiceLoaderTest extends TestCase
{
    /**
     *
     * @var AbstractService
     */
    protected ?AbstractService $mockService = null;

    /**
     *
     * @var CommonServiceLoader
     */
    protected ?CommonServiceLoader $sl = null;

    protected function setUp(): void
    {
        $this->sl = new CommonServiceLoader();
        $this->mockService = $this->getMockForAbstractClass(
            AbstractService::class,
            ['Testing']
        );
    }

    protected function tearDown(): void
    {
        $this->sl = null;
        $this->mockService = null;
    }

    public function testCanRegisterService(): void
    {
        $this->mockService->setName('TestService');

        $this->assertEquals('TestService', $this->sl->register($this->mockService));
    }

    public function testCanRegisterAnotherService(): void
    {
        $service = $this->getMockForAbstractClass(
            AbstractService::class,
            ['AnotherTest']
        );

        $service->setName('TestService2');

        $this->assertEquals('TestService2', $this->sl->register($service));
    }

    public function testCanNotRegisterSameNameTwice(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->mockService->setName('TestService');

        $this->assertEquals('TestService', $this->sl->register($this->mockService));
        $this->assertEquals('TestService', $this->sl->register($this->mockService));
    }

    public function testCanUnregisterService(): void
    {
        $name = $this->sl->register($this->mockService);

        $this->assertTrue($this->sl->unregister($name));
    }

    public function testCanNotUnregisterUnknownServiceName(): void
    {
        $this->assertFalse($this->sl->unregister('test'));
    }

    public function testCanNotRegisterServiceWithoutType(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $service = $this->getMockForAbstractClass(
            AbstractService::class,
            ['']
        );

        $this->sl->register($service);
    }

    public function testCanReturnServicesForAType(): void
    {
        $name = $this->sl->register($this->mockService);

        $services = $this->sl->getServices('Testing');

        $this->assertNotEmpty($services);

        $this->assertEquals(1, count($services));

        $this->assertArrayHasKey($name, $services);
    }

    public function testCanReturnServiceForType(): void
    {
        $this->sl->register($this->mockService);

        $service = $this->sl->getService('Testing');

        $this->assertNotNull($service);
    }

    public function testCanReturnNamedServiceForAType(): void
    {
        $name = $this->sl->register($this->mockService);

        $service = $this->sl->getService('Testing', $name);

        $this->assertNotNull($service);
    }

    public function testReturnsEmptyArrayForUnknownServiceType(): void
    {
        $services = $this->sl->getService('unknown');

        $this->assertEmpty($services);
    }

    public function testReturnsNullForGetUnknownNamedService(): void
    {
        $service = $this->sl->getService('Testing', 'unknown');

        $this->assertNull($service);
    }
}
