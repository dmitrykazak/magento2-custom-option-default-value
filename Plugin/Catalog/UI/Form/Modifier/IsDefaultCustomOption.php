<?php

declare(strict_types=1);

namespace DK\CustomOptionDefaultValue\Plugin\Catalog\UI\Form\Modifier;

use DK\CustomOptionDefaultValue\Model\Config;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions;
use Magento\Ui\Component\Form\Element\Checkbox;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Field;

class IsDefaultCustomOption
{
    protected const FIELD_IS_DEFAULT = 'is_default';
    private const DEFAULT_SORT_ORDER = 70;

    /**
     * @var Config
     */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function afterModifyMeta(CustomOptions $subject, array $meta): array
    {
        if (!$this->config->isActiveModule()) {
            return $meta;
        }

        return array_replace_recursive($meta, [
            CustomOptions::GROUP_CUSTOM_OPTIONS_NAME => [
                'children' => [
                    CustomOptions::GRID_OPTIONS_NAME => [
                        'children' => [
                            'record' => [
                                'children' => [
                                    CustomOptions::CONTAINER_OPTION => [
                                        'children' => [
                                            CustomOptions::GRID_TYPE_SELECT_NAME => [
                                                'children' => [
                                                    'record' => [
                                                        'children' => [
                                                            static::FIELD_IS_DEFAULT => $this->getIsDefaultFieldConfig(self::DEFAULT_SORT_ORDER),
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
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
                            'false' => '0',
                        ],
                    ],
                ],
            ],
        ];
    }
}
