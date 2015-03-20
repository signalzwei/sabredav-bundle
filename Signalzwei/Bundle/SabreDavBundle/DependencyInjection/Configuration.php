<?php

namespace Signalzwei\Bundle\SabreDavBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sabre_dav');

        $rootNode
            ->children()
                ->arrayNode('pdo')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('host')->defaultValue('%database_host%')->end()
                        ->scalarNode('port')->defaultValue('3306')->end()
                        ->scalarNode('database')->defaultValue('%database_name%')->end()
                        ->scalarNode('user')->defaultValue('%database_user%')->end()
                        ->scalarNode('password')->defaultValue('%database_password%')->end()
                    ->end()
                ->end()
                ->arrayNode('backends')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('auth')->defaultValue('sabredav.backend.auth.token')->end()
                        ->scalarNode('principal')->defaultValue('sabredav.backend.principal.pdo')->end()
                        ->scalarNode('caldav')->defaultValue('sabredav.backend.caldav.pdo')->end()
                    ->end()
                ->end()
                ->arrayNode('plugins')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('acl')->defaultFalse()->end()
                        ->booleanNode('auth')->defaultFalse()->end()
                        ->booleanNode('browser')->defaultFalse()->end()
                        ->booleanNode('caldav')->defaultFalse()->end()
                    ->end()
                ->end()
                ->arrayNode('mounts')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('principal')->defaultFalse()->end()
                        ->booleanNode('calendar')->defaultFalse()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}