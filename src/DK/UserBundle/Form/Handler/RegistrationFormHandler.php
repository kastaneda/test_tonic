<?php

namespace DK\UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;
use FOS\UserBundle\Model\UserInterface;

class RegistrationFormHandler extends BaseHandler
{
    /**
     * @return UserInterface
     */
    protected function createUser()
    {
        $user = $this->userManager->createUser();
        if ($this->request->cookies->has('refhit')) {
            $refhit = $this->request->cookies->get('refhit');
            $user->setMasterHit($refhit);
        }
        return $user;
    }
}
