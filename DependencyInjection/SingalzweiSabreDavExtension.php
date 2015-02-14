<?php
namespace Signalzwei\SabreDavBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class SignalzweiSabreDavExtension
 */
class SignalzweiSabreDavExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $server = $container->getDefinition('sabredav.server');

        foreach ($config['plugins'] as $plugin => $enabled) {
            if ($enabled) {
                $loader->load(sprintf('services/plugins/%s.yml', $plugin));
            }
        }

        foreach ($config['backends'] as $backend => $service) {
            $container->setAlias('sabredav.backend.'.$backend, $service);
        }

        $mounts = array();
        foreach ($config['mounts'] as $mount => $service) {
            $mounts[] = new Reference($service);
        }
        $server->replaceArgument(0, $mounts);
    }
}