<?php

declare(strict_types=1);

namespace DK\CustomOptionDefaultValue\Test\Unit\Plugin\Catalog\Block\Product\View\Options\Type;

use DK\CustomOptionDefaultValue\Block\Product\View\Options\Type\Select\CheckableFactory;
use DK\CustomOptionDefaultValue\Block\Product\View\Options\Type\Select\Multiple;
use DK\CustomOptionDefaultValue\Block\Product\View\Options\Type\Select\MultipleFactory;
use DK\CustomOptionDefaultValue\Model\Config;
use DK\CustomOptionDefaultValue\Plugin\Catalog\Block\Product\View\Options\Type\Select;
use Magento\Catalog\Block\Product\View\Options\Type\Select as TypeSelect;
use Magento\Catalog\Model\Product;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class SelectTest extends TestCase
{
    /**
     * @var MockObject|MultipleFactory
     */
    private $multipleFactory;

    /**
     * @var CheckableFactory|MockObject
     */
    private $checkableFactory;

    /**
     * @var Config|MockObject
     */
    private $config;

    /**
     * @var Select
     */
    private $plugin;

    /**
     * @var MockObject|TypeSelect
     */
    private $typeSelectMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->multipleFactory = $this->createPartialMock(MultipleFactory::class, ['create']);
        $this->checkableFactory = $this->createPartialMock(CheckableFactory::class, ['create']);
        $this->config = $this->createMock(Config::class);

        $this->typeSelectMock = $this->createMock(TypeSelect::class);

        $this->plugin = new Select($this->multipleFactory, $this->checkableFactory, $this->config);
    }

    public function testAroundGetValuesHtml(): void
    {
        $proceed = function () {
            return null;
        };

        $this->config->expects(self::once())->method('isActiveModule')->willReturn(true);

        /** @var \Magento\Catalog\Model\Product\Option|MockObject $option */
        $option = $this->createMock(\Magento\Catalog\Model\Product\Option::class);
        $option->expects(self::once())->method('getType')->willReturn(\Magento\Catalog\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_DROP_DOWN);

        /** @var MockObject|Product $product */
        $product = $this->createMock(Product::class);

        $this->typeSelectMock->expects(self::once())->method('getOption')->willReturn($option);
        $this->typeSelectMock->expects(self::once())->method('getProduct')->willReturn($product);

        $multipleMock = $this->createPartialMock(Multiple::class, [
            'setOption', 'setProduct', 'setSkipJsReloadPrice', 'toHtml',
        ]);
        $multipleMock->method('setOption')->willReturn($multipleMock);
        $multipleMock->method('setProduct')->willReturn($multipleMock);
        $multipleMock->method('setSkipJsReloadPrice')->willReturn($multipleMock);

        $this->multipleFactory->expects(self::once())->method('create')->willReturn($multipleMock);

        $this->plugin->aroundGetValuesHtml($this->typeSelectMock, $proceed);
    }

    public function testAroundGetValuesHtmlModuleDisabled(): void
    {
        $proceed = function () {
            return null;
        };

        $this->config->expects(self::once())->method('isActiveModule')->willReturn(false);
        $this->typeSelectMock->expects(self::never())->method('getOption');

        $this->plugin->aroundGetValuesHtml($this->typeSelectMock, $proceed);
    }
}
