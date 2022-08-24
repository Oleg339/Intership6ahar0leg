<?php

namespace Amasty\SecondBaharOleg\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigProvider {

    /**
     * @var ScopeConfigInterface
     */
    public $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    private $pathPrefix = 'second_bahar_config';

    public function getValue($path, $scope = 'store', $storeId = null){
        return $this->scopeConfig->getValue("$this->pathPrefix/$path");
    }

    public function getForSku(){
        return $this->getValue('general/for_sku');
    }
    public function getPromoSku(){
        return $this->getValue('general/promo_sku');
    }
}