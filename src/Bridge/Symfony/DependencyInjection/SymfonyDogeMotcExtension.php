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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * MinistryOfTruthClient dependency injection extension.
 */
class SymfonyDogeMotcExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $locator = new FileLocator(__DIR__ . implode(DIRECTORY_SEPARATOR, ['', '..', 'Resources']));
        $loader  = new YamlFileLoader($container, $locator);

        $loader->load('config' . DIRECTORY_SEPARATOR . 'uri_builders.yml');
        $loader->load('config' . DIRECTORY_SEPARATOR . 'clients.yml');

        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $uriBuilderOptions = [
            'base_uri' => $config['client']['base_uri'],
            'requests' => $config['client']['requests'],
        ];

        $container->setParameter('symfony_doge.ministry_of_truth_client.uri.builder.options', $uriBuilderOptions);
    }
}
