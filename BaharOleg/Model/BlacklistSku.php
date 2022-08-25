<?php

namespace Amasty\BaharOleg\Model;

use Amasty\BaharOleg\Model\ResourceModel\BlacklistSku as BlacklistSkuResource;
use Magento\Framework\Model\AbstractModel;

class BlacklistSku extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(BlacklistSkuResource::class);
    }
}