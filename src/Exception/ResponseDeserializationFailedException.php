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

namespace SymfonyDoge\MinistryOfTruthClient\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Will be thrown if a response from API endpoint is not properly deserialized to integration layer DTOs
 */
class ResponseDeserializationFailedException extends RuntimeException implements MinistryOfTruthClientExceptionInterface
{
    /**
     * Default error message
     *
     * @const string
     */
    public const MESSAGE = 'Response from API endpoint is not deserialized.';

    /**
     * Error message with deserialization problem description
     *
     * @const string
     */
    public const MESSAGE_WITH_DESCRIPTION = 'Response from API endpoint is not deserialized: {description}';

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
     * Returns an exception with deserialization problem description
     *
     * @param string $description Deserialization problem description
     *
     * @return ResponseDeserializationFailedException
     */
    public static function withDescription(string $description): ResponseDeserializationFailedException
    {
        $message = str_replace('{description}', $description, self::MESSAGE_WITH_DESCRIPTION);

        return new static($message);
    }
}
