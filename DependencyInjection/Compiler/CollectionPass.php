<?php
namespace Singalzwei\SabreDavBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class CollectionPass
 */
class CollectionPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $serverDefinition = $container->getDefinition('sabredav.server');
        $collections = array();

        foreach ($container->findTaggedServiceIds('sabredav.collection') as $id => $attr) {
            $collections[] = new Reference($id);
        }

        if (empty($collections)) {
            throw new \LogicException('You have to tag at least one service with "sabredav.collection".');
        } elseif (1 === count($collections)) {
            $serverDefinition->replaceArgument(0, $collections[0]);
        } else {
            $serverDefinition->replaceArgument(0, $collections);
        }
    }
}