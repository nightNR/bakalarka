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

class ApiChapter implements ApiServiceInterface
{
    use ContainerAwareTrait;
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * ApiChapter constructor.
     * @param $em
     */
    public function __construct($em)
    {
        $this->em = $em;
    }


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

    /**
     * Get a user from the Security Token Storage.
     *
     * @return mixed
     *
     * @throws \LogicException If SecurityBundle is not available
     *
     * @see TokenInterface::getUser()
     */
    protected function getUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }
}