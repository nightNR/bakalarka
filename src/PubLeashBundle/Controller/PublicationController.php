<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 04.03.2016
 * Time: 23:51
 */

namespace PubLeashBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class PublicationController extends Controller
{
    /**
     * @Route("/publication/list/{page}", defaults={"page": "1"}, requirements={"page": "\d+"})
     */
    public function publicationAction($page)
    {
        var_dump($page);
        return new Response();
    }

    /**
     * @Route("/publication/{publicationId}/read/chapter/list/{page}", defaults={"page": "1"}, requirements={"publicationId": "\d+", "page": "\d+"})
     */
    public function showPublicationChaptersAction($publicationId, $page)
    {

    }

    /**
     * @Route("/publication/{publicationId}/read/chapter/{chapterId}", defaults={"chapterId": "1"}, requirements={"publicationId": "\d+", "chapterId": "\d+"})
     */
    public function showPublicationChapterAction($publicationId, $chapterId)
    {

    }

    /**
     * @Route("/publication/read/{publicationId}")
     */
    public function showPublicationAction($publicationId)
    {
        var_dump($publicationId);
        return new Response();
    }

    /**
     * @Route("/publication/review/{publicationId}/")
     * @Method("POST")
     * @param $publicationId
     * @return Response
     */
    public function ratePublicationAction($publicationId)
    {
        echo "Review response";
        return new Response();
    }

    /**
     * @Route("/publication/{publicationId}/reviews/{page}", defaults={"page": "1"}, requirements={"publicationId": "\d+", "page": "\d+"})
     * @param $publicationId
     * @return Response
     */
    public function showReviewsAction($publicationId, $page)
    {
        return new Response();
    }

    /**
     * @Route("/publication/review/{reviewId}", requirements={"reviewId": "\d+"})
     * @Method("GET")
     * @param $reviewId
     * @return Response
     */
    public function showReviewAction($reviewId)
    {
        return new Response();
    }

    /**
     * @Route(/publication/add)
     * @return Response
     */
    public function addPublicationAction()
    {
        return new Response();
    }

    /**
     * @Route("/publication/{publicationId}/chapter/add")
     * @param $publicationId
     */
    public function addChapter($publicationId)
    {

    }

}