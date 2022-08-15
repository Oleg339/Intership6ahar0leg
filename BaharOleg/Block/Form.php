<?php
namespace Amasty\BaharOleg\Block;

use Amasty\BaharOleg\Model\Config\ConfigProvider;
use Magento\Framework\View\Element\Template;

class Form extends Template
{
    /**
     * @var \Amasty\BaharOleg\Model\Config\ConfigProvider;
     */

    private $configProvider;

    public function __construct(
        ConfigProvider $configProvider,
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->configProvider = $configProvider;
    }

    public function isShowQtyField(){
        return $this->configProvider->getIsShowQtyField();
    }
    public function getQtyValue(){
        return $this->configProvider->getQtyValue();
    }
}