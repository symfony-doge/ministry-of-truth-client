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
use MinistryOfTruthClient\Dto\RequestDto;
use MinistryOfTruthClient\Dto\Response\Index\ResponseDto as IndexResponse;
use MinistryOfTruthClient\Dto\Response\Tag\Group\Get\All\ResponseDto as GetTagGroupsResponse;
use MinistryOfTruthClient\Enum\Request\Type as RequestType;
use MinistryOfTruthClient\Uri\Builder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

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
     * Provides URI for http requests
     *
     * @var Builder
     */
    private $uriBuilder;

    /**
     * Converts a request object into a set of arrays/scalars for transfer via http client
     *
     * @var NormalizerInterface
     */
    private $requestNormalizer;

    /**
     * Converts a raw response data from API endpoint into the response object
     *
     * @var SerializerInterface
     */
    private $responseDeserializer;

    /**
     * Client constructor.
     *
     * For URI configuration options {@see \MinistryOfTruthClient\Uri\Builder}
     *
     * @param HttpClientInterface $httpClient           Sends http requests
     * @param Builder             $uriBuilder           Provides URI for http requests
     * @param NormalizerInterface $requestNormalizer    Converts the request object into a set of arrays/scalars
     * @param SerializerInterface $responseDeserializer Converts a raw response data into the response object
     */
    public function __construct(
        HttpClientInterface $httpClient,
        Builder $uriBuilder,
        NormalizerInterface $requestNormalizer,
        SerializerInterface $responseDeserializer
    ) {
        $this->httpClient           = $httpClient;
        $this->uriBuilder           = $uriBuilder;
        $this->requestNormalizer    = $requestNormalizer;
        $this->responseDeserializer = $responseDeserializer;
    }

    /**
     * {@inheritdoc}
     */
    public function index(IndexRequest $request): IndexResponse
    {
        return $this->request(RequestType::INDEX, $request, IndexResponse::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getTagGroups(GetTagGroupsRequest $request): GetTagGroupsResponse
    {
        return $this->request(RequestType::GET_TAG_GROUPS, $request, GetTagGroupsResponse::class);
    }

    /**
     * Sends http request and returns deserialized response
     *
     * @param string     $requestType   Request type
     * @param RequestDto $request       Request to API endpoint
     * @param string     $responseClass Class for response object
     *
     * @return mixed
     */
    protected function request(string $requestType, RequestDto $request, string $responseClass)
    {
        $uri = $this->uriBuilder->getUri($requestType);

        // TODO: try-catch, logging
        $query    = $this->requestNormalizer->normalize($request);
        $response = $this->httpClient->request(Request::METHOD_GET, $uri, ['query' => $query]);

        $responseBody = (string) $response->getBody();

        return $this->responseDeserializer->deserialize($responseBody, $responseClass, 'json');
    }
}
