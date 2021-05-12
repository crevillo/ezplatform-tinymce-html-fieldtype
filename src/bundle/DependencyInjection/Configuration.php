<?php

namespace Crevillo\EzTinyMCEHtmlBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('crevillo_ez_tiny_mce_html');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('images_parent_location_id')->defaultValue(51)->end()
            ->end();

        return $treeBuilder;
    }
}
