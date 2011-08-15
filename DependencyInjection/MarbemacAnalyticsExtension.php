<?php

namespace Marbemac\AnalyticsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;

class MarbemacAnalyticsExtension extends Extension
{
    protected $resources = array(
        'manager' => 'manager.xml'
    );

    public function load(array $configs, ContainerBuilder $container)
    {
        $this->loadDefaults($container);
        
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $variables = array(
                        'use_analytics',
                        'use_woopra',
                    );

        foreach ($variables as $attribute) {
            $container->setParameter('marbemac_analytics.options.'.$attribute, $config[$attribute]);
        }

        $variables = array(
                        'manager',
                    );

        foreach ($variables as $attribute) {
            $container->setParameter('marbemac_analytics.options.'.$attribute, $config['analytics'][$attribute]);
        }

        $variables = array(
                        'manager',
                        'idle_timeout',
                        'domain'
                    );

        foreach ($variables as $attribute) {
            $container->setParameter('marbemac_woopra.options.'.$attribute, $config['woopra'][$attribute]);
        }


    }

    /**
     * @codeCoverageIgnore
     */
    public function getNamespace()
    {
        return 'http://symfony.com/schema/dic/marbemac_analytics';
    }

    /**
     * @codeCoverageIgnore
     */
    protected function loadDefaults($container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        
        foreach ($this->resources as $resource) {
            $loader->load($resource);
        }
    }
}