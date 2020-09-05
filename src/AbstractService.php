<?php

declare(strict_types = 1);

namespace Hschulz\ServiceLoader;

/**
 *
 */
abstract class AbstractService implements Service
{
    /**
     *
     * @var string
     */
    protected string $type = '';

    /**
     *
     * @var string
     */
    protected string $name = '';

    /**
     *
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     *
     * @param string $type
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
