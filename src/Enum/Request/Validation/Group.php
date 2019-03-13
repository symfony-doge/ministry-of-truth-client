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

namespace MinistryOfTruthClient\Enum\Request\Validation;

/**
 * Dictionary of the request validation groups
 *
 * @internal
 */
final class Group
{
    /**
     * Vacancy description (requirements list, offer)
     *
     * @const string
     */
    public const COMMON = 'motc.request.validation.common';
}
