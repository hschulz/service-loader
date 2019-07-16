<?php

namespace hschulz\ServiceLoader;

use function \array_key_exists;
use \InvalidArgumentException;
use function \md5;
use function \reset;

/**
 *
 */
abstract class AbstractServiceLoader implements ServiceLoader
{

    /**
     * The services; grouped by type.
     * @var array
     */
    private $services = [];

    /**
     * Will create an empty service loader.
     */
    public function __construct()
    {
        $this->services = [];
    }

    /**
     * Returns the first service found for a given type.
     *
     * @param string $type The service type
     * @param string $name The specific name for the requested service
     * @return Service|null The service found for the given values or null
     */
    public function getService(string $type, string $name = ''): ?Service
    {
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
     * Returns all registered services for a given type.
     *
     * @param string $type The requested service type
     * @return array The services
     */
    public function getServices(string $type): array
    {
        return $this->services[$type] ?? [];
    }

    /**
     * Registers a service.
     * Throws an InvalidArgumentException when the service has no name or
     * if there was already a service registered with the same name.
     *
     * @param Service $service The service
     * @throws InvalidArgumentException
     * @return string The name the service was registered with
     */
    public function register(Service $service): string
    {
        $type = $service->getType();
        $name = $service->getName();

        if ($type === '') {
            throw new InvalidArgumentException();
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
            throw new InvalidArgumentException();
        }

        $this->services[$type][$name] = $service;

        return $name;
    }

    /**
     * Deletes the service with the given name.
     *
     * @param string $name The service name
     * @return bool True when the service has been deleted.
     */
    public function unregister(string $name): bool
    {
        foreach ($this->services as $type => $services) {
            if (array_key_exists($name, $services)) {
                unset($this->services[$type][$name]);
                return true;
            }
        }

        return false;
    }
}
