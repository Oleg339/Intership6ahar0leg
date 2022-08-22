<?php

namespace Amasty\BaharOleg\Controller\Requests;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;

class GetSku implements ActionInterface
{
    /**
     * @var ResultFactory
     */
    private $resultFactory;


    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var RequestInterface
     */
    private  $request;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        ResultFactory $resultFactory,
        ProductRepositoryInterface $productRepository,
        RequestInterface $request,
        CollectionFactory $collectionFactory
    )
    {
        $this->resultFactory=$resultFactory;
        $this->productRepository=$productRepository;
        $this->request=$request;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        $Skus = [];
        $sku = $this->request->getParam('sku');
        $products = $this->collectionFactory->create();
        $resultJson = $this->resultFactory->create($this->resultFactory::TYPE_JSON);
        $products->addAttributeToFilter('sku', array('like' => '%'.$sku.'%'))->setPageSize(4);
        foreach($products as $product){
            $Skus[] = $this->productRepository->get($product->getSku())->getData();
        }
        $resultJson->setData($Skus);
        return $resultJson;
    }
}
