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

namespace MinistryOfTruthClient\Dto\Response\Index;

use MinistryOfTruthClient\Dto\ResponseDto as BaseResponseDto;

/**
 * Response structure for immediate text indexing action
 *
 * Example in raw JSON:
 * ```
 * {
 *     "status": "OK",
 *     "errors": [],
 *     "index": {
 *         "value": 56.18,
 *         "tags": {
 *             "soft": [
 *                 {
 *                     "name": "young_dynamic",
 *                     "title": "Молодая, динамично развивающаяся компания",
 *                     "description": "Заезженная фраза, не несёт никакой смысловой нагрузки в деловой беседе",
 *                     "color": "#FFB6C1",
 *                     "image_url": "http://lorempixel.com/100/100/cats"
 *                 }
 *             ],
 *             "hard": [],
 *             "lulz": [
 *                 {
 *                     "name": "cafeteria",
 *                     "title": "This is a cafeteria with cookies and coffee",
 *                     "description": "A funny practice to put \"cookies\" & \"coffee\" in vacancy text for attention",
 *                     "color": "#FFB6C1",
 *                     "image_url": "http://lorempixel.com/100/100/cats"
 *                 }
 *             ]
 *         }
 *     }
 * }
 * ```
 */
final class ResponseDto extends BaseResponseDto
{
    /**
     * Sanity index content
     * 
     * @var ContentDto
     */
    private $index;

    /**
     * Returns sanity index content
     *
     * @return ContentDto
     */
    public function getIndex(): ContentDto
    {
        return $this->index;
    }

    /**
     * Sets sanity index content
     *
     * @param ContentDto $index Sanity index content
     *
     * @return void
     */
    public function setIndex(ContentDto $index): void
    {
        $this->index = $index;
    }
}
