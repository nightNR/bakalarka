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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LibraryController extends Controller
{
    /**
     * @Route("/library/list/{page}", defaults={"page": "1"}, requirements={"page": "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function libraryAction($page) {
        $libraryService = $this->get('library');
        $limit = 15;

        $paginator = $libraryService->getLibraryEntries($page, $limit);

        $maxPages = ceil($paginator->count() / $limit);

        return [
            'paginator' => $paginator,
            'max_pages' => $maxPages,
            'current_page' => $page,
            'publication_service' => $libraryService
        ];
    }
}