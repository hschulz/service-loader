<?php

declare(strict_types=1);

namespace Hschulz\ServiceLoader;

/**
 * This interface describes a service that can be managed by the ServiceLoader
 * interface.
 */
interface Service
{
    /**
     * Returns the service type.
     *
     * @return string The service type
     */
    public function getType(): string;

    /**
     * Sets the type of the service. Implementing services should use the
     * ServiceType interface or define their own service type names.
     *
     * @param string $type The service type
     * @return void
     */
    public function setType(string $type): void;

    /**
     * Returns the service name.
     *
     * @return string The service name
     */
    public function getName(): string;

    /**
     * Sets the name for the service. Used to identify a specific service
     * for a type.
     *
     * @param string $name The service name
     * @return void
     */
    public function setName(string $name): void;
}
