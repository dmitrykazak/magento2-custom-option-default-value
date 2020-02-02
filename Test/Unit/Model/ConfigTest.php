<?php

declare(strict_types=1);

namespace DK\CustomOptionDefaultValue\Test\Unit\Model;

use DK\CustomOptionDefaultValue\Model\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class ConfigTest extends TestCase
{
    /**
     * @var MockObject|ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var Config
     */
    private $config;

    protected function setUp(): void
    {
        parent::setUp();

        $this->scopeConfig = $this->createMock(ScopeConfigInterface::class);
        $this->config = new Config($this->scopeConfig);
    }

    public function testIsActiveModule(): void
    {
        $this->scopeConfig
            ->expects($this->once())
            ->method('isSetFlag')
            ->with($this->getConstValue('XML_PATH_GENERAL_ACTIVE')->getValue())
            ->willReturn(true);

        $this->assertTrue($this->config->isActiveModule());
    }

    private function getConstValue(string $const): \ReflectionClassConstant
    {
        return new \ReflectionClassConstant(Config::class, $const);
    }
}
