<?php

namespace Amasty\SecondBaharOleg\Preference\BaharOleg\Controller\Index;

use Amasty\BaharOleg\Controller\Index\Index as firstIndex;
use Amasty\BaharOleg\Model\Config\ConfigProvider;
use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Model\Session;



class Index extends firstIndex
{
    /**
     * @var Session
     */
    private $customerSession;

    public function __construct(
        ResultFactory $resultFactory,
        ConfigProvider $configProvider,
        Session $customerSession
    )
    {
        parent::__construct($resultFactory, $configProvider);
        $this->customerSession = $customerSession;
    }

    public function execute()
    {
        if($this->customerSession->isLoggedIn()){
            return parent::execute();
        }
        else{
            die('Please login');
        }
    }
}
