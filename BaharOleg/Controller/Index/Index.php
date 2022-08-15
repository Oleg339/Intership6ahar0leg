<?php

namespace Amasty\BaharOleg\Controller\Index;

use Amasty\BaharOleg\Model\Config\ConfigProvider;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Index implements ActionInterface
{
    /**
     * @var ResultFactory
     */
    private $resultFactory;

    /**
     * @var \Amasty\BaharOleg\Model\Config\ConfigProvider;
     */
    private $configProvider;


    public function __construct(
        ResultFactory $resultFactory,
        ConfigProvider $configProvider,
    )
    {
        $this->resultFactory=$resultFactory;
        $this->configProvider = $configProvider;
    }

    public function execute()
    {
        if ($this->configProvider->getIsEnabled()) {
            return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        } else {
            die('Module is disabled');
        }
    }
}
