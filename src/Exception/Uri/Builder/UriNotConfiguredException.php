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

namespace MinistryOfTruthClient\Exception\Uri\Builder;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Will be thrown if URI is not configured for request
 */
class UriNotConfiguredException extends RuntimeException implements MinistryOfTruthClientExceptionInterface
{
    /**
     * Default error message
     *
     * @const string
     */
    public const MESSAGE = 'URI is not configured for request.';

    /**
     * Error message with request type
     *
     * @const string
     */
    public const MESSAGE_WITH_REQUEST_TYPE = "URI is not configured for request '{requestType}'.";

    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $message = self::MESSAGE,
        int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Returns an exception with specified request type
     *
     * @param string $requestType Request type
     *
     * @return UriNotConfiguredException
     */
    public static function withRequestType(string $requestType): UriNotConfiguredException
    {
        $message = str_replace('{requestType}', $requestType, self::MESSAGE_WITH_REQUEST_TYPE);

        return new static($message);
    }
}
