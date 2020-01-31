<?php

declare(strict_types=1);

namespace DK\CustomOptionDefaultValue\Plugin\Catalog\UI\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Element\Checkbox;
use Magento\Ui\Component\Form\Field;

class IsDefaultCustomOption
{
    private const FIELD_IS_DEFAULT = 'is_default';

    public function afterModifyMeta(CustomOptions $subject, array $meta): array
    {
        echo "<pre>";
        print_r($meta);
        die();

        $result = array_replace_recursive($meta, [
            CustomOptions::GROUP_CUSTOM_OPTIONS_NAME
        ]);
    }

    protected function getIsDefaultFieldConfig($sortOrder): array
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Default Value'),
                        'componentType' => Field::NAME,
                        'formElement' => Checkbox::NAME,
                        'dataScope' => static::FIELD_IS_DEFAULT,
                        'dataType' => Text::NAME,
                        'sortOrder' => $sortOrder,
                        'value' => '0',
                        'valueMap' => [
                            'true' => '1',
                            'false' => '0'
                        ],
                    ],
                ],
            ],
        ];
    }
}
