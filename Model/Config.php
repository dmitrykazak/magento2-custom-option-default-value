<?php

declare(strict_types=1);

namespace DK\CustomOptionDefaultValue\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    private const XML_PATH_GENERAL_ACTIVE = 'custom_option_default_value/general/active';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function isActiveModule($store = null): bool
    {
        return (bool) $this->scopeConfig->isSetFlag(
            self::XML_PATH_GENERAL_ACTIVE,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }
}
