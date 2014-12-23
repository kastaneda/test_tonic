<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction() {
        return $this->render('AppBundle::index.html.twig');
    }

    public function refCodeAction(Request $request) {
        return $this->render('AppBundle::refcode.html.twig', [
        'refcode' => $request->query->get('refcode'),
        'redirectNext' => $request->attributes->get('redirectNext'),
        ]);
    }

}
