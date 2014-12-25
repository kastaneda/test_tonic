<?php

namespace DK\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends BaseController
{
    /**
     * For embedding from layout template
     */
    public function navbarLoginAction(Request $request)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);
        $csrfToken = $this->container->has('form.csrf_provider') ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate') : null;

        return $this->container->get('templating')->renderResponse('UserBundle::navbar-login.html.twig', [
                    'last_username' => $lastUsername,
                    'csrf_token' => $csrfToken,
        ]);
    }
}
