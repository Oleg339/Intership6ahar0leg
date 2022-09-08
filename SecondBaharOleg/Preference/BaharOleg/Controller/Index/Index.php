<?php

namespace Amasty\SecondBaharOleg\Preference\BaharOleg\Controller\Index;

use Amasty\BaharOleg\Controller\Index\Index as FirstIndex;

class Index extends FirstIndex
{
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        if($customerSession->isLoggedIn()){
            return parent::execute();
        }
        else{
            die('Please login');
        }
    }
}
