<?php

declare(strict_types=1);

namespace Hschulz\ServiceLoader;

use InvalidArgumentException;

/**
 *
 */
interface ServiceLoader
{
    /**
     *
     * @param Service $service
     * @throws InvalidArgumentException
     * @return string
     */
    public function register(Service $service): string;

    /**
     *
     * @param string $name
     * @return bool
     */
    public function unregister(string $name): bool;

    /**
     *
     * @param string $type
     * @param string $name
     * @return Service|null
     */
    public function getService(string $type, string $name = ''): ?Service;

    /**
     *
     * @param string $type
     * @return array
     */
    public function getServices(string $type): array;
}
