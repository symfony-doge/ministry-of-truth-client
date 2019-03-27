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
use SymfonyDoge\MinistryOfTruthClient\Enum\Request\Validation\Group;
use SymfonyDoge\MinistryOfTruthClient\Exception\InvalidRequestException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Performs input data validation before sending a http request
 * This wrapper is used as a lightweight alternative to AOP libraries and acts like a precompiled AOP proxy
 *
 * @see https://docs.spring.io/spring/docs/2.5.x/reference/aop.html
 */
class ValidatorAwareClient implements ClientInterface
{
    /**
     * Base MoT client implementation (an advised object in AOP context)
     *
     * @var ClientInterface
     */
    private $motClient;

    /**
     * Validates PHP values against constraints
     *
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * Client constructor.
     *
     * @param ClientInterface    $motClient Base MoT client implementation
     * @param ValidatorInterface $validator Validates PHP values against constraints
     */
    public function __construct(ClientInterface $motClient, ValidatorInterface $validator)
    {
        $this->motClient = $motClient;
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     *
     * @throws InvalidRequestException
     */
    public function index(IndexRequest $request): IndexResponse
    {
        return $this->applyValidationAspect(__FUNCTION__, $request);
    }

    /**
     * {@inheritdoc}
     *
     * @throws InvalidRequestException
     */
    public function getTagGroups(GetTagGroupsRequest $request): GetTagGroupsResponse
    {
        return $this->applyValidationAspect(__FUNCTION__, $request);
    }

    /**
     * Applies a validation logic before execution of an actual client method (similar to Advice in AOP)
     *
     * @param string     $methodName Name of the method to be executed (similar to Join point)
     * @param RequestDto $request    Request structure for API endpoint
     *
     * @return mixed
     */
    private function applyValidationAspect(string $methodName, RequestDto $request)
    {
        $validationGroups     = [Group::COMMON];
        $constraintViolations = $this->validator->validate($request, null, $validationGroups);

        if (0 >= count($constraintViolations)) {
            return $this->motClient->$methodName($request);
        }

        /** @var ConstraintViolationInterface $violation */
        foreach ($constraintViolations as $violation) {
            $violationCode    = (int) $violation->getCode();
            $violationMessage = $violation->getMessage();

            throw InvalidRequestException::withViolationCodeAndMessage($violationCode, $violationMessage);
        }
    }
}
