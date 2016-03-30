<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/29/16
 * Time: 6:18 PM
 */

namespace PubLeashBundle\Service;


use Doctrine\ORM\EntityManager;
use PubLeashBundle\Entity;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ApiChapter extends AbstractApiService
{

    public function getName()
    {
        return 'chapter';
    }

    public function publish($publicationId, $chapterId) {

        /** @var Entity\Chapter $chapter */
        $chapter = $this->em->getRepository(Entity\Chapter::class)->find($chapterId);

        if(!$this->userIsAuthor($chapter)){
            return ['message' => 'Error: Logged user is not eligible to change publicised status', 'code' => 403];
        }

        $chapter->setIsPublished(true);
        $this->em->persist($chapter);
        return ['message' => 'Publication has been published', 'code' => 200];
    }

    public function unpublish($publicationId, $chapterId) {
        /** @var Entity\Chapter $chapter */
        $chapter = $this->em->getRepository(Entity\Chapter::class)->find($chapterId);

        if(!$this->userIsAuthor($chapter)){
            return ['message' => 'Error: Logged user is not eligible to change publicised status', 'code' => 403];
        }

        $chapter->setIsPublished(false);
        $this->em->persist($chapter);
        return ['message' => 'Publication has been unpublished', 'code' => 200];
    }

    protected function userIsAuthor(Entity\Chapter $chapter){
        $user = $this->getUser();

        return $chapter->getPublication()->getAuthors()->contains($user);
    }
}