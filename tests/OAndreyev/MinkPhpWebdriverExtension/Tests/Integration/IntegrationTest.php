<?php declare(strict_types = 1);

namespace OAndreyev\MinkPhpWebdriverExtension\Tests\Integration;

use Behat\Mink\Mink;
use Behat\Mink\Session;
use Behat\MinkExtension\ServiceContainer\MinkExtension;
use Behat\Testwork\ApplicationFactory as BaseFactory;
use Behat\Testwork\Cli\Application;
use Behat\Testwork\ServiceContainer\ServiceProcessor;
use OAndreyev\Mink\Driver\WebDriver;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class IntegrationTest extends TestCase
{
    public function testIntegration(): void
    {
        $input = new ArrayInput(['--config' => __DIR__ . '/behat.yml']);
        $output = new NullOutput();

        $factory = new ApplicationFactory();
        $application = $factory->createApplication();

        /** @var ContainerBuilder $container */
        $container = \Closure::bind(function () use ($input, $output) {
            /** @var Application $this */
            return $this->createContainer($input, $output);
        }, $application, $application)();

        \Closure::bind(function () {
            /** @var ContainerBuilder $this */
            unset($this->removedIds[MinkExtension::MINK_ID]);
        }, $container, $container)();

        /** @var Mink $mink */
        $mink = $container->get(MinkExtension::MINK_ID);
        self::assertInstanceOf(Session::class, $session = $mink->getSession('webdriver'));
        self::assertInstanceOf(WebDriver::class, $session->getDriver());
    }
}

class ApplicationFactory extends BaseFactory
{
    /** @var \Behat\Behat\ApplicationFactory */
    private $target;

    public function __construct()
    {
        $this->target = new \Behat\Behat\ApplicationFactory();
    }

    private function getPrivateMethod(string $name, ...$args)
    {
        return \Closure::bind(function () use ($name, $args) {
            return $this->$name(...$args);
        }, $this->target, BaseFactory::class)();
    }

    /**
     * {@inheritdoc}
     */
    protected function getName()
    {
        return $this->getPrivateMethod('getName');
    }

    /**
     * {@inheritdoc}
     */
    protected function getVersion()
    {
        return $this->getPrivateMethod('getVersion');
    }

    protected function getDefaultExtensions()
    {
        return $this->getPrivateMethod('getDefaultExtensions');
    }

    protected function getEnvironmentVariableName()
    {
        return $this->getPrivateMethod('getEnvironmentVariableName');
    }

    protected function getConfigPath()
    {
        return __DIR__ . '/behat.yml';
    }

    private function getDefaultFormatterFactories(ServiceProcessor $processor)
    {
        return $this->getPrivateMethod('getDefaultFormatterFactories', $processor);
    }
}

