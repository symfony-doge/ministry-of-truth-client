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
 * Will be thrown if request to API endpoint is built incorrectly
 */
class InvalidRequestException extends RuntimeException implements MinistryOfTruthClientExceptionInterface
{
    /**
     * Default error message
     *
     * @const string
     */
    public const MESSAGE = 'Request to API endpoint is not valid.';

    /**
     * Error message with violation description
     *
     * @const string
     */
    public const MESSAGE_WITH_VIOLATION = 'Request to API endpoint is not valid: {violationMessage}';

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
     * Returns an exception with specified violation code and message
     *
     * @param int    $violationCode    Violation code
     * @param string $violationMessage Violation message
     *
     * @return InvalidRequestException
     */
    public static function withViolationCodeAndMessage(
        int $violationCode,
        string $violationMessage
    ): InvalidRequestException {
        $message = str_replace('{violationMessage}', $violationMessage, self::MESSAGE_WITH_VIOLATION);

        return new static($message, $violationCode);
    }
}
