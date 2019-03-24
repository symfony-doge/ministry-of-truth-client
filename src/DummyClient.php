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

namespace SymfonyDoge\MinistryOfTruthClient;

use SymfonyDoge\MinistryOfTruthClient\Dto\Request\Index\RequestDto as IndexRequest;
use SymfonyDoge\MinistryOfTruthClient\Dto\Request\Tag\Group\Get\All\RequestDto as GetTagGroupsRequest;
use SymfonyDoge\MinistryOfTruthClient\Dto\Response\Index\ContentDto as IndexContent;
use SymfonyDoge\MinistryOfTruthClient\Dto\Response\Index\ResponseDto as IndexResponse;
use SymfonyDoge\MinistryOfTruthClient\Dto\Response\Index\TagDto;
use SymfonyDoge\MinistryOfTruthClient\Dto\Response\Tag\Group\ContentDto as GroupDto;
use SymfonyDoge\MinistryOfTruthClient\Dto\Response\Tag\Group\Get\All\ResponseDto as GetTagGroupsResponse;
use SymfonyDoge\MinistryOfTruthClient\Enum\Response\Status;

/**
 * Dummy client returns responses with fake data and could be used as a stub for integration testing
 */
class DummyClient implements ClientInterface
{
    /**
     * {@inheritdoc}
     */
    public function index(IndexRequest $request): IndexResponse
    {
        $response = new IndexResponse();
        $response->setStatus(Status::POSITIVE);

        $index = new IndexContent();
        $index->setValue(56.18);

        $tagVomiter = function () {
            foreach (['one', 'two', 'three', 'four', 'five'] as $tagName) {
                $tag = new TagDto();
                $tag->setName('tag_' . $tagName);
                $tag->setTitle("Tag $tagName title");
                $tag->setDescription("Tag $tagName description");
                $tag->setColor('#AC529A');
                $tag->setImageUrl('http://lorempixel.com/100/100/cats');

                yield $tag;
            }
        };

        $groupNameVomiter = function () {
            return ['soft', 'hard', 'lulz'][mt_rand(0, 2)];
        };

        foreach ($tagVomiter() as $tag) {
            $index->addTag($groupNameVomiter(), $tag);
        }

        $response->setIndex($index);

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getTagGroups(GetTagGroupsRequest $request): GetTagGroupsResponse
    {
        $response = new GetTagGroupsResponse();
        $response->setStatus(Status::POSITIVE);

        $groupVomiter = function () {
            foreach (['soft', 'hard', 'lulz'] as $groupName) {
                $group = new GroupDto();
                $group->setName($groupName);
                $group->setDescription("$groupName tags group description");
                $group->setColor('#AC529A');

                yield $group;
            }
        };

        foreach ($groupVomiter() as $group) {
            $response->addTagGroup($group);
        }

        return $response;
    }
}
