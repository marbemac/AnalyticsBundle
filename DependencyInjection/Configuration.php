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
                ->scalarNode('analytics_manager')->defaultValue('Marbemac\AnalyticsBundle\Document\AnalyticsManager')->cannotBeEmpty()->end()
                ->booleanNode('use_woopra')->defaultFalse()->end()
                ->scalarNode('woopra_idle_timeout')->defaultValue('30000')->cannotBeEmpty()->end()
                ->scalarNode('woopra_domain')->end()
            ->end();

        return $treeBuilder;
    }

}