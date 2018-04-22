<?php

namespace hschulz\ServiceLoader;

/**
 *
 */
interface Service {

    /**
     *
     * @return string
     */
    public function getType(): string;

    /**
     *
     * @param string $type
     * @return void
     */
    public function setType(string $type): void;

    /**
     *
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;
}
