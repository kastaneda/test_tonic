<?php

namespace DK\UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;
use FOS\UserBundle\Model\UserInterface;

class RegistrationFormHandler extends BaseHandler
{

    protected function onSuccess(UserInterface $user, $confirmation) {
        if ($this->request->cookies->has('refhit')) {
            $refhit = $this->request->cookies->get('refhit');
            $user->setMasterHit($refhit);
        }

        parent::onSuccess($user, $confirmation);
    }

}
