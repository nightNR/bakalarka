<?php

namespace PubLeashBundle\Controller;

use GeoIp2\Exception\AddressNotFoundException;
use PubLeashBundle\Entity\LanguageEnum;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use PubLeashBundle\Service\GeoIP;
use Symfony\Component\Process\Process;

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
        return [];
    }

    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        $p1 = new Process('cd /home/nightnr/www/pub-leash/ && git pull origin master');
        $p1->run();
        echo $p1->getOutput();
        return new Response();
    }
}
