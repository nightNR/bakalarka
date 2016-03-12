<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 04.03.2016
 * Time: 23:51
 */

namespace PubLeashBundle\Controller;


use PubLeashBundle\Entity\Publication;
use PubLeashBundle\Form\PublicationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PublicationController extends Controller
{
    /**
     * @Route("/publication/list/{page}", defaults={"page": "1"}, requirements={"page": "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function publicationAction($page)
    {
//        var_dump($page);
        return [];
    }

    /**
     * @Route("/publication/{publicationId}/read/chapter/list/{page}", defaults={"page": "1"}, requirements={"publicationId": "\d+", "page": "\d+"})
     * @Method("GET")
     */
    public function showPublicationChaptersAction($publicationId, $page)
    {

    }

    /**
     * @Route("/publication/{publicationId}/read/chapter/{chapterId}", defaults={"chapterId": "1"}, requirements={"publicationId": "\d+", "chapterId": "\d+"})
     * @Method("GET")
     */
    public function showPublicationChapterAction($publicationId, $chapterId)
    {

    }

    /**
     * @Route("/publication/read/{publicationId}")
     * @Method("get")
     */
    public function showPublicationAction($publicationId)
    {
//        var_dump($publicationId);
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
     * @Method("GET")
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
     * @Route("/publication/add/")
     * @Method("GET")
     * @Template()
     * @return Response
     */
    public function addPublicationAction(Request $request)
    {
        $factory = $this->get('form.factory');
        $publication = new Publication();
        $form = $factory->create(PublicationType::class, $publication);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publication);
            $em->flush();

            return $this->redirectToRoute('publeash_publication_publication');
        }
        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/publication/add/{publicationId}/chapter")
     * @Method("GET")
     * @param $publicationId
     */
    public function addChapter($publicationId)
    {

    }

}