<?php
namespace Signalzwei\Bundle\SabreDavBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class SignalzweiSabreDavExtension
 */
class SabreDavExtension extends Extension
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

        foreach ($config['plugins'] as $plugin => $enabled) {
            if ($enabled) {
                $loader->load(sprintf('plugins/%s.yml', $plugin));
            }
        }

        foreach ($config['backends'] as $backend => $service) {
            $container->setAlias('sabredav.backend.'.$backend, $service);
        }

        $mounts = array();
        foreach ($config['mounts'] as $mount => $enabled) {
            if ($enabled) {
                $loader->load(sprintf('collections/%s.yml', $mount));
            }
        }

        $pdo = $config['pdo'];
        $pdoDefinition = $container->getDefinition('sabredav.pdo');
        $pdoDefinition->replaceArgument(0, 'mysql:host='.$pdo['host'].';port='.$pdo['port'].';dbname='.$pdo['database']);
        $pdoDefinition->replaceArgument(1, $pdo['user']);
        $pdoDefinition->replaceArgument(2, $pdo['password']);
    }
}