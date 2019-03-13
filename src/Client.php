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

namespace MinistryOfTruthClient;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use MinistryOfTruthClient\Dto\Request\Index\RequestDto as IndexRequest;
use MinistryOfTruthClient\Dto\Request\Tag\Group\Get\All\RequestDto as GetTagGroupsRequest;
use MinistryOfTruthClient\Dto\Response\Index\ResponseDto as IndexResponse;
use MinistryOfTruthClient\Dto\Response\Tag\Group\Get\All\ResponseDto as GetTagGroupsResponse;

/**
 * Base client for communication with API endpoint of the ministry of truth microservice
 */
class Client implements ClientInterface
{
    /**
     * Sends http requests
     *
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * Client constructor.
     *
     * @param HttpClientInterface $httpClient Sends http requests
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function index(IndexRequest $request): IndexResponse
    {
        // TODO
    }

    /**
     * {@inheritdoc}
     */
    public function getTagGroups(GetTagGroupsRequest $request): GetTagGroupsResponse
    {
        // TODO
    }
}
