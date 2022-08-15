<?php

namespace Amasty\BaharOleg\Controller\Cart;

use Amasty\BaharOleg\Model\Config\ConfigProvider;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\ManagerInterface;

class AddToCart implements ActionInterface
{
    /**
     * @var ResultFactory
     */
    private $resultFactory;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    private $checkoutSession;

    /**
    * @var \Magento\Catalog\Api\ProductRepositoryInterface
    */
    private $productRepository;

    /**
     * @var \Amasty\BaharOleg\Model\Config\ConfigProvider
     */
    private $configProvider;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    private $messageManager;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    private  $request;

    public function __construct(
        ResultFactory $resultFactory,
        Session $checkoutSession,
        ProductRepositoryInterface $productRepository,
        ConfigProvider $configProvider,
        ManagerInterface $messageManager,
        RequestInterface $request
    )
    {
        $this->resultFactory=$resultFactory;
        $this->checkoutSession=$checkoutSession;
        $this->productRepository=$productRepository;
        $this->configProvider=$configProvider;
        $this->messageManager=$messageManager;
        $this->request=$request;
    }

    /**
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('baharoleg/index/index');

        if (!$this->configProvider->getIsEnabled()) {
            return $resultRedirect;
        }

        $quote = $this->checkoutSession->getQuote();
        if (!$quote->getId()) {
            $quote->save();
        }

        $sku = $this->request->getParam('sku');

        if (!$this->configProvider->getIsShowQtyField()) {
            $qty = 1;
        }
        else {
            $qty = (int)$this->request->getParam('qty');
        }

        try {
            $product = $this->productRepository->get($sku);
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addWarningMessage('Нет такого продукта');
            return $resultRedirect;
        }

        if ($product->getTypeId() !== 'simple') {
            $this->messageManager->addWarningMessage('Продукт не Simple типа');
            return $resultRedirect;
        }

        if ($qty > $product->getExtensionAttributes()->getStockItem()->getQty()) {
            $this->messageManager->addWarningMessage('Qty слишком большой');
            return $resultRedirect;
        }

        $quote->addProduct($product, $qty);
        $quote->save();
        $this->messageManager->addSuccessMessage("Готово!");
        return $resultRedirect;
    }
}