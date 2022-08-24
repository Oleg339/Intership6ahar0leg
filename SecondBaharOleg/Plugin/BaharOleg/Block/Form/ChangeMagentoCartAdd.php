<?php

namespace Amasty\SecondBaharOleg\Plugin\BaharOleg\Block\Form;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Controller\Cart\Add;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\Manager;

class ChangeMagentoCartAdd
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository2;

    /**
     * @var Manager
     */
    private $messageManager;

    public function __construct(
        ProductRepositoryInterface $productRepository2,
        Manager $messageManager
    )
    {
        $this->productRepository2 = $productRepository2;
        $this->messageManager = $messageManager;
    }

    public function beforeExecute(Add $subject){
        $data = $subject->getRequest()->getParams();
        $sku = $data['sku'];
        try{
            $product = $this->productRepository2->get($sku);
        }
        catch(NoSuchEntityException $ex){
            $this->messageManager->addWarningMessage('Нет такого продукта!');
            return;
        }
        $productId = $product->getId();
        $dataAdd = ['product' => $productId];
        $dataFinal = array_merge($data, $dataAdd);
        $subject->getRequest()->setParams($dataFinal);
    }
}