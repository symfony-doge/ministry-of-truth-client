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

namespace SymfonyDoge\MinistryOfTruthClient\Dto;

use SymfonyDoge\MinistryOfTruthClient\Dto\Response\ErrorDto;
use SymfonyDoge\MinistryOfTruthClient\Enum\Response\Status;

/**
 * Base response structure from API endpoint
 */
class ResponseDto
{
    /**
     * Request processing status
     *
     * @var string
     *
     * @see Status
     */
    private $status;

    /**
     * List of errors which was raised during request processing
     *
     * @var ErrorDto[]
     */
    private $errors;

    /**
     * ResponseDto constructor.
     */
    public function __construct()
    {
        $this->errors = [];
    }

    /**
     * Returns request processing status
     *
     * @return string
     */
    final public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Sets a request processing status
     *
     * @param string $status Request processing status
     *
     * @return void
     */
    final public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * Returns a list of errors which was raised during request processing
     *
     * @return ErrorDto[]
     */
    final public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Adds an error data structure for response
     *
     * @param ErrorDto $error An error data structure
     *
     * @return void
     */
    final public function addError(ErrorDto $error): void
    {
        $this->errors[] = $error;
    }
}
