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

namespace SymfonyDoge\MinistryOfTruthClient\Enum\Response\Error;

use Symfony\Component\HttpFoundation\Response;

/**
 * Dictionary of error codes in response from API endpoint
 */
final class Code
{
    /**
     * For client side errors
     *
     * @const string
     */
    public const CLIENT = Response::HTTP_BAD_REQUEST;

    /**
     * For internal, server errors
     *
     * @const string
     */
    public const SERVER = Response::HTTP_INTERNAL_SERVER_ERROR;
}
