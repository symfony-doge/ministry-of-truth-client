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

namespace MinistryOfTruthClient\Dto\Response;

use MinistryOfTruthClient\Enum\Response\Error\Code;

/**
 * Error data structure in response from API endpoint
 */
class ErrorDto
{
    /**
     * A number of logic group to which error belongs to (ex. 400 for client side errors, 500 for internal, etc.)
     *
     * @var int
     *
     * @see Code
     */
    private $code;

    /**
     * An error type raised by API implementation, can be used for debugging
     *
     * @var string
     *
     * @internal An error type may depend on specific API implementation, you should not make any strict assumptions
     *           about its contents, take into account a {$code} field instead
     */
    private $type;

    /**
     * A human-friendly description of problem which prevent API implementation from request processing,
     * typically it falls in log and can be a flare to start debugging an integration relay
     *
     * @var string|null
     */
    private $description;

    /**
     * ErrorDto constructor.
     */
    public function __construct()
    {
        // explicitly marked as optional for documentation purposes.
        $this->description = null;
    }

    /**
     * Returns a number of logic group to which error belongs to
     *
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * Sets a number of logic group to which error belongs to
     *
     * @param int $code A number of logic group
     *
     * @return void
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * Returns an error type raised by API implementation
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets an error type raised by API implementation
     *
     * @param string $type An error type
     *
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Returns a human-friendly description of problem which prevent API implementation from request processing
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets a human-friendly description of problem which prevent API implementation from request processing
     *
     * @param string $description A human-friendly error message
     *
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
