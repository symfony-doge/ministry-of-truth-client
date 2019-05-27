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

namespace SymfonyDoge\MinistryOfTruthClient\Dto\Response\Tag\Group\Get\All;

use SymfonyDoge\MinistryOfTruthClient\Dto\Response\Tag\Group\ContentDto;
use SymfonyDoge\MinistryOfTruthClient\Dto\ResponseDto as BaseResponseDto;
// TODO: [upgrade] 4.2: use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Response structure for get all groups action
 *
 * Example in raw JSON:
 * ```
 * {
 *     "status": "OK",
 *     "errors": [],
 *     "tag_groups": [
 *         {
 *             "name": "soft",
 *             "description": "A senseless verbiage, poor language or just a spam",
 *             "color": "#61C3FF"
 *         }
 *     ]
 * }
 * ```
 */
final class ResponseDto extends BaseResponseDto
{
    /**
     * List of sanity groups
     *
     * @var ContentDto[]
     *
     * TODO: [upgrade] 4.2: @SerializedName("tag_groups")
     */
    private $tag_groups;
    // TODO: [upgrade] 4.2: private $tagGroups;

    /**
     * ResponseDto constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->tag_groups = [];
    }

    /**
     * Returns list of sanity groups
     *
     * @return ContentDto[]
     */
    public function getTagGroups(): array
    {
        return $this->tag_groups;
    }

    /**
     * Adds a sanity group to response content
     *
     * @param ContentDto $tagGroup Sanity group of tags
     *
     * @return void
     */
    public function addTagGroup(ContentDto $tagGroup): void
    {
        $this->tag_groups[] = $tagGroup;
    }

    /**
     * Removes a sanity group from response content
     *
     * @param ContentDto $tagGroup Sanity group of tags
     *
     * @return void
     */
    public function removeTagGroup(ContentDto $tagGroup): void
    {
        $tagGroupNameToRemove = $tagGroup->getName();

        $this->tag_groups = array_filter(
            $this->tag_groups,
            function (ContentDto $_tagGroup) use ($tagGroupNameToRemove) {
                return $_tagGroup->getName() !== $tagGroupNameToRemove;
            }
        );
    }
}
