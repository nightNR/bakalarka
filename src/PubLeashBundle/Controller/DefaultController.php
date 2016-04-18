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
use Symfony\Component\Process\Exception\ProcessFailedException;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return $this->redirectToRoute('publeash_publication_publication');
    }

//    /**
//     * @Route("/admin")
//     */
//    public function adminAction()
//    {
//        $p1 = new Process('cd /home/night/bakalarka/ && git pull origin master');
//        $p1->run();
//	if (!$p1->isSuccessful()) {
//    		throw new ProcessFailedException($p1);
//	}
//        echo $p1->getOutput();
//        return new Response();
//    }
}
