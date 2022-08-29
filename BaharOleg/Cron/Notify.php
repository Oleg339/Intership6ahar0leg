<?php

namespace Amasty\BaharOleg\Cron;

use Amasty\BaharOleg\Model\BlacklistSkuRepository;
use Amasty\BaharOleg\Model\Config\ConfigProvider;
use Magento\Framework\App\Area;
use Magento\Framework\Mail\Template\Factory as EmailTemplateFactory;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;

class Notify
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var ConfigProvider
     */
    private $configProvider;

    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    /**
     * @var BlacklistSkuRepository
     */
    private $blacklistSkuRepository;

    /**
     * @var EmailTemplateFactory
     */
    private $emailTemplateFactory;

    public function __construct(
        ConfigProvider $configProvider,
        TransportBuilder $transportBuilder,
        BlacklistSkuRepository $blacklistSkuRepository,
        EmailTemplateFactory $emailTemplateFactory,
        StoreManagerInterface $storeManager
    )
    {
        $this->configProvider = $configProvider;
        $this->transportBuilder = $transportBuilder;
        $this->blacklistSkuRepository = $blacklistSkuRepository;
        $this->emailTemplateFactory = $emailTemplateFactory;
        $this->storeManager = $storeManager;
    }

    public function execute(){
        $qty = $this->blacklistSkuRepository->getById('1');
        $vars = [
            'qty' => $qty->getQty()
        ];
        $options = [
            'area' => Area::AREA_FRONTEND,
            'store' => $this->storeManager->getStore()->getId()
        ];
        $templateId = $this->configProvider->getTemaplteId();
        $template = $this->emailTemplateFactory->get($templateId);
        $template->setVars($vars)
            ->setOptions($options);

        $message = $template->processTemplate();

        $qty->setData('email_text', $message);
        $this->blacklistSkuRepository->save($qty);

        $transport = $this->transportBuilder->setTemplateIdentifier($templateId)
            ->setTemplateOptions($options)
            ->setTemplateVars($vars)
            ->setFromByScope([
                'name' => 'Admin',
                'email' => 'AdminTest@gmail.com'
            ])
            ->addTo(
                $this->configProvider->getSendEmailTo()
            )
            ->getTransport();

        $transport->sendMessage();
    }
}