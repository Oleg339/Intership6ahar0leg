<?php

namespace Amasty\SecondBaharOleg\Observer;

use Amasty\SecondBaharOleg\Model\ConfigProvider;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;


class CheckAddProduct implements ObserverInterface
{
    /**
     * @var ConfigProvider
     */
    private $configProvider;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        ConfigProvider $configProvider,
        Session $session,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->configProvider = $configProvider;
        $this->session = $session;
        $this->productRepository = $productRepository;
    }

    public function execute(Observer $observer)
    {
        $inputSku = $observer->getData('sku');
        $skusStrings = $this->configProvider->getForSku();
        $skusArray = explode(',', $skusStrings);
        if(in_array($inputSku, $skusArray)){
            $promoSku = $this->configProvider->getPromoSku();
            $product = $this->productRepository->get($promoSku);
            $quote = $this->session->getQuote();
            if (!$quote->getId()) {
                $quote->save();
            }

            $quote->addProduct($product, 1);
            $quote->save();
        }
    }
}