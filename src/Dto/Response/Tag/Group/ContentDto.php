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

namespace MinistryOfTruthClient\Dto\Response\Tag\Group;

/**
 * Sanity group of tags content structure
 */
class ContentDto
{
    // no traits for context readability & clear comments.

    /**
     * Unique group name
     *
     * @var string
     */
    private $name;

    /**
     * Group description
     *
     * @var string
     */
    private $description;

    /**
     * Group color, ex. '#FF0000'
     *
     * @var string
     */
    private $color;

    /**
     * Returns unique group name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets unique group name
     *
     * @param string $name Group name
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Returns group description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets group description
     *
     * @param string $description Group description
     *
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Returns group color
     *
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Sets group color
     *
     * @param string $color Group color
     *
     * @return void
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }
}
