<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/14/16
 * Time: 6:51 PM
 */

namespace PubLeashBundle\Service;


use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use PubLeashBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Review
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * Review constructor.
     * @param EntityManager $em
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(EntityManager $em, TokenStorageInterface $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }


    public function isAllowedToWriteReview(\PubLeashBundle\Entity\Chapter $chapter) {
        $user = $this->getUser();
        $criteria = Criteria::create()->where(Criteria::expr()->eq('author', $user));
        return $chapter->getPublication()->getAuthors()->contains($user) || ( $chapter->getPublication()->getOwners()->contains($user)
            && $chapter->getReviews()->matching($criteria)->isEmpty());
    }

    /**
     * @param \PubLeashBundle\Entity\Publication $publication
     * @param \PubLeashBundle\Entity\Review $review
     * @return bool
     */
    public function isAllowedReplyReview(\PubLeashBundle\Entity\Review $review) {
        if($user = $this->getUser()){
            return $review->getPublication()->getAuthors()->contains($user) || $review->getAuthor() == $user;
        }
        return false;
    }

    /**
     * @return null|User
     */
    protected function getUser() {
        $user = $this->tokenStorage->getToken()->getUser();
        return ($user instanceof User)?$user:null;
    }
}