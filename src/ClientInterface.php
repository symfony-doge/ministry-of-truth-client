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
use SymfonyDoge\MinistryOfTruthClient\Dto\RequestDto;
use SymfonyDoge\MinistryOfTruthClient\Dto\Response\Index\ResponseDto as IndexResponse;
use SymfonyDoge\MinistryOfTruthClient\Dto\Response\Tag\Group\Get\All\ResponseDto as GetTagGroupsResponse;
use SymfonyDoge\MinistryOfTruthClient\Dto\ResponseDto;
use SymfonyDoge\MinistryOfTruthClient\Exception\RequestFailedException;
use SymfonyDoge\MinistryOfTruthClient\Exception\ResponseDeserializationFailedException;

/**
 * Describes API of the Ministry of Truth, a microservice-provider of sanity tags and other provocative stuff
 * Service encapsulates a common request/response operations including (de)serialization, data consistency checks, etc.
 *
 * Base usage principle:
 * ```
 * $request = new SpecificMethodRequest();
 * $request->setSomeData($data);
 *
 * // SpecificMethodResponse $response
 * $response = $client->specificMethod($request);
 *
 * // Checks for a common response data.
 * $status = $response->getStatus();                  // 'OK', 'FAIL'
 *
 * if (Status::NEGATIVE === $status) {
 *     $errors = $response->getErrors();
 *
 *     foreach ($errors as $error) {
 *         $code        = $error->getCode();          // 400
 *         $type        = $error->getType();          // 'service_namespace.component.a_bad_things_just_happened'
 *         $description = $error->getDescription()    // 'Component X can not deal well with a problem Y, please fix it'
 *     }
 * }
 *
 * // Check for a custom, method-specific response data.
 * $customResponseData = $response->getSomeData();
 * ```
 *
 * This interface should be implemented by a custom service, based on world region with its own cultural memes
 *
 * @see RequestDto a base request structure
 * @see ResponseDto a base response structure
 */
interface ClientInterface
{
    /**
     * Performs input data contextual analysis and indexing
     *
     * @param IndexRequest $request A request instance with action-specific input data
     *
     * @return IndexResponse
     *
     * @throws RequestFailedException
     * @throws ResponseDeserializationFailedException
     */
    public function index(IndexRequest $request): IndexResponse;

    /**
     * Returns currently available sanity tag groups
     *
     * @param GetTagGroupsRequest $request A request instance with action-specific input data
     *
     * @return GetTagGroupsResponse
     *
     * @throws RequestFailedException
     * @throws ResponseDeserializationFailedException
     */
    public function getTagGroups(GetTagGroupsRequest $request): GetTagGroupsResponse;
}
