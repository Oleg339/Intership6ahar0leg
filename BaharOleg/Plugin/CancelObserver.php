<?php

namespace Amasty\BaharOleg\Plugin;

use Amasty\SecondBaharOleg\Observer\CheckAddProduct;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\Observer;

class CancelObserver
{
    /**
     * @var Http
     */
    private $http;

    public function __construct(Http $http)
    {
        $this->http = $http;
    }

    public function aroundExecute(
        CheckAddProduct $subject,
        callable $proceed,
        Observer $observer
    )
    {
        if (!$this->http->isAjax()){
            return $proceed($observer);
        }
    }
}