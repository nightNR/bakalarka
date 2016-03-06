<?php

namespace PubLeashBundle\Controller;

use GeoIp2\Exception\AddressNotFoundException;
use PubLeashBundle\Entity\LanguageEnum;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use PubLeashBundle\Service\GeoIpResolver;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        /**
         * @var GeoIpResolver $geoIp
         */
        $geoIp = $this->get('geo_ip');
        $geoIp->setClientIP($this->container->get('request_stack')->getCurrentRequest()->getClientIp());
        try {
            dump($geoIp->country());
        }catch(AddressNotFoundException $e){
            dump($e);
        }
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
