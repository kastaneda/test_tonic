<?php

namespace DK\UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;
use FOS\UserBundle\Model\UserInterface;
use DK\UserBundle\Entity\User as DKUser;
use DK\UserBundle\Controller\RefCodeController;

class RegistrationFormHandler extends BaseHandler
{
    /**
     * @return UserInterface
     */
    protected function createUser()
    {
        $user = $this->userManager->createUser();
        if ($user instanceof DKUser && $this->request->cookies->has(RefCodeController::COOKIE_NAME)) {
            $cookie = $this->request->cookies->get(RefCodeController::COOKIE_NAME);
            $user->setRefHitCookie($cookie);
        }
        return $user;
    }
}
