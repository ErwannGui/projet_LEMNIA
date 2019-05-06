<?php

namespace Lemnia\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LemniaUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
