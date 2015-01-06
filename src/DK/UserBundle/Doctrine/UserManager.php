<?php

namespace DK\UserBundle\Doctrine;

use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;
use FOS\UserBundle\Model\UserInterface;
use DK\UserBundle\Entity\User as DKUser;

class UserManager extends BaseUserManager
{
    public function updateCanonicalFields(UserInterface $user)
    {
        parent::updateCanonicalFields($user);

        if ($user instanceof DKUser) {
            $refHitCookie = $user->getRefHitCookie();
            if (is_numeric($refHitCookie)) {
                $repo = $this->objectManager->getRepository('DK\\UserBundle\\Entity\\LogEntry');
                $refHit = $repo->find($refHitCookie);
                if ($refHit) {
                    $user->setRefHit($refHit);
                    $referrer = $refHit->getRefUser();
                    if ($referrer) {
                        $user->setReferrer($referrer);
                    }
                }
                $user->setRefHitCookie(null);
            }
        }

    }
}