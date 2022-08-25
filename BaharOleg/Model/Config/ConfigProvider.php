<?php

namespace Amasty\BaharOleg\Model\Config;

class ConfigProvider extends ConfigProviderAbstract {

    private $pathPrefix = 'bahar_config';

    public function getValue($path, $scope = 'store', $storeId = null){
        return $this->scopeConfig->getValue("$this->pathPrefix/$path");
    }

    public function getWelcomeText($storeId = null): string
    {
        return $this->getValue('general/welcome_text');
    }

    public function isEnabled($storeId = null): bool
    {
        return $this->getValue('general/enabled');
    }

    public function getIsShowQtyField(){
        return $this->getValue('general/is_show_qty_field');
    }

    public function getQtyValue(){
        return $this->getValue('general/qty_default_value');
    }
}