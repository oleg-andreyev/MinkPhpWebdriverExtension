<?php

namespace OAndreyev\MinkPhpWebdriverExtension\ServiceContainer;

use Behat\MinkExtension\ServiceContainer\MinkExtension;
use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use OAndreyev\Mink\Driver\WebDriverFactory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MinkPhpWebdriverExtension implements Extension
{
    public function initialize(ExtensionManager $extensionManager)
    {
        /** @var MinkExtension $extension */
        $extension = $extensionManager->getExtension(MinkExtension::MINK_ID);
        $extension->registerDriverFactory(new WebDriverFactory());
    }

    public function process(ContainerBuilder $container)
    {
    }

    public function getConfigKey()
    {
        return 'webdriver';
    }

    public function configure(ArrayNodeDefinition $builder)
    {
    }

    public function load(ContainerBuilder $container, array $config)
    {
    }
}
