<?php

namespace DK\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use DK\UserBundle\Entity\LogEntry;
use Doctrine\ORM\EntityManager;

class RefCodeController extends Controller
{
    const COOKIE_EXPIRATION = 'now +1 week'; // strtotime() format
    const COOKIE_NAME = 'refhit';

    public function refCodeHitAction(Request $request)
    {
        $log = new LogEntry;
        $log->setReferrer($request->server->get('HTTP_REFERER'));
        $log->setIP($request->server->get('REMOTE_ADDR'));

        $refCode = $request->query->get('ref');
        $log->setRefCode($refCode);

        /** @var $em EntityManager */
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('DK\\UserBundle\\Entity\\User');
        $user = $repo->findOneBy(['refCode' => $refCode]);
        if ($user) {
            $log->setRefUser($user);
        }

        $em->persist($log);
        $em->flush();

        $exitUrl = $request->getBaseUrl() . '/' . $request->attributes->get('redirectNext');
        $response = $this->redirect($exitUrl);

        $cookie = new Cookie(self::COOKIE_NAME, $log->getId(), self::COOKIE_EXPIRATION);
        $response->headers->setCookie($cookie);

        return $response;
    }
}
