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

namespace MinistryOfTruthClient\Dto;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Base request structure to API endpoint
 */
class RequestDto
{
    /**
     * The authorization token for access control
     *
     * @var string
     *
     * @Assert\NotBlank(groups={"motc.request.validation.common"})
     */
    private $authorizationToken;

    /**
     * Translation choice for text fields in the response
     *
     * @var string
     *
     * @Assert\Locale(groups={"motc.request.validation.common"})
     */
    private $locale;

    /**
     * Returns the authorization token for access control
     *
     * @return string|null
     */
    final public function getAuthorizationToken(): ?string
    {
        return $this->authorizationToken;
    }

    /**
     * Sets an authorization token for access control
     *
     * @param string $authorizationToken Authorization token for access control
     *
     * @return void
     */
    final public function setAuthorizationToken(string $authorizationToken): void
    {
        $this->authorizationToken = $authorizationToken;
    }

    /**
     * Returns a translation choice for text fields in response
     *
     * @return string|null
     */
    final public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * Sets a translation choice for text fields in response
     *
     * @param string $locale Translation choice for text fields in response
     *
     * @return void
     */
    final public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }
}
