<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/29/16
 * Time: 8:58 PM
 */

namespace PubLeashBundle\Service;


use Doctrine\ORM\EntityManager;
use PubLeashBundle\Entity\Publication;
use PubLeashBundle\Entity\PublicationXAuthor;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class ApiPublication extends AbstractApiService
{
    public function getName()
    {
        return 'publication';
    }

    public function add_to_library($publicationId) {
        if(($user = $this->getUser()) === null) {
            return ['message' => 'User need to be logged in', 'code' => 400];
        }
        if(($publication = $this->em->getRepository(Publication::class)->find($publicationId)) === null) {
            return ['message' => 'Publication with ID '. $publicationId . 'does not exist.', 'code' => 400];
        }
        $user->addPublicationToLibrary($publication);
        return ['message' => 'Publication has been submitted for for authors permissions.', 'code' => 200];
    }

    public function confirm_authorship($publicationId) {

        if(($user = $this->getUser()) === null) {
            return ['message' => 'User need to be logged in', 'code' => 400];
        }
        if(($publication = $this->em->getRepository(Publication::class)->find($publicationId)) === null) {
            return ['message' => 'Publication with ID '. $publicationId . 'does not exist.', 'code' => 400];
        }

        if(($authorship = $this->em->getRepository(PublicationXAuthor::class)->find(['publication' => $publication, 'user' => $user])) === null) {
            return ['message' => 'Authorship between user '.$user->getUsername().' and publication '. $publication->getTitle() . 'does not exist.', 'code' => 400];
        }

        $authorship->setIsValid(true);
        return ['message' => 'Authorship of publication '. $publication->getTitle() .' confirmed. ', 'code' => 200];
    }
}