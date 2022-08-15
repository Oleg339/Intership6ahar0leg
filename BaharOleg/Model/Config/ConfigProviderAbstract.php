<?php

namespace Amasty\BaharOleg\Model\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;

abstract class ConfigProviderAbstract
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */

    public $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    abstract public function getValue($path, $scope = 'store', $storeId = null);
}