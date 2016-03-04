<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 04.03.2016
 * Time: 23:51
 */

namespace PubLeashBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class PublicationController extends Controller
{
    /**
     * @Route("/publications/{page}", defaults={"page": 1}, requirements={"page": "\d+"})
     */
    public function publicationAction($page)
    {
        var_dump($page);
        return new Response();
    }

    /**
     * @Route("/publication/{publicationName}")
     */
    public function publicationShowAction($publicationName)
    {
        var_dump($publicationName);
        return new Response();
    }
}