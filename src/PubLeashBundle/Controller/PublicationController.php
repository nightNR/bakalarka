<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 04.03.2016
 * Time: 23:51
 */

namespace PubLeashBundle\Controller;


use PubLeashBundle\Entity;
use PubLeashBundle\Form\ChapterType;
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
        $publicationService = $this->get('publication');
        $limit = 15;

        $paginator = $publicationService->getPublications($page, $limit);

//        $result = $paginator->getIterator();

        $maxPages = ceil($paginator->count() / $limit);

        return [
            'paginator' => $paginator,
            'max_pages' => $maxPages,
            'current_page' => $page,
        ];
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
     * @Route("/publication/read/{publicationId}/{name}")
     * @Method("get")
     * @Template()
     */
    public function showPublicationAction($publicationId)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Entity\Publication::class);

        $publication = $repository->find($publicationId);
        return [
            'publication' => $publication
        ];
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
     * @Template()
     * @return Response
     */
    public function addPublicationAction(Request $request)
    {
        $factory = $this->get('form.factory');
        $em = $this->getDoctrine()->getManager();

        $publication = new Entity\Publication();
        $form = $factory->create(PublicationType::class, $publication);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $user = $this->get('security.token_storage')->getToken()->getUser();
//            dump($user);
            $publication->addAuthor($user);


            $em->persist($publication);
            $em->flush();

            return $this->redirectToRoute('publeash_publication_publication');
        }
        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/publication/edit/{publicationId}/{name}")
     * Method("GET")
     * @Template()
     * @return Response
     */
    public function editPublicationAction(Request $request, $publicationId = 0) {

        $factory = $this->get('form.factory');
        $em = $this->getDoctrine()->getManager();

        /**
         * @var Publication $publication;
         */
        $publication = $em->getRepository(Entity\Publication::class)->find($publicationId);

        $form = $factory->create(PublicationType::class, $publication);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            return $this->redirectToRoute('publeash_publication_showpublication', ['publicationId' => $publicationId, 'name' => $publication->getPrettyUrlTitle()]);
        }
        return [
            'form' => $form->createView(),
            'params' => ['publicationId' => $publicationId, 'name' => $publication->getPrettyUrlTitle()]
        ];
    }

    /**
     * @Route("/publication/remove/{publicationId}")
     * @param $publicationId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removePublicationAction($publicationId) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Entity\Publication::class);
        /**
         * @var Entity\Publication $publication
         */
        $publication = $repository->find($publicationId);
        $publication->delete();
        $em->flush();
        return $this->redirectToRoute('publeash_publication_publication');
    }

    /**
     * @Route("/publication/add/{publicationId}/chapter")
     * @Template()
     * @param Request $request
     * @param $publicationId
     * @return array
     */
    public function addChapterAction(Request $request, $publicationId)
    {
        $factory = $this->get('form.factory');
        $em = $this->getDoctrine()->getManager();

        $publication = $em->getRepository(Entity\Publication::class)->find($publicationId);

        $chapter = new Entity\Chapter();
        $chapter->setPublication($publication);
        $form = $factory->create(ChapterType::class, $chapter);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $em->persist($chapter);
            $em->flush();

            return $this->redirectToRoute('publeash_publication_publication');
        }
        return [
            'form' => $form->createView(),
            'publication_id' => $publicationId
        ];
    }

}