<?php
namespace Amasty\BaharOleg\Block;

use Amasty\BaharOleg\Model\Config\ConfigProvider;
use Magento\Framework\View\Element\Template;


class Hello extends Template
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

    public function GetWelcomeText(): string
    {
        return $this->configProvider->getWelcomeText();
    }
}