<?php

declare(strict_types=1);

namespace Hschulz\ServiceLoader;

/**
 *
 */
interface ServiceType
{
    /**
     *
     * @var string
     */
    public const CONFIG = 'config';

    /**
     *
     * @var string
     */
    public const DATABASE = 'database';

    /**
     *
     * @var string
     */
    public const LOGGER = 'logger';

    /**
     *
     * @var string
     */
    public const MAIL = 'mail';
}
