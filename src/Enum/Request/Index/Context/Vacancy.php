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

namespace MinistryOfTruthClient\Enum\Request\Index\Context;

/**
 * Dictionary of supported vacancy data parts for analysis
 */
final class Vacancy
{
    /**
     * Vacancy description (requirements list, offer)
     *
     * @const string
     */
    public const DESCRIPTION = 'description';
}
