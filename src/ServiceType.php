<?php

namespace hschulz\ServiceLoader;

/**
 *
 */
interface ServiceType
{
    /**
     *
     * @var string
     */
    const CONFIG = 'config';

    /**
     *
     * @var string
     */
    const DATABASE = 'database';

    /**
     *
     * @var string
     */
    const LOGGER = 'logger';

    /**
     *
     * @var string
     */
    const MAIL = 'mail';
}
