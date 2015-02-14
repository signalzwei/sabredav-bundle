<?php

namespace Signalzwei\SabreDavBundle;

use Signalzwei\SabreDavBundle\DependencyInjection\Compiler\CollectionPass;
use Signalzwei\SabreDavBundle\DependencyInjection\Compiler\PluginPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SabreDavBundle extends Bundle
{
    public function boot()
    {
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CollectionPass());
        $container->addCompilerPass(new PluginPass());
    }
}
