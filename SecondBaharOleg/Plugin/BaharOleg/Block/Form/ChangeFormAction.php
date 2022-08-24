<?php

declare(strict_types=1);

namespace Amasty\SecondBaharOleg\Plugin\BaharOleg\Block\Form;

use Amasty\BaharOleg\Block\Form;

class ChangeFormAction
{
    const NEW_ACTION_FORM_URL = 'checkout/cart/add';

    public function afterGetFormAction(Form $subject):string
    {
        return $subject->getUrl(self::NEW_ACTION_FORM_URL);
    }

}