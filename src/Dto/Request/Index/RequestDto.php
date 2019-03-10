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

/**
 * Request structure for immediate text indexing action
 */
final class RequestDto extends BaseRequestDto
{
    /**
     * Text to be indexed
     *
     * @var string
     */
    private $text;

    /* TODO: context hints for fields, based on Enum\Request\Index\? */

    /**
     * Returns text to be indexed
     *
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Sets text to be indexed
     *
     * @param string $text Text to be indexed
     *
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
