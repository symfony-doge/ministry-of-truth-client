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

namespace SymfonyDoge\MinistryOfTruthClient\Dto\Response\Index;

/**
 * Sanity index content structure
 */
class ContentDto
{
    /**
     * Sanity index value, from 0.00 to 100.00
     *
     * @var float
     */
    private $value;

    /**
     * 2D array of sanity tags, indexed by group name
     *
     * Data structure:
     * ```
     * [
     *     'group1' => [$tag1, $tag2],
     *     'group2' => [$tag3],
     *     'group3' => []
     * ]
     * ```
     *
     * @var array
     */
    private $tags;

    /**
     * ContentDto constructor.
     */
    public function __construct()
    {
        $this->tags = [];
    }

    /**
     * Returns sanity index value
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Sets sanity index value
     *
     * @param float $value Sanity index value
     *
     * @return void
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    /**
     * Returns 2D array of sanity tags, indexed by group name
     *
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * Adds a sanity tag in index content
     *
     * @param string $groupName Name of sanity tags group
     * @param TagDto $tag       Sanity tag
     *
     * @return void
     */
    public function addTag(string $groupName, TagDto $tag): void
    {
        $this->tags[$groupName][] = $tag;
    }
}
