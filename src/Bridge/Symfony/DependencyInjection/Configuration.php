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

namespace SymfonyDoge\MinistryOfTruthClient\Bridge\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use SymfonyDoge\MinistryOfTruthClient\Enum\Request\Type as RequestType;
use SymfonyDoge\MinistryOfTruthClient\Enum\Uri\Type as UriType;

/**
 * SymfonyDogeMotcBundle configuration.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Service id for default http transport implementation
     *
     * @const string
     */
    private const SERVICE_TRANSPORT_HTTP_DEFAULT = 'symfony_doge.motc.transport.http.default';

    /**
     * Available request types for api node
     *
     * @const string[]
     */
    private const REQUEST_TYPES = [RequestType::INDEX, RequestType::GET_TAG_GROUPS];

    /**
     * Available URI types for requests node
     *
     * @const string[]
     */
    private const URI_TYPES = [UriType::RELATIVE, UriType::ABSOLUTE];

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('symfony_doge_motc');

        $rootNode
            ->children()
                ->arrayNode('transport')
                    ->children()
                        ->arrayNode('http')
                            ->children()
                                ->scalarNode('service_id')
                                    ->info('Service for sending http requests')
                                    ->defaultValue(self::SERVICE_TRANSPORT_HTTP_DEFAULT)
                                ->end()
                            ->end()
                            ->beforeNormalization()
                                ->ifString()
                                ->then(function ($v) {
                                    return ['service_id' => $v];
                                })
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('api')
                    ->isRequired()
                    ->children()
                        ->scalarNode('base_uri')
                            ->info('API endpoint (without a trailing slash), e.g. \'https://api.domain.ltd\'')
                            ->example('https://api.domain.ltd')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->validate()
                                ->ifTrue(function ($v) {
                                    return !is_string($v) || empty($v) || '/' === $v[-1];
                                })
                                ->thenInvalid('base_uri must be valid string without a trailing slash at the end %s')
                            ->end()
                        ->end()
                        ->append($this->getApiRequestsNode())
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

    /**
     * Returns an api requests node definition
     *
     * @return ArrayNodeDefinition
     */
    public function getApiRequestsNode(): ArrayNodeDefinition
    {
        $treeBuilder = new TreeBuilder();
        $node        = $treeBuilder->root('requests');

        $node
            ->info('Describes actions allowed by a client')
            ->example(self::REQUEST_TYPES)
            ->isRequired()
            ->requiresAtLeastOneElement()
            ->useAttributeAsKey('requestType')
            ->arrayPrototype()
                ->children()
                    ->scalarNode('type')
                        ->info('Determines how a final URL will be built, using base_uri or an overwritten custom path')
                        ->example(UriType::ABSOLUTE)
                        ->defaultValue(UriType::RELATIVE)
                        ->validate()
                            ->ifNotInArray(self::URI_TYPES)
                            ->thenInvalid('%s is invalid URI type for request')
                        ->end()
                    ->end()
                    ->scalarNode('path')
                        ->info('Action URI part for base_uri or a custom absolute path; e.g. \'/index\'')
                        ->example('/index')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                ->end()
                ->validate()
                    ->ifTrue(function ($v) {
                        return UriType::RELATIVE === $v['type'] && '/' !== $v['path'][0];
                    })
                    ->thenInvalid('A relative URI path must start with a trailing slash %s')
                ->end()
                ->validate()
                    ->ifTrue(function ($v) {
                        return UriType::ABSOLUTE === $v['type'] && '/' === $v['path'][0];
                    })
                    ->thenInvalid('An absolute URI path must not start with a trailing slash %s')
                ->end()
            ->end()
            ->validate()
                ->ifTrue(function ($v) {
                    $requestTypes        = array_keys($v);
                    $requestTypesAllowed = self::REQUEST_TYPES;
                    $requestTypesMatched = array_intersect($requestTypes, $requestTypesAllowed);

                    return count($requestTypes) !== count($requestTypesMatched);
                })
                ->thenInvalid('Invalid request type as a key. See ' . RequestType::class)
            ->end()
        ;

        return $node;
    }
}
