<?php
/**
 * Created by PhpStorm.
 * User: nightnr
 * Date: 15.3.2016
 * Time: 22:14
 */

namespace PubLeashBundle\Controller;

use PubLeashBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DataController extends Controller
{

    /**
     * @Route("/data/authors.{_format}", defaults={"_format": "json"}, requirements={"_format": "json|html"})
     * @Method("GET")
     */
    public function authorsAction() {
        $authors = $this->get('author')->getAvailableAuthors();

        $serializer = $this->get('jms_serializer');

        $serializedData = $serializer->serialize($authors, 'json');
        return new Response($serializedData);
    }

    /**
     * @Route("/data/pending-request-count.{_format}", defaults={"_format": "json"}, requirements={"_format": "json|html"})
     * @Method("GET")
     */
    public function pendingRequestCount() {
        $serializer = $this->get('jms_serializer');
        $notificationService = $this->get('notification');
        /** @var User $user */
        $user = $this->getUser();


        $data = [
            'pending-authorship' => $notificationService->getUserPendingAuthorshipRequestCount($user),
            'pending-notification' => $notificationService->getAllUserNotificationCount($user)
        ];

        $serializedData = $serializer->serialize($data, 'json');
        return new Response($serializedData);
    }
}