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
 * Sanity tag structure
 */
class TagDto
{
    /**
     * Unique tag name
     *
     * @var string
     */
    private $name;

    /**
     * Tag title
     *
     * @var string
     */
    private $title;

    /**
     * Tag description
     *
     * @var string
     */
    private $description;

    /**
     * Tag color, ex. '#FF0000'
     *
     * @var string
     */
    private $color;

    /**
     * Returns unique tag name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets unique tag name
     *
     * @param string $name Tag name
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Returns tag title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets tag title
     *
     * @param string $title Tag title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Returns tag description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets tag description
     *
     * @param string $description Tag description
     *
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Returns tag color
     *
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Sets tag color
     *
     * @param string $color Tag color
     *
     * @return void
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }
}
