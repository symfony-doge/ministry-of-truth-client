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

namespace SymfonyDoge\MinistryOfTruthClient\Bridge\Symfony\Credentials;

/**
 * Holds context of security parameters for building requests to the Ministry of Truth API endpoint
 */
interface StorageInterface
{
    /**
     * Returns an authorization token for request
     *
     * @return string
     */
    public function getAuthorizationToken(): string;
}
