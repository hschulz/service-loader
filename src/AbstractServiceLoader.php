<?php

namespace hschulz\ServiceLoader;

use \hschulz\ServiceLoader\Service;
use \hschulz\ServiceLoader\ServiceLoader;

/**
 *
 */
abstract class AbstractServiceLoader implements ServiceLoader {

    /**
     *
     * @var array
     */
    private $services = [];

    /**
     *
     */
    public function __construct() {
        $this->services = [];
    }

    /**
     *
     * @param string $type
     * @param string $name
     * @return Service|null
     */
    public function getService(string $type, string $name = ''): ?Service {

        $services = $this->services[$type] ?? [];

        if (empty($services)) {
            return null;
        }

        if ($name !== '') {
            return $services[$name] ?? null;
        }

        return reset($services);
    }

    /**
     *
     * @param string $type
     * @return array
     */
    public function getServices(string $type): array {
        return $this->services[$type] ?? [];
    }

    /**
     *
     * @param Service $service
     * @throws InvalidArgumentException
     * @return string
     */
    public function register(Service $service): string {

        $type = $service->getType();
        $name = $service->getName();

        if ($type === '') {
            throw new \InvalidArgumentException();
        }

        $this->services[$type] = $this->services[$type] ?? [];

        if (!isset($this->services[$type])) {
            $this->services[$type] = [];
        }

        if ($name === '') {

            $name = $type . '_service_';

            $name .= md5($name);

            $service->setName($name);
        }

        if (isset($this->services[$type][$name])) {
            throw new \InvalidArgumentException();
        }

        $this->services[$type][$name] = $service;

        return $name;
    }

    /**
     *
     * @param string $name
     * @return bool
     */
    public function unregister(string $name): bool {

        $result = false;

        foreach ($this->services as $type) {

            $result = array_search($name, $this->services[$type]);

            if ($result !== false) {

                unset($this->services[$type][$name]);
            }
        }

        return (bool) $result;
    }
}
