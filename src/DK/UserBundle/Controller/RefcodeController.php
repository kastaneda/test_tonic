<?php

namespace DK\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use DK\UserBundle\Entity\LogEntry;

class RefcodeController extends Controller
{

    const cookieExpiration = 'now +1 week'; // strtotime() format

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

        $cookie = new Cookie('refhit', $log->getId(), self::cookieExpiration);
        $response->headers->setCookie($cookie);

        return $response;
    }

}
