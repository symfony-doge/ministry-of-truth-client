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

namespace SymfonyDoge\MinistryOfTruthClient\Enum\Request;

/**
 * Dictionary of request types
 *
 * @internal
 */
final class Type
{
    /**
     * Index request
     *
     * @const string
     */
    public const INDEX = 'index';

    /**
     * Get tag groups request
     *
     * @const string
     */
    public const GET_TAG_GROUPS = 'get_tag_groups';
}
