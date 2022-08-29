<?php

declare(strict_types=1);

namespace Amasty\BaharOleg\Model;

use Amasty\BaharOleg\Model\BlacklistSkuFactory;
use Amasty\BaharOleg\Model\ResourceModel\BlacklistSku as BlacklistSkuResource;

class BlacklistSkuRepository
{
    /**
     * @var BlacklistSkuResource
     */
    private $blacklistSkuResource;

    /**
     * @var BlacklistSkuFactory
     */
    private $blacklistSkuFactory;

    public function __construct(
        BlacklistSkuResource $blacklistSkuResource,
        BlacklistSkuFactory $blacklistSkuFactory
    )
    {
        $this->blacklistSkuResource = $blacklistSkuResource;
        $this->blacklistSkuFactory = $blacklistSkuFactory;
    }

    public function getBySku(string $sku)
    {
        $blacklistSku = $this->blacklistSkuFactory->create();
        $this->blacklistSkuResource->load($blacklistSku, $sku, 'sku');
        return $blacklistSku;
    }

    public function getById(string $Id)
    {
        $blacklistSku = $this->blacklistSkuFactory->create();
        $this->blacklistSkuResource->load($blacklistSku, $Id, 'sku_id');
        $a = 1;
        return $blacklistSku;
    }

    public function save($blacklistSku)
    {
        $this->blacklistSkuResource->save($blacklistSku);
    }
}