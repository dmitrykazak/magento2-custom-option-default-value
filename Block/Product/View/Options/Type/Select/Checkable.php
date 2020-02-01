<?php

declare(strict_types=1);

namespace DK\CustomOptionDefaultValue\Block\Product\View\Options\Type\Select;

use Magento\Catalog\Api\Data\ProductCustomOptionValuesInterface;
use Magento\Catalog\Block\Product\View\Options\AbstractOptions;
use Magento\Catalog\Model\Product\Option;

class Checkable extends AbstractOptions
{
    /**
     * @var string
     */
    protected $_template = 'DK_CustomOptionDefaultValue::product/composite/fieldset/options/view/checkable.phtml';

    /**
     * Returns formatted price
     */
    public function formatPrice(ProductCustomOptionValuesInterface $value): string
    {
        // @noinspection PhpMethodParametersCountMismatchInspection
        return parent::_formatPrice(
            [
                'is_percent' => $value->getPriceType() === 'percent',
                'pricing_value' => $value->getPrice($value->getPriceType() === 'percent'),
            ]
        );
    }

    /**
     * Returns current currency for store
     *
     * @return float|string
     */
    public function getCurrencyByStore(ProductCustomOptionValuesInterface $value)
    {
        // @noinspection PhpMethodParametersCountMismatchInspection
        return $this->pricingHelper->currencyByStore(
            $value->getPrice(true),
            $this->getProduct()->getStore(),
            false
        );
    }

    /**
     * Returns preconfigured value for given option
     *
     * @return null|array|string
     */
    public function getPreconfiguredValue(Option $option)
    {
        return $this->getProduct()->getPreconfiguredValues()->getData('options/' . $option->getId());
    }
}
