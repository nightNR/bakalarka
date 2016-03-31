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
    public function pendingAuthorshipRequestsAction() {
        /** @var User $user */
        $user = $this->getUser();
        return [
            'pending_requests' => $user->getPendingAuthorshipRequests()
        ];
    }

    /**
     * @Route("/user/authorisation-requests/{page}", defaults={"page": "1"}, requirements={"page": "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function pendingAuthorisationRequestsAction() {
        /** @var User $user */
        $user = $this->getUser();
        return [
            'pending_requests' => $user->getPendingAuthorizationRequests()
        ];
    }
}