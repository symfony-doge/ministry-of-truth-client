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

namespace SymfonyDoge\MinistryOfTruthClient\Uri;

use Closure;
use SymfonyDoge\MinistryOfTruthClient\Enum\Request\Type as RequestType;
use SymfonyDoge\MinistryOfTruthClient\Enum\Uri\Type as UriType;
use SymfonyDoge\MinistryOfTruthClient\Exception\Uri\Builder\UriNotConfiguredException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Provides URI for http requests
 *
 * @internal
 */
class Builder
{
    /**
     * Builder options
     *
     * @var array
     */
    private $options;

    /**
     * Builder constructor.
     *
     * Options example:
     * ```
     * [
     *     'base_uri' => 'https://api.domain.ltd',
     *     // indexed by request type
     *     'requests' => [
     *         'index' => [
     *             'path' => '/index'
     *         ],
     *         'get_tag_groups' => [
     *             'type' => \SymfonyDoge\MinistryOfTruthClient\Enum\Uri\Type::ABSOLUTE,
     *             'path' => 'https://api.second-domain.ltd/2.0/tag/groups'
     *         ]
     *     ]
     * ]
     * ```
     *
     * Final index action URL for this configuration will be 'https://api.domain.ltd/index'
     * and 'https://api.second-domain.ltd/2.0/tag/groups' for fetching a tag groups list
     *
     * Note: all URI strings should be present without a trailing slash at the end.
     *
     * @param array $options URI configuration options
     *
     * @see RequestType
     * @see UriType
     */
    public function __construct(array $options)
    {
        $optionsResolver = new OptionsResolver();
        $this->configureOptions($optionsResolver);

        $this->options = $optionsResolver->resolve($options);
    }

    /**
     * Returns URI, based on configured options
     *
     * @param string $requestType Request type
     *
     * @return string
     *
     * @throws UriNotConfiguredException
     *
     * @see RequestType
     */
    public function getUri(string $requestType): string
    {
        $requestsAvailable = $this->options['requests'];

        if (!array_key_exists($requestType, $requestsAvailable)) {
            throw UriNotConfiguredException::withRequestType($requestType);
        }

        $uriOptions = $requestsAvailable[$requestType];

        // Method is safe without this check if an options resolver 4.2 or greater is used (see configureOptions).
        if (empty($uriOptions['path'])) {
            throw UriNotConfiguredException::withRequestTypeAndParameterName($requestType, 'path');
        }

        if (UriType::ABSOLUTE === $uriOptions['type']) {
            return $uriOptions['path'];
        }

        return $this->options['base_uri'] . $uriOptions['path'];
    }

    /**
     * Performs configuration of default client options
     *
     * @param OptionsResolver $optionsResolver Validates options and merges them with default values
     *
     * @return void
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('base_uri', null);

        $requestTypes = [RequestType::INDEX, RequestType::GET_TAG_GROUPS];

        // Options resolver ~4.2 provide a convenient way to configure nested options.
        if (method_exists(OptionsResolver::class, 'isNested')) {
            $optionsResolver->setDefault(
                'requests',
                function (OptionsResolver $requestsOptionsResolver) use ($requestTypes) {
                    foreach ($requestTypes as $requestType) {
                        $requestsOptionsResolver->setDefault(
                            $requestType,
                            Closure::fromCallable([$this, 'configureUriOptions'])
                        );
                    }
                }
            );
        // For compatibility with implementations prior to ~4.2 version (see also path check in getUri).
        } else {
            $requestsOptions = [];

            foreach ($requestTypes as $requestType) {
                $requestsOptions[$requestType] = ['type' => UriType::RELATIVE, 'path' => null];
            }

            $optionsResolver->setDefault('requests', $requestsOptions);
        }

        $optionsResolver->setRequired('base_uri');
    }

    /**
     * Performs configuration of request node in the options tree
     *
     * @param OptionsResolver $uriResolver Validates options for request node and merges them with default values
     *
     * @return void
     */
    private function configureUriOptions(OptionsResolver $uriResolver): void
    {
        $uriResolver->setDefaults(['type' => UriType::RELATIVE, 'path' => null]);

        $uriResolver->setAllowedValues('type', [UriType::RELATIVE, UriType::ABSOLUTE]);
        $uriResolver->setRequired('path');
    }
}
