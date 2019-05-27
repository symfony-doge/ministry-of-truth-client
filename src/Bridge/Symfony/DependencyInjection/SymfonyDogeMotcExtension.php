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
 * MinistryOfTruthClient bundle dependency injection extension.
 */
class SymfonyDogeMotcExtension extends Extension
{
    /**
     * Alias for service that performs request transfer by http
     *
     * @const string
     */
    private const SERVICE_ALIAS_TRANSPORT_HTTP = 'symfony_doge.motc.transport.http';

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $locator = new FileLocator(__DIR__ . implode(DIRECTORY_SEPARATOR, ['', '..', 'Resources']));
        $loader  = new YamlFileLoader($container, $locator);

        $configFiles = [
            'uri_builders.yml',
            'transports.yml',
            'validators.yml',
            'serializers.yml',
            'denormalizers.yml',
            'credentials.yml',
            'clients.yml',
        ];

        foreach ($configFiles as $configFile) {
            $loader->load('config' . DIRECTORY_SEPARATOR . $configFile);
        }

        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $container->setAlias(self::SERVICE_ALIAS_TRANSPORT_HTTP, $config['transport']['http']['service_id']);

        $uriBuilderOptions = [
            'base_uri' => $config['api']['base_uri'],
            'requests' => $config['api']['requests'],
        ];
        $container->setParameter('symfony_doge.motc.uri.builder.options', $uriBuilderOptions);

        $container->setParameter(
            'symfony_doge.motc.credentials.authorization_token',
            $config['credentials']['authorization_token']
        );
    }
}
