<?php

/*
 * This file is part of the Ministry of Truth client <https://github.com/symfony-doge/ministry-of-truth-client>.
 *
 * (C) 2019 Pavel Petrov <itnelo@gmail.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license https://opensource.org/licenses/mit MIT
 */

declare(strict_types=1);

namespace MinistryOfTruthClient\Enum\Response;

/**
 * Dictionary of response statuses from API endpoint
 */
final class Status
{
    /**
     * Whenever a request has been successfully proceed
     *
     * @const string
     */
    public const POSITIVE = 'OK';

    /**
     * If an error has been occurred during request processing
     *
     * @const string
     */
    public const NEGATIVE = 'FAIL';
}
