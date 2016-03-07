<?php

namespace PubLeashBundle\Controller;

use GeoIp2\Exception\AddressNotFoundException;
use PubLeashBundle\Entity\LanguageEnum;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use PubLeashBundle\Service\GeoIP;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        /**
         * @var GeoIP $geoIp
         */
        $geoIp = $this->get('geoip');
        try {
//            dump($geoIp->getCountry());
        }catch(AddressNotFoundException $e){
//            dump($e);
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
