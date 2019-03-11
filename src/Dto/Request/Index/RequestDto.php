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

namespace MinistryOfTruthClient\Dto\Request\Index;

use MinistryOfTruthClient\Dto\RequestDto as BaseRequestDto;
use MinistryOfTruthClient\Enum\Request\Index\Context;

/**
 * Request structure for immediate text indexing action
 */
final class RequestDto extends BaseRequestDto
{
    /**
     * Data for analysis, indexed by context name
     *
     * Example:
     * ```
     * [
     *     Context\Vacancy::DESCRIPTION => 'We Are Hiring!',
     *     Context\Vacancy::POSITION    => 'Experienced Ruby Engineer'
     * ]
     * ```
     *
     * @var array
     */
    private $context;

    /**
     * RequestDto constructor.
     */
    public function __construct()
    {
        $this->context = [];
    }

    /**
     * Returns data for analysis indexed by context name
     *
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * Adds data for analysis with specified context mark
     *
     * @param string $contextName Context name
     * @param string $data        Data for analysis
     *
     * @return void
     *
     * @see Context\Vacancy
     */
    public function addContext(string $contextName, string $data): void
    {
        $this->context[$contextName] = $data;
    }
}
