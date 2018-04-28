<?php

namespace hschulz\ServiceLoader\Tests;

use \PHPUnit\Framework\TestCase;
use \hschulz\ServiceLoader\AbstractService;

final class AbstractServiceTest extends TestCase {

    /**
     *
     * @var AbstractService
     */
    protected $mockService = null;

    protected function setUp() {
        $this->mockService = $this->getMockForAbstractClass(
            AbstractService::class, ['Testing']
        );

        $this->mockService->setName('TestService');
    }

    protected function tearDown() {
        $this->mockService = null;
    }

    public function testCanCreateServiceWithType() {
        $this->assertEquals('Testing', $this->mockService->getType());
    }

    public function testCanSetName() {
        $this->assertEquals('TestService', $this->mockService->getName());
    }

    public function testCanOverwriteServiceType() {

        $this->mockService->setType('UnitTest');

        $this->assertEquals('UnitTest', $this->mockService->getType());
    }

    public function testCanOverwriteServiceName() {

        $this->mockService->setName('UnitTest');

        $this->assertEquals('UnitTest', $this->mockService->getName());
    }
}
