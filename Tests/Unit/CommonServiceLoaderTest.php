<?php

namespace hschulz\ServiceLoader\Tests;

use \PHPUnit\Framework\TestCase;
use \hschulz\ServiceLoader\AbstractService;
use \hschulz\ServiceLoader\CommonServiceLoader;
use \InvalidArgumentException;

final class CommonServiceLoaderTest extends TestCase {

    /**
     *
     * @var AbstractService
     */
    protected $mockService = null;

    /**
     *
     * @var CommonServiceLoader
     */
    protected $sl = null;

    protected function setUp() {
        $this->sl = new CommonServiceLoader();
        $this->mockService = $this->getMockForAbstractClass(
            AbstractService::class, ['Testing']
        );
    }

    protected function tearDown() {
        $this->sl = null;
        $this->mockService = null;
    }

    public function testCanRegisterService() {

        $this->mockService->setName('TestService');

        $this->assertEquals('TestService', $this->sl->register($this->mockService));
    }

    public function testCanRegisterAnotherService() {
        $service = $this->getMockForAbstractClass(
            AbstractService::class, ['AnotherTest']
        );

        $service->setName('TestService2');

        $this->assertEquals('TestService2', $this->sl->register($service));
    }

    public function testCanNotRegisterSameNameTwice() {

        $this->expectException(InvalidArgumentException::class);

        $this->mockService->setName('TestService');

        $this->assertEquals('TestService', $this->sl->register($this->mockService));
        $this->assertEquals('TestService', $this->sl->register($this->mockService));
    }

    public function testCanUnregisterService() {

        $name = $this->sl->register($this->mockService);

        $this->assertTrue($this->sl->unregister($name));
    }

    public function testCanNotUnregisterUnknownServiceName() {

        $this->assertFalse($this->sl->unregister('test'));
    }

    public function testCanNotRegisterServiceWithoutType() {

        $this->expectException(InvalidArgumentException::class);

        $service = $this->getMockForAbstractClass(
            AbstractService::class, ['']
        );

        $this->sl->register($service);
    }

    public function testCanReturnServicesForAType() {

        $name = $this->sl->register($this->mockService);

        $services = $this->sl->getServices('Testing');

        $this->assertNotEmpty($services);

        $this->assertEquals(1, count($services));

        $this->assertArrayHasKey($name, $services);
    }

    public function testCanReturnServiceForType() {

        $this->sl->register($this->mockService);

        $service = $this->sl->getService('Testing');

        $this->assertNotNull($service);
    }

    public function testCanReturnNamedServiceForAType() {

        $name = $this->sl->register($this->mockService);

        $service = $this->sl->getService('Testing', $name);

        $this->assertNotNull($service);
    }

    public function testReturnsEmptyArrayForUnknownServiceType() {

        $services = $this->sl->getService('unknown');

        $this->assertEmpty($services);
    }

    public function testReturnsNullForGetUnknownNamedService() {

        $service = $this->sl->getService('Testing', 'unknown');

        $this->assertNull($service);
    }
}
