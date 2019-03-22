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

namespace SymfonyDoge\MinistryOfTruthClient\Bridge\Symfony\Credentials\Storage;

use SymfonyDoge\MinistryOfTruthClient\Bridge\Symfony\Credentials\StorageInterface;

/**
 * Provides authorization token for requests to the Ministry of Truth API endpoint
 */
class AuthorizationTokenStorage implements StorageInterface
{
    /**
     * The authorization token
     *
     * @var string
     */
    private $authorizationToken;

    /**
     * AuthorizationTokenStorage constructor.
     *
     * @param string $authorizationToken Authorization token for request
     */
    public function __construct(string $authorizationToken)
    {
        $this->authorizationToken = $authorizationToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthorizationToken(): string
    {
        return $this->authorizationToken;
    }
}
