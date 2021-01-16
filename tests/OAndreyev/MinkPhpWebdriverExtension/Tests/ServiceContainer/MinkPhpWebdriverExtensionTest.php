<?php declare(strict_types = 1);

namespace OAndreyev\MinkPhpWebdriverExtension\Tests\ServiceContainer;

use Behat\MinkExtension\ServiceContainer\MinkExtension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use OAndreyev\Mink\Driver\WebDriverFactory;
use OAndreyev\MinkPhpWebdriverExtension\ServiceContainer\MinkPhpWebdriverExtension;
use PHPUnit\Framework\TestCase;

class MinkPhpWebdriverExtensionTest extends TestCase
{
    public function testInitialize()
    {
        $extensionManager = new ExtensionManager([
            $minkExtension = new MinkExtension()
        ]);

        $target = new MinkPhpWebdriverExtension();
        $target->initialize($extensionManager);

        $ref = new \ReflectionProperty($minkExtension, 'driverFactories');
        $ref->setAccessible(true);

        $drivers = $ref->getValue($minkExtension);

        self::assertArrayHasKey('webdriver', $drivers);
        self::assertInstanceOf(WebDriverFactory::class, $drivers['webdriver']);
    }
}
