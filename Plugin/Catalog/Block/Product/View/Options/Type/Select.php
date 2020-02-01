<?php

declare(strict_types=1);

namespace DK\CustomOptionDefaultValue\Plugin\Catalog\Block\Product\View\Options\Type;

use DK\CustomOptionDefaultValue\Block\Product\View\Options\Type\Select\CheckableFactory;
use DK\CustomOptionDefaultValue\Block\Product\View\Options\Type\Select\MultipleFactory;
use DK\CustomOptionDefaultValue\Model\Config;
use Magento\Catalog\Block\Product\View\Options\Type\Select as TypeSelect;
use Magento\Catalog\Model\Product\Option;

final class Select
{
    /**
     * @var MultipleFactory
     */
    private $multipleFactory;

    /**
     * @var CheckableFactory
     */
    private $checkableFactory;

    /**
     * @var Config
     */
    private $config;

    public function __construct(
        MultipleFactory $multipleFactory,
        CheckableFactory $checkableFactory,
        Config $config
    ) {
        $this->multipleFactory = $multipleFactory;
        $this->checkableFactory = $checkableFactory;
        $this->config = $config;
    }

    public function aroundGetValuesHtml(TypeSelect $subject, \Closure $proceed)
    {
        if (!$this->config->isActiveModule()) {
            return $proceed();
        }

        $option = $subject->getOption();
        $optionType = $option->getType();

        $optionBlock = null;
        if ($optionType === Option::OPTION_TYPE_DROP_DOWN ||
            $optionType === Option::OPTION_TYPE_MULTIPLE
        ) {
            $optionBlock = $this->multipleFactory->create();
        }

        if ($optionType === Option::OPTION_TYPE_RADIO ||
            $optionType === Option::OPTION_TYPE_CHECKBOX
        ) {
            $optionBlock = $this->checkableFactory->create();
        }

        if (null === $optionBlock) {
            return $proceed();
        }

        return $optionBlock
            ->setOption($option)
            ->setProduct($subject->getProduct())
            ->setSkipJsReloadPrice(1)
            ->toHtml();
    }
}
