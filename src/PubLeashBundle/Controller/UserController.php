<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/21/16
 * Time: 5:51 PM
 */

namespace PubLeashBundle\Controller;

use PubLeashBundle\Entity\Publication;
use PubLeashBundle\Entity\PublicationXAuthor;
use PubLeashBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/user/authorship-requests/{page}", defaults={"page": "1"}, requirements={"page": "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function pendingAuthorizationRequestsAction() {
        /** @var User $user */
        $user = $this->getUser();
        return [
            'pending_requests' => $user->getPendingAuthorshipRequests()
        ];
    }

    /**
     * @param $publicationId
     * @return Response
     * @Route("/user/authorship-request-confirm/", defaults={"_format": "json"}, requirements={"_format": "json|html"})
     * @Method("POST")
     */
    public function confirmAuthorshipRequestAction(Request $request, $_format) {
        $publicationId = $request->get('publicationId');
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
        $publication = $em->getRepository(Publication::class)->find($publicationId);
        $relation = $em->getRepository(PublicationXAuthor::class)->find([
            'user' => $user->getId(),
            'publication' => $publication
        ]);
//        dump($relation);
        $data = [];
        if($relation != null) {
            $relation->setIsValid(true);
            $em->persist($relation);
            $em->flush();
            $data['status'] = 'OK';
        } else {
            $data['status'] = 'Error';
        }

        return new Response($serializer->serialize($data, $_format));
    }
}