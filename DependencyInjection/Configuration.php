<?php

namespace Signalzwei\SabreDavBundle\DependencyInjection;

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
                ->arrayNode('mount')
                    ->prototype('scalar')->end()
                ->end()
            ->end();
        return $treeBuilder;
    }
}