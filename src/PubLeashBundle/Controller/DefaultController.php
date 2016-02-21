<?php

namespace PubLeashBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render("PubLeashBundle:Default:layout.html.twig");
    }

    /**
     * @Route("/admin/bla")
     */
    public function adminAction()
    {
        return new Response();
    }
}
