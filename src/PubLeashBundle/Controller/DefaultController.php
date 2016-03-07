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
        $breadcrumbs = $this->get("white_october_breadcrumbs");

        // Pass "_demo" route name without any parameters
        $breadcrumbs->addRouteItem("Demo", 'fos_user_profile_show');

        // Pass "_demo_hello" route name with parameters
        $breadcrumbs->addRouteItem("Hello Breadcrumbs", "fos_user_profile_show", [
            'name' => 'Breadcrumbs',
        ]);

        // Add "homepage" route link to begin of breadcrumbs
        $breadcrumbs->prependRouteItem("Home", "publeash_default_index");
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
