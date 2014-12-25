<?php

namespace DK\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use DK\UserBundle\Entity\LogEntry;

class RefCodeController extends Controller
{

    const COOKIE_EXPIRATION = 'now +1 week'; // strtotime() format

    public function refHitAction(Request $request) {
        $log = new LogEntry;
        $log->setRefCode($request->query->get('refcode'));
        $log->setReferrer($request->server->get('HTTP_REFERER'));
        $log->setIP($request->server->get('REMOTE_ADDR'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($log);
        $em->flush();

        $exitUrl = $request->getBaseUrl() . '/' . $request->attributes->get('redirectNext');
        $response = $this->redirect($exitUrl);

        $cookie = new Cookie('refhit', $log->getId(), self::COOKIE_EXPIRATION);
        $response->headers->setCookie($cookie);

        return $response;
    }

}
