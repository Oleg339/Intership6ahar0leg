<?php

namespace Amasty\BaharOleg\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;

class Index extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface
{
    public function execute()
    {
        echo 'Привет Magento. Привет Amasty. Я готов тебя покорить!';
    }
}