<?php

declare(strict_types=1);

namespace Amasty\BaharOleg\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class BlacklistSku extends AbstractDb
{
    public const TABLE_NAME = 'amasty_baharoleg_blacklist';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, 'sku_id');
    }
}