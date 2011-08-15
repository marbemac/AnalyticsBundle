<?php

namespace Marbemac\AnalyticsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('marbemac_analytics');

        $rootNode
            ->children()
                ->booleanNode('use_analytics')->defaultFalse()->end()
                ->arrayNode('analytics')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('Marbemac\AnalyticsBundle\Document\AnalyticsManager')->cannotBeEmpty()->end()
                    ->end()
                ->end()

                ->booleanNode('use_woopra')->defaultFalse()->end()
                ->arrayNode('woopra')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('Marbemac\AnalyticsBundle\Document\WoopraManager')->cannotBeEmpty()->end()
                        ->scalarNode('idle_timeout')->defaultValue('30000')->cannotBeEmpty()->end()
                        ->scalarNode('domain')->defaultValue(null)->cannotBeEmpty()->end()
                    ->end()
                ->end()

            ->end();

        return $treeBuilder;
    }

}