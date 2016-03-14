<?php
/**
 * Created by PhpStorm.
 * User: nightnr
 * Date: 12.3.2016
 * Time: 13:43
 */

namespace PubLeashBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LibraryController
{
    /**
     * @Route("/library/list/{page}", defaults={"page": "1"}, requirements={"page": "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function libraryAction($page) {
        return [];
    }
}